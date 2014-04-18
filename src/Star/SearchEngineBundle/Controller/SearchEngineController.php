<?php

namespace Star\SearchEngineBundle\Controller;



use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Star\AnnoncesBundle\Entity\Annonce;
use Star\AnnoncesBundle\Form\AnnonceType;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;

class SearchEngineController extends Controller
{
    
    /**
     * Creates a new Annonce entity.
     *
     * @Route("/search/{page}", name="star_search_engine_search")
     * @Method("POST")
     * @Template("StarSearchEngineBundle:SearchEngine:search.html.twig")
     */
    
   
    public function searchAction($theme, $nature, $gouv, $page, Request $request){
        // $random = substr(number_format(time() * rand(),0,'',''),0,8);
        // var_dump($random);
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('StarAnnoncesBundle:Annonce');
            
        $countAdds = $repository->getCountAdds();
        
        $maxAdds = $this->container->getParameter('max_adds_per_page');
        
        
        $pagination = array(
            'page' => $page,
            'route' => 'star_search_engine_search',
            'pages_count' => ceil($countAdds / $maxAdds),
            'route_params' => array()
        );
        
        
        $form = $this->createFormBuilder()
           
                ->add('annonceType', 'choice', array(
                'choices' => array('OFFRE' => 'Offre', 'DEMANDE' => 'demande'),
                'multiple' => false,
                'expanded' => true,
                'required' => true,
                //'data' => 'OFFRE',
            ))
            ->add('demandeType', 'choice', array(
                'choices' => array('VENTE' => 'Vente', 'LOCATION' => 'Location'),
                'multiple' => false,
                'expanded' => true,
                'required' => true,
                //'data' => 'VENTE',
            ))
            ->add('idAdds', 'integer')
                
            ->add('theme', 'entity', array('class'      => 'StarAnnoncesBundle:Theme'
                                   //, 'required'   => true
                                   , 'empty_value'=> ''
                                   ,'query_builder' => function(EntityRepository $er) {
                                        return $er->createQueryBuilder('t')
                                            ->orderBy('t.position', 'ASC');
                                    },))

             ->add('nature', 'shtumi_dependent_filtered_entity'
                , array('entity_alias' => 'nature_by_theme'
                      , 'empty_value'=> ''
                      , 'parent_field'=>'theme'
                   ))

             ->add('brand', 'shtumi_dependent_filtered_entity'
                , array('entity_alias' => 'brand_by_nature'
                      , 'empty_value'=> ''
                      , 'parent_field'=>'nature'))
                
                
             ->add('model', 'shtumi_dependent_filtered_entity'
                , array('entity_alias' => 'model_by_brand'
                      , 'empty_value'=> ''
                      , 'parent_field'=>'brand'))
                                            
             ->add('energy', 'entity', array('class'      => 'StarAnnoncesBundle:Energy'
                                   , 'required'   => false
                                   , 'empty_value'=> ''))
             ->add('age', 'choice', array(
                'choices'   => array(
                    '1'   => 'Moins d\'1 ans',
                    '2'   => 'Entre 1 an & 2 ans',
                    '4'   => 'Entre 3 & 4 ans',
                    '8'   => 'Entre 7 & 8 ans ans',
                    '10'  => 'Entre 9 & 10 ans',
                    '100' => 'plus de 10 ans',

                )
                 , 'empty_value'=> ''
            ))                                
            ->add('gouv', 'entity', array('class'      => 'StarAnnoncesBundle:Gouv'
                               , 'required'   => true
                               , 'empty_value'=> ''))
            
            ->add('deleg', 'shtumi_dependent_filtered_entity'
                , array('entity_alias' => 'deleg_by_gouv'
                      , 'empty_value'=> ''
                      , 'parent_field'=>'gouv'))

            
            ->add('locality', 'shtumi_dependent_filtered_entity'
                , array('entity_alias' => 'locality_by_deleg'
                      , 'empty_value'=> ''
                      , 'parent_field'=>'deleg'))
            ->add('min_price', 'money',array(
                    'currency' => false,
                ))
                ->add('max_price', 'money',array(
                    'currency' => false,
                ))
                ->add('withPhotos', 'checkbox', array(
                    'label'     => 'withPhotos',
                    'required'  => false,
                ))
                // ->add('send', 'submit')
           
            ->getForm();
        
        $results = array();
        $submited = false;
        $withPhotos = false;
        
        $form->handleRequest($request);
        if ($gouv  && !$request->isMethod('POST')) {
            $gouvObj = $em->getRepository('StarAnnoncesBundle:Gouv')->find($gouv);
            
           
            $data = $form->getData(); 
            $data['gouv'] = $gouvObj;
            
            $form->setData($data);
            
            $results = $repository->searchAnnonces( $page,$maxAdds, $data );
            
            $submited = true;
            //die('eee');
        }
        
        if ($nature  && !$request->isMethod('POST')) {
            $themeObj = $em->getRepository('StarAnnoncesBundle:Theme')->find($theme);
            $natureObj = $em->getRepository('StarAnnoncesBundle:Nature')->find($nature);
           
            $data = $form->getData(); 
            $data['theme'] = $themeObj;
            $data['nature'] = $natureObj;
            //$data['gouv'] = $gouv;
            $form->setData($data);
            //$form->submit($request);
            
            $results = $repository->searchAnnonces( $page,$maxAdds, $data );
            
            $submited = true;
            //die('eee');
        }
       
       
        if ($form->isValid()) {
           
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
             
            if($data['withPhotos'])
                $withPhotos = true;
            
       // var_dump($maxAdds, $countAdds, $page);
             
            $results = $repository->searchAnnonces( $page,$maxAdds, $data );
            
            //var_dump($maxAdds, count($results));
            
            $submited = true;
        }
        
        return array(
            'entities' => $results,
            'form'   => $form->createView(),
            'submited'=>$submited,
            'withPhotos'=>$withPhotos, 
            'pagination' => $pagination,
            
        );

    }
    
    public function getResultsAction(){

    }
}

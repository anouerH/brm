<?php

namespace Star\AnnoncesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Star\AnnoncesBundle\Entity\Annonce;
use Star\AnnoncesBundle\Entity\Gouv;
use Star\AnnoncesBundle\Entity\Deleg;
use Star\AnnoncesBundle\Entity\Locality;
use Star\AnnoncesBundle\Form\AnnonceType;
use Symfony\Component\HttpFoundation\Response;


/**
 * Annonce controller.
 *
 * @Route("/annonce")
 */
class AnnonceController extends Controller
{

    /**
     * Lists all Annonce entities.
     *
     * @Route("/", name="annonce")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('StarAnnoncesBundle:Annonce')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all Annonce entities per user.
     *
     * @Route("/list-per-user", name="annonce_list")
     * @Method("GET")
     * @Template()
     */

    public function listAction(){
        $em = $this->getDoctrine()->getManager();


        $user = $this->container->get('security.context')->getToken()->getUser();
        
        $entities = $em->getRepository('StarAnnoncesBundle:Annonce')->findAddsByUser($user);
        
        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Annonce entity.
     *
     * @Route("/", name="annonce_create")
     * @Method("POST")
     * @Template("StarAnnoncesBundle:Annonce:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Annonce();
        $entity->setImgDirId($request->query->get('editId'));
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        
        
        if ($request->isMethod('POST')) {
            // if is star adds and no images uploded
            if($form->get('convertStars')->getData()){
                $existingFiles = $this->get('punk_ave.file_uploader')->getFiles(array('folder' => 'tmp/attachments/' . $request->query->get('editId') ));
                if(!count($existingFiles)){
                    // return error 
                    $error = new \Symfony\Component\Form\FormError('Veuillez télecharger des images pour pouvoir convertir l\'annonce en star', null);
                    $form->get('convertStars')->addError($error);
                }
            }

            if ($form->isValid()) {
                $user = $this->container->get('security.context')->getToken()->getUser();
                $entity->setUser($user);
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();

                // update unique id annonce 
                $entity->setIdAdds($entity->getId());
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('annonce_show', array('id' => $entity->getId())));
            }
            
        }
        
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            
        );
    }

    /**
    * Creates a form to create a Annonce entity.
    *
    * @param Annonce $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Annonce $entity)
    {
        $form = $this->createForm(new AnnonceType(), $entity, array(
            'action' => $this->generateUrl('annonce_create'),
            'method' => 'POST',
        ));

        //$form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Annonce entity.
     *
     * @Route("/new", name="annonce_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Annonce();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Annonce entity.
     *
     * @Route("/{id}", name="annonce_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StarAnnoncesBundle:Annonce')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Annonce entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Annonce entity.
     *
     * @Route("/{slug}/edit", name="annonce_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($slug)
    {
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StarAnnoncesBundle:Annonce')->findOneBy(array('slug' => $slug));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Annonce entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($entity->getId());

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Annonce entity.
    *
    * @param Annonce $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Annonce $entity)
    {
        $form = $this->createForm(new AnnonceType(), $entity, array(
            'action' => $this->generateUrl('annonce_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        // $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Annonce entity.
     *
     * @Route("/{id}", name="annonce_update")
     * @Method("PUT")
     * @Template("StarAnnoncesBundle:Annonce:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StarAnnoncesBundle:Annonce')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Annonce entity.');
        }
        
        $deleteForm = $this->createDeleteForm($id);
        
        $editForm = $this->createEditForm($entity);

        if ($request->isMethod('POST')) {
            $editForm->bind($request);

            if ($editForm->isValid()) {
                // the validation passed, do something with the $author object
                $em->flush();
                
                $this->get('session')->getFlashBag()->add('notice', 'Annonce bien modifiée');
                return $this->redirect($this->generateUrl('annonce'));
            }
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );



    }
    /**
     * Deletes a Annonce entity.
     *
     * @Route("/{id}", name="annonce_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('StarAnnoncesBundle:Annonce')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Annonce entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('annonce'));
    }

    /**
     * Creates a form to delete a Annonce entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('annonce_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    public function uploadAction()
    {
        $editId = $this->getRequest()->get('id');
        if (!preg_match('/^\d+$/', $editId))
        {
            throw new Exception("Bad edit id");
        }

        $this->get('punk_ave.file_uploader')->handleFileUpload(array('folder' => 'tmp/attachments/' . $editId));
    }
    
    /**
     * Les dernières annonces
     */
    public function lastAnnoncesAction(){
        
        $maxAdds = $this->container->getParameter('max_adds_per_page');
        $em = $this->getDoctrine()->getManager();
        $annonces = $em->getRepository('StarAnnoncesBundle:Annonce')->getlastAnnonces($maxAdds);
         
        foreach ($annonces as $annonce){
             
             $existingFiles = $this->get('punk_ave.file_uploader')->getFiles(array('folder' => 'tmp/attachments/' . $annonce->getImgDirId()));
             
             $annonce->setImages($existingFiles);
        }
        return $this->render('StarAnnoncesBundle:Annonce:last.html.twig', array(
            'annonces' => $annonces,
        ));
         
    }
    
    /**
     * les annonces stars
     */
    
    public function annoncesStarsAction(){
        return $this->render('StarAnnoncesBundle:Annonce:star.html.twig');
    }
    
    /**
     * Detail Annonce
     */
    public function detailAnnonceAction($slug){
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StarAnnoncesBundle:Annonce')->findOneBy(array('slug' => $slug));
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Annonce entity.');
        }
        $session = $this->get('session');
        
        if ((!$session->has('visitors')) || (!in_array($entity->getId(), $session->get('visitors'))) ) {
            $entity->setVisitors($entity->getVisitors()+1);
            $em->persist($entity);
            $em->flush();
            if(!$session->has('visitors')){
                $session->set('visitors', array());
            }
            $idsInSession = $session->get('visitors');
            array_push($idsInSession, $entity->getId());
            $session->set('visitors', $idsInSession);
        }
        
        $images =  $this->get('punk_ave.file_uploader')->getFiles(array('folder' => 'tmp/attachments/' . $entity->getImgDirId()));
        return $this->render('StarAnnoncesBundle:Annonce:detail-annonce.html.twig', array(
            'entity' => $entity,
            'images'=>$images
        ));
    }
    
    /**
     * Contact Annonceur
     */
    public function contactAnnonceurAction(Request $request){
        
        // var_dump($request->request->get('subject'), $request->request->get('anonnceur'));
        
        $usr= $this->get('security.context')->getToken()->getUser();


        $message = \Swift_Message::newInstance()
        ->setSubject($request->request->get('subject'))
        ->setFrom($usr->getEmail())
        ->setTo($request->request->get('anonnceur'))
        ->setContentType("text/html")
        ->setBody($this->renderView('StarAnnoncesBundle:Annonce:contact-annonceur.html.twig', array('name' => $usr->getUsername())))
            ;
            $this->get('mailer')->send($message);
    
        
        
        $return=array("responseCode"=>200,  "greeting"=>'ddd');
        $return=json_encode($return);//jscon encode the array
        return new Response($return,200,array('Content-Type'=>'application/json'));//make sure it has the correct content type
    }
    
    /**
     * Espace Membre
     */
    public function espaceMembreAction(){
        return $this->render('StarAnnoncesBundle:Annonce:espace-membre.html.twig');
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function generateIdAdds()
    {
        var_dump('generate Id Adds');
        die();
    }

    
   
}

<?php

namespace Star\AnnoncesBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
/**
 * AnnonceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AnnonceRepository extends EntityRepository
{
    public function getlastAnnonces(){
        $qb = $this->createQueryBuilder('a')
            ->orderBy('a.createdAt', 'DESC')
            ->setMaxResults(5);
        $query = $qb->getQuery();
        
        return $query->getResult();
    }
    
    
    public function searchAnnonces( $page=1, $maxperpage=10, $data ){
        
        $qb = $this->createQueryBuilder('a');
             
        $cpt = 1 ;
        foreach ($data as $key => $value) {
            
            if($value === NULL )                continue;
            if($key == "withPhotos")            continue;
            //if($key == "age")                   continue;
            // Specific cases
            print "<br>----";
            var_dump($key);
            print "----</br>";
            if(is_object($value)){
                var_dump($key,$value->getId());
                $qb->andWhere('a.'.$key.' = ?'.$cpt);
                $qb->setParameter($cpt, $value->getId());
                $cpt++;
                continue;
            }
            if($key == 'min_price'){
                $qb->andWhere('a.price >= ?'.$cpt);
                $qb->setParameter($cpt, $value);
                $cpt++;
                continue;
            }
            if($key == 'max_price'){
                $qb->andWhere('a.price <= ?'.$cpt);
                $qb->setParameter($cpt, $value);
                $cpt++;
                continue;
            }
            if($key == 'age'){
                $qb->andWhere('a.release > ?'.$cpt);
                $qb->setParameter($cpt, new \DateTime('-1 year'));
                $cpt++;
                continue;
            }
            
            // default
            $qb->andWhere('a.'.$key.' = ?'.$cpt);
            $qb->setParameter($cpt, $value);
             
             $cpt ++;
        }
        
       
        
        $qb->orderBy('a.createdAt', 'DESC');
        
        $qb->setFirstResult(($page-1) * $maxperpage)
            ->setMaxResults($maxperpage);
        
       //  return $qb->getQuery()->getResult();
        
       return new Paginator($qb);
        
        
    }
    
    
    public function getCountAdds(){
        $qb = $this->createQueryBuilder('a');
        return count($qb->getQuery()->getResult());
    }
    
 }

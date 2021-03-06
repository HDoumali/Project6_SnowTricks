<?php

namespace ST\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\QueryBuilder;

/**
 * TrickRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TrickRepository extends \Doctrine\ORM\EntityRepository
{
	public function getTricks($page, $nbPerPage)
	{
		$query = $this->createQueryBuilder('t')
		->leftJoin('t.category', 'c')
		->addSelect('c')
		->leftJoin('t.pictures', 'p')
		->addSelect('p')
		->leftJoin('t.videos', 'v')
		->addSelect('v')
		->leftJoin('t.comments', 'co')
		->addSelect('co')
		->getQuery()
		;

	    //return $query->getResult();

	    $query
	      // On définit la figure à partir de laquelle commencer la liste
	      ->setFirstResult(($page-1) * $nbPerPage)
	      // Ainsi que le nombre de figure à afficher sur une page
	      ->setMaxResults($nbPerPage)
        ;  

        return new Paginator($query, true);
	}
}

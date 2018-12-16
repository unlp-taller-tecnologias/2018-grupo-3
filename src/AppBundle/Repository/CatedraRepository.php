<?php

namespace AppBundle\Repository;

/**
 * CatedraRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CatedraRepository extends \Doctrine\ORM\EntityRepository
{
	public function publicacionesAprobadas() {

		$fechaActual = new \DateTime("now");

		$qb = $this->createQueryBuilder('p')
			->where('p.fechaCaducidad > :fechaActual')->setParameter('fechaActual', $fechaActual)
			->andwhere('p.aprobada = 1');
		return $qb->getQuery()->getResult();

	}
}

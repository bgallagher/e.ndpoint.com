<?php

namespace Endpoint\Service;

use Doctrine\ORM\EntityManager;
use Endpoint\Entity\Endpoint as EndpointEntity;

class Endpoint
{

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param EndpointEntity $endpoint
     */
    public function create(EndpointEntity $endpoint)
    {
        $this->entityManager->persist($endpoint);
        $this->entityManager->flush();
    }

}
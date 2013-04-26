<?php

namespace Endpoint\Service;

use Aza\Components\Math\NumeralSystem;
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
        $endpoint->setCreatedDate(new \DateTime());

        $this->entityManager->persist($endpoint);
        $this->entityManager->flush();

        $endpoint->setBase62(NumeralSystem::convertTo($endpoint->getId(), 62));
        $this->entityManager->flush();
    }

    public function findById($id)
    {
        return $this->entityManager->find('Endpoint\Entity\Endpoint', $id);
    }

    public function findByBase62($base62)
    {
        $id = NumeralSystem::convertFrom($base62, 62);
        return $this->findById($id);
    }

    public function endpointToArray(EndpointEntity $endpoint)
    {
        return array(
            'id' => $endpoint->getId(),
            'base62' => $endpoint->getBase62(),
            'getResponse' => $endpoint->getGetResponse(),
            'postResponse' => $endpoint->getPostResponse(),
            'putResponse' => $endpoint->getPutResponse(),
            'deleteResponse' => $endpoint->getDeleteResponse(),
            'createdDate' => $endpoint->getCreatedDate(),
        );
    }

}
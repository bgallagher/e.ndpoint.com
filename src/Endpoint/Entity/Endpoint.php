<?php

namespace Endpoint\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Endpoint
 */
class Endpoint
{
    /**
     * @var string
     */
    private $idHash;

    /**
     * @var array
     */
    private $getResponse;

    /**
     * @var array
     */
    private $postResponse;

    /**
     * @var array
     */
    private $putResponse;

    /**
     * @var array
     */
    private $deleteResponse;

    /**
     * @var \DateTime
     */
    private $createdDate;

    /**
     * @var \DateTime
     */
    private $updatedDate;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set idHash
     *
     * @param string $idHash
     * @return Endpoint
     */
    public function setIdHash($idHash)
    {
        $this->idHash = $idHash;
    
        return $this;
    }

    /**
     * Get idHash
     *
     * @return string 
     */
    public function getIdHash()
    {
        return $this->idHash;
    }

    /**
     * Set getResponse
     *
     * @param array $getResponse
     * @return Endpoint
     */
    public function setGetResponse($getResponse)
    {
        $this->getResponse = $getResponse;
    
        return $this;
    }

    /**
     * Get getResponse
     *
     * @return array 
     */
    public function getGetResponse()
    {
        return $this->getResponse;
    }

    /**
     * Set postResponse
     *
     * @param array $postResponse
     * @return Endpoint
     */
    public function setPostResponse($postResponse)
    {
        $this->postResponse = $postResponse;
    
        return $this;
    }

    /**
     * Get postResponse
     *
     * @return array 
     */
    public function getPostResponse()
    {
        return $this->postResponse;
    }

    /**
     * Set putResponse
     *
     * @param array $putResponse
     * @return Endpoint
     */
    public function setPutResponse($putResponse)
    {
        $this->putResponse = $putResponse;
    
        return $this;
    }

    /**
     * Get putResponse
     *
     * @return array 
     */
    public function getPutResponse()
    {
        return $this->putResponse;
    }

    /**
     * Set deleteResponse
     *
     * @param array $deleteResponse
     * @return Endpoint
     */
    public function setDeleteResponse($deleteResponse)
    {
        $this->deleteResponse = $deleteResponse;
    
        return $this;
    }

    /**
     * Get deleteResponse
     *
     * @return array 
     */
    public function getDeleteResponse()
    {
        return $this->deleteResponse;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     * @return Endpoint
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    
        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime 
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set updatedDate
     *
     * @param \DateTime $updatedDate
     * @return Endpoint
     */
    public function setUpdatedDate($updatedDate)
    {
        $this->updatedDate = $updatedDate;
    
        return $this;
    }

    /**
     * Get updatedDate
     *
     * @return \DateTime 
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}

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
    private $base62;

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
     * @var integer
     */
    private $id;


    /**
     * Set base62
     *
     * @param string $base62
     * @return Endpoint
     */
    public function setBase62($base62)
    {
        $this->base62 = $base62;
    
        return $this;
    }

    /**
     * Get base62
     *
     * @return string 
     */
    public function getBase62()
    {
        return $this->base62;
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}

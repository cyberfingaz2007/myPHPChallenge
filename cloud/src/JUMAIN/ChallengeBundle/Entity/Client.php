<?php

namespace JUMAIN\ChallengeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="JUMAIN\ChallengeBundle\Repository\ClientRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Client
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ClientName", type="string", length=50)
     */
    private $clientName;

    /**
     * @var string
     *
     * @ORM\Column(name="ClientEmail", type="string", length=50, unique=true)
     */
    private $clientEmail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateEntered", type="datetime")
     */
    private $dateEntered;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set clientName
     *
     * @param string $clientName
     * @return Client
     */
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;

        return $this;
    }

    /**
     * Get clientName
     *
     * @return string 
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * Set clientEmail
     *
     * @param string $clientEmail
     * @return Client
     */
    public function setClientEmail($clientEmail)
    {
        $this->clientEmail = $clientEmail;

        return $this;
    }

    /**
     * Get clientEmail
     *
     * @return string 
     */
    public function getClientEmail()
    {
        return $this->clientEmail;
    }

    /**
     * Set dateEntered
     *
     * @param \DateTime $dateEntered
     * @return Client
     * @ORM\PrePersist
     */
    public function setDateEntered()
    {
        $this->dateEntered = new \DateTime();

        return $this;
    }

    /**
     * Get dateEntered
     *
     * @return \DateTime 
     */
    public function getDateEntered()
    {
        return $this->dateEntered;
    }
}

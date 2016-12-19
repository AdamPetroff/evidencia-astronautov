<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 15. 12. 2016
 * Time: 23:00
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Astronaut
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AstronautRepository")
 * @ORM\Table(name="astronauts")
 * @ORM\HasLifecycleCallbacks()
 */
class Astronaut
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $first_name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $last_name;

    /**
     * @ORM\Column(type="date")
     */
    private $date_of_birth;

    /**
     * @ORM\ManyToOne(targetEntity="Superpower", inversedBy="Astronauts")
     */
    private $superpower;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $deleted;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $in_service;

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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Astronaut
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Astronaut
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     *
     * @return Astronaut
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->date_of_birth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->date_of_birth;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Astronaut
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     *
     * @return Astronaut
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set inService
     *
     * @param boolean $inService
     *
     * @return Astronaut
     */
    public function setInService($inService)
    {
        $this->in_service = $inService;

        return $this;
    }

    /**
     * Get inService
     *
     * @return boolean
     */
    public function getInService()
    {
        return $this->in_service;
    }

    /**
     * Set superpower
     *
     * @param \AppBundle\Entity\Superpower $superpower
     *
     * @return Astronaut
     */
    public function setSuperpower(\AppBundle\Entity\Superpower $superpower = null)
    {
        $this->superpower = $superpower;

        return $this;
    }

    /**
     * Get superpower
     *
     * @return \AppBundle\Entity\Superpower
     */
    public function getSuperpower()
    {
        return $this->superpower;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->setCreatedAt(new \DateTime());
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 15. 12. 2016
 * Time: 23:16
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Superpower
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SuperpowerRepository")
 * @ORM\Table(name="superpowers")
 * @ORM\HasLifecycleCallbacks()
 */
class Superpower
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
    private $name;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Astronaut", mappedBy="superpower")
     */
    private $astronauts;

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
     * Constructor
     */
    public function __construct()
    {
        $this->astronauts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setDeleted(false);
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Superpower
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set descrription
     *
     * @param string $description
     *
     * @return Superpower
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Superpower
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
     * @return Superpower
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
     * Add astronaut
     *
     * @param \AppBundle\Entity\Astronaut $astronaut
     *
     * @return Superpower
     */
    public function addAstronaut(\AppBundle\Entity\Astronaut $astronaut)
    {
        $this->astronauts[] = $astronaut;

        return $this;
    }

    /**
     * Remove astronaut
     *
     * @param \AppBundle\Entity\Astronaut $astronaut
     */
    public function removeAstronaut(\AppBundle\Entity\Astronaut $astronaut)
    {
        $this->astronauts->removeElement($astronaut);
    }

    /**
     * Get astronauts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAstronauts()
    {
        return $this->astronauts;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->setCreatedAt(new \DateTime());
    }
}

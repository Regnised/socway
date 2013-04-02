<?php

namespace Home\ParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity
 * @ORM\Table(name="Team")
 * @UniqueEntity("name")
 */
class Team
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @var string $name
     *
     * @ORM\Column(name="name",type="string", length=100, unique=true)
     * @Assert\MinLength(
     *     limit=3,
     *     message="Your name must have at least {{ limit }} characters."
     * )
     */
    protected $name;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }


    public function setNames($names)
    {
        $this->names = $names;
    }

    public function getNames()
    {
        return $this->names;
    }

    /**
     * @ORM\OneToMany(targetEntity="Football", mappedBy="name")
     */
        protected $names;

    public function __construct()
    {
        $this->names = new ArrayCollection();
    }
}
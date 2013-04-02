<?php

namespace Home\ParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Football")
 *
 * @ORM\Entity(repositoryClass="Home\ParserBundle\Entity\FootballRepository")
 */

class Football
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * Set date
     *
     * @param \DateTime $date
//     * @return Post
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     * @ORM\Column(type="string", length=100)
     */
    protected  $hts;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected  $ats;

    /**
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="names",cascade={"persist"})
     * @ORM\JoinColumn(name="hometeam", referencedColumnName="id")
     */
    protected $football_h;

    /**
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="names",cascade={"persist"})
     * @ORM\JoinColumn(name="awayteam", referencedColumnName="id")
     */
    protected $football_a;

    public function setAts($ats)
    {
        $this->ats = $ats;
    }

    public function getAts()
    {
        return $this->ats;
    }

    public function setFootballA($football_a)
    {
        $this->football_a = $football_a;
    }

    public function getFootballA()
    {
        return $this->football_a;
    }

    public function setFootballH($football_h)
    {
        $this->football_h = $football_h;
    }

    public function getFootballH()
    {
        return $this->football_h;
    }

    public function setHts($hts)
    {
        $this->hts = $hts;
    }

    public function getHts()
    {
        return $this->hts;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }



}
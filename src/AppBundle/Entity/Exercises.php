<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exercises
 *
 * @ORM\Table(name="exercises")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExercisesRepository")
 */
class Exercises
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="repeats", type="string", length=255)
     */
    private $repeats;

    /**
     * @var string
     *
     * @ORM\Column(name="explanation", type="string", length=255, nullable=true)
     */
    private $explanation;




    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Exercises
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Exercises
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
     * Set repeats
     *
     * @param string $repeats
     *
     * @return Exercises
     */
    public function setRepeats($repeats)
    {
        $this->repeats = $repeats;

        return $this;
    }

    /**
     * Get repeats
     *
     * @return string
     */
    public function getRepeats()
    {
        return $this->repeats;
    }

    /**
     * Set explanation
     *
     * @param string $explanation
     *
     * @return Exercises
     */
    public function setExplanation($explanation)
    {
        $this->explanation = $explanation;

        return $this;
    }

    /**
     * Get repeats
     *
     * @return string
     */
    public function getExplanation()
    {
        return $this->explanation;
    }
}

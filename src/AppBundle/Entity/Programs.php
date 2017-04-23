<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Programs
 *
 * @ORM\Table(name="programs")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProgramsRepository")
 */
class Programs
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
     * @ORM\Column(name="exercise_list", type="string", length=255)
     */
    private $exerciseList;

    /**
     * @ORM\ManyToOne(targetEntity="Gender")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gender;

    /**
     * @ORM\ManyToOne(targetEntity="Experience")
     * @ORM\JoinColumn(nullable=false)
     */
    private $experience;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;




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
     * Set exerciseList
     *
     * @param string $exerciseList
     *
     * @return Programs
     */
    public function setExerciseList($exerciseList)
    {
        $this->exerciseList = $exerciseList;

        return $this;
    }

    /**
     * Get exerciseList
     *
     * @return string
     */
    public function getExerciseList()
    {
        return $this->exerciseList;
    }

    public function setGender(Gender $gender)
    {
        $this->gender = $gender;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setExperience(Experience $experience)
    {
        $this->experience = $experience;
    }

    public function getExperience()
    {
        return $this->experience;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }


}

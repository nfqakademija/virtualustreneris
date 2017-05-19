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
     * @var string
     *
     * @ORM\Column(name="exercise_list_two", type="string", length=255, nullable=true)
     */
    private $exerciseListTwo;

    /**
     * @var string
     *
     * @ORM\Column(name="exercise_list_three", type="string", length=255, nullable=true)
     */
    private $exerciseListThree;

    /**
     * @var string
     *
     * @ORM\Column(name="exercise_list_four", type="string", length=255, nullable=true)
     */
    private $exerciseListFour;

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
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Goals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $goals;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="AgeCategory")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ageCategory;



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

    /**
     * Set exerciseListTwo
     *
     * @param string $exerciseListTwo
     *
     * @return Programs
     */

    public function setExerciseListTwo($exerciseListTwo)
    {
        $this->exerciseListTwo = $exerciseListTwo;
    }

    /**
     * Get exerciseListTwo
     *
     * @return string
     */

    public function getExerciseListTwo()
    {
        return $this->exerciseListTwo;
    }

    /**
     * Set exerciseListThree
     *
     * @param string $exerciseListThree
     *
     * @return Programs
     */

    public function setExerciseListThree($exerciseListThree)
    {
        $this->exerciseListThree = $exerciseListThree;
    }

    /**
     * Get exerciseListThree
     *
     * @return string
     */

    public function getExerciseListThree()
    {
        return $this->exerciseListThree;
    }

    /**
     * Set exerciseListFour
     *
     * @param string $exerciseListFour
     *
     * @return Programs
     */

    public function setExerciseListFour($exerciseListFour)
    {
        $this->exerciseListFour = $exerciseListFour;
    }

    /**
     * Get exerciseListFour
     *
     * @return string
     */

    public function getExerciseListFour()
    {
        return $this->exerciseListFour;
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

    public function setGoals(Goals $goals)
    {
        $this->goals = $goals;
    }

    public function getGoals()
    {
        return $this->goals;
    }

    public function setAgeCategory(AgeCategory $ageCategory)
    {
        $this->ageCategory = $ageCategory;
    }

    public function getAgeCategory()
    {
        return $this->ageCategory;
    }
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FoodDishes
 *
 * @ORM\Table(name="food_dishes", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class FoodDishes
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="protein_num", type="integer", nullable=false)
     */
    private $proteinNum;

    /**
     * @var integer
     *
     * @ORM\Column(name="carbohydrate_num", type="integer", nullable=false)
     */
    private $carbohydrateNum;

    /**
     * @var integer
     *
     * @ORM\Column(name="fat_num", type="integer", nullable=false)
     */
    private $fatNum;

    /**
     * @var integer
     *
     * @ORM\Column(name="sugar_num", type="integer", nullable=false)
     */
    private $sugarNum;

    /**
     * @var integer
     *
     * @ORM\Column(name="kcal_num", type="integer", nullable=false)
     */
    private $kcalNum;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FoodCategories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $foodCategories;

    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getproteinNum()
    {
        return $this->proteinNum;
    }

    public function setproteinNum($proteinNum)
    {
        $this->proteinNum = $proteinNum;
    }

    public function getcarbohydrateNum()
    {
        return $this->carbohydrateNum;
    }

    public function setcarbohydrateNum($carbohydrateNum)
    {
        $this->carbohydrateNum = $carbohydrateNum;
    }

    public function getfatNum()
    {
        return $this->fatNum;
    }

    public function setfatNum($fatNum)
    {
        $this->fatNum = $fatNum;
    }

    public function getsugarNum()
    {
        return $this->sugarNum;
    }

    public function setsugarNum($sugarNum)
    {
        $this->sugarNum = $sugarNum;
    }

    public function getfoodCategories()
    {
        return $this->foodCategories;
    }

    public function setfoodCategories(foodCategories $foodCategories)
    {
        $this->foodCategories = $foodCategories;
    }

    public function getkcalNum()
    {
        return $this->kcalNum;
    }

    public function setkcalNum($kcalNum)
    {
        $this->kcalNum = $kcalNum;
    }
}

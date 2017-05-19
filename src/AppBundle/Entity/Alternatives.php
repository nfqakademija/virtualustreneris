<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FoodDishes
 *
 * @ORM\Table(name="alternatives", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Alternatives
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
     * @var integer
     *
     * @ORM\Column(name="dish_id", type="integer", nullable=false)
     */

    private $dishId;


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



    public function getId()
    {
        return $this->id;
    }

    public function getDishId()
    {
        return $this->dishId;
    }

    public function setDishId($dishId)
    {
        $this->dishId = $dishId;
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

    public function getkcalNum()
    {
        return $this->kcalNum;
    }

    public function setkcalNum($kcalNum)
    {
        $this->kcalNum = $kcalNum;
    }
}

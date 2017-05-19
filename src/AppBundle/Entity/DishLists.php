<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Goals;

use Doctrine\ORM\Mapping as ORM;

/**
 * DishLists
 *
 * @ORM\Table(name="dish_lists", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DishListsRepository")
 */
class DishLists
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
     * @ORM\Column(name="calories_num", type="integer", nullable=false)
     */
    private $caloriesNum;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Goals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $goals;

    /**
     * @var string
     *
     * @ORM\Column(name="food_dish_id", type="string", length=255, nullable=false)
     */
    private $foodDishId;

    public function getId()
    {
        return $this->id;
    }

    public function getCaloriesNum()
    {
        return $this->caloriesNum;
    }

    public function setCaloriesNum($caloriesNum)
    {
        $this->caloriesNum = $caloriesNum;
    }

    public function getGoals()
    {
        return $this->goals;
    }

    public function setGoals(Goals $goals)
    {
        $this->goals = $goals;
    }

    public function getFoodDishId()
    {
        return $this->foodDishId;
    }

    public function setFoodDishId($foodDishId)
    {
        $this->foodDishId = $foodDishId;
    }
}

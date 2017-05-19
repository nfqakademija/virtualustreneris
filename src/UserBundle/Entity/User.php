<?php
namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="meal_plan_id", type="integer", nullable=true)
     */

    protected $mealPlanId;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    public function getMealPlanId()
    {
        return $this->mealPlanId;
    }

    public function setMealPlanId($mealPlanId)
    {
        $this->mealPlanId = $mealPlanId;
    }
}

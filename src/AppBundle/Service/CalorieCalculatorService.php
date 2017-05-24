<?php
/**
 * Created by PhpStorm.
 * User: vilius
 * Date: 17.5.22
 * Time: 11.57
 */

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\Session\Session;

class CalorieCalculatorService
{
    protected $session;

    protected $gender;
    protected $height;
    protected $weight;
    protected $age;
    protected $goals;

    /**
     * @return mixed
     */
    public function getGoals()
    {
        return $this->goals;
    }
    protected $activity;

    protected $calories;
    protected $result;

    public function __construct(Session $session)
    {
        $this->session = $session;

        $this->gender = $session->get('gender');
        $this->weight = $session->get('weight');
        $this->height = $session->get('height');
        $this->age = $session->get('age');
        $this->goals = $session->get('goals');
        $this->activity = $session->get('activity');
    }

    public function calculate()
    {
        if ($this->gender == '1') {
            $this->calories = 664.7 + (5 * $this->height) + (13.75 * $this->weight) - (6.74 * $this->age);
            if ($this->goals == '1') {
                $this->result = $this->calories + 300;
            } else {
                $this->result = $this->calories - 300;
            }
        } else {
            $this->calories = 655.1 + (1.85 * $this->height) + (9.6 * $this->weight) - (6.74 * $this->age);
            if ($this->goals == '1') {
                $this->result = $this->calories + 200;
            } else {
                $this->result = $this->calories - 200;
            }
        }

        if ($this->activity == '1') {
            $this->result += 0;
        } elseif ($this->activity == '2') {
            $this->result += 50;
        } elseif ($this->activity == '3') {
            $this->result += 100;
        } elseif ($this->activity == '4') {
            $this->result += 150;
        } elseif ($this->activity == '5') {
            $this->result += 200;
        }

        return $this->result;
    }

    public function isGenderSet()
    {
        return isset($this->gender);
    }

    public function getGender()
    {
        return $this->gender;
    }
}

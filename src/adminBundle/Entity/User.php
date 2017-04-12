<?php
/**
 * Created by PhpStorm.
 * User: vilius
 * Date: 17.4.6
 * Time: 18.24
 */


namespace adminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="User")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}
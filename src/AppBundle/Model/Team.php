<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 25.11.15
 * Time: 19:49
 */

namespace AppBundle\Model;

use Faker;


class Team
{
    protected $country = array();
    protected $groups = array();

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param mixed $groups
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;
    }

    public function faker($counts)
    {
        $arr = 'ABCDEIFG';
        $faker = Faker\Factory::create();

        for ($i = 0; $i < $counts; $i++) {
            $this->country[$i] = $faker->country;
            $this->groups[$i] = substr ($arr, rand(0, strlen($arr)-1) , 1);
        }


    }
}
<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 26.11.15
 * Time: 20:52
 */

namespace AppBundle\Model;

use Faker;


class Country
{
    protected $country;
    protected $description;

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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function faker()
    {
        $faker = Faker\Factory::create();

            $this->country = $faker->country;
            $this->description = $faker->text;


    }

}
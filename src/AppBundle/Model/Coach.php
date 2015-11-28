<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 26.11.15
 * Time: 20:45
 */

namespace AppBundle\Model;

use Faker;


class Coach
{
    protected $firstName = array();
    protected $lastName = array();
    protected $birthDay = array();
    protected $biography = array();

    /**
     * @return array
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param array $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return array
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param array $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return array
     */
    public function getBirthDay()
    {
        return $this->birthDay;
    }

    /**
     * @param array $birthDay
     */
    public function setBirthDay($birthDay)
    {
        $this->birthDay = $birthDay;
    }

    /**
     * @return array
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * @param array $biography
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;
    }

    public function faker($counts)
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < $counts; $i++) {
            $this->firstName[$i] = $faker->firstNameMale;
            $this->lastName[$i] = $faker->lastName;
            $this->birthDay[$i] = $faker->dateTime;
            $this->biography[$i] = $faker->text;
        }


    }


}

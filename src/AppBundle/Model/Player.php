<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 26.11.15
 * Time: 20:25
 */

namespace AppBundle\Model;

use Faker;


class Player
{
    protected $firstName = array();
    protected $lastName = array();
    protected $birthDay = array();
    protected $biography = array();


    /**
     * @return mixed
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * @param mixed $biography
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;
    }

    /**
     * @return mixed
     */
    public function getBirthDay()
    {
        return $this->birthDay;
    }

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
     * @param mixed $birthDay
     */
    public function setBirthDay($birthDay)
    {
        $this->birthDay = $birthDay;
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
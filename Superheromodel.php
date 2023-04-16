<?php 

class SuperHero {

    public $id;
    public $name;
    public $firstName;
    public $lastName;
    public $place;

    function __construct($id, $name, $firstName, $lastName, $place) {
        $this->id = $id;
        $this->name = $name;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->place = $place;
    }
}


?>
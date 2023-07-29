<?php

class Product
{
    private $id;
    private $name;
    private $notes;
    private $unit_of_measure;
    private $user_id;

    public function __construct($id, $name, $notes, $unit_of_measure, $user_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->notes = $notes;
        $this->unit_of_measure = $unit_of_measure;
        $this->user_id = $user_id;
    }

    // Getter methods
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function getUnitOfMeasure()
    {
        return $this->unit_of_measure;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    // Setter methods (optional)
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    public function setUnitOfMeasure($unit_of_measure)
    {
        $this->unit_of_measure = $unit_of_measure;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
}

?>

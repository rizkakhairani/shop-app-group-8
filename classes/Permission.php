<?php

class Permission
{
    private $id;
    private $name;
    private $notes;

    public function __construct($id, $name, $notes)
    {
        $this->id = $id;
        $this->name = $name;
        $this->notes = $notes;
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
}

?>

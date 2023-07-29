<?php

class User
{
    private $id;
    private $username;
    private $first_name;
    private $last_name;
    private $phone;
    private $address;
    private $permission_id;
    private $password;

    public function __construct($id, $username, $first_name, $last_name, $phone, $address, $permission_id, $password)
    {
        $this->id = $id;
        $this->username = $username;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->phone = $phone;
        $this->address = $address;
        $this->permission_id = $permission_id;
        $this->password = $password;
    }

    // Getters and Setters for the properties
    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getPermissionId()
    {
        return $this->permission_id;
    }

    public function getPassword()
    {
        return $this->password;
    }
}

?>

<?php

class Sell
{
    private $id;
    private $total;
    private $price;
    private $product_id;
    private $customer_id;


    public function __construct($id, $total, $price, $product_id, $customer_id)
    {
        $this->id = $id;
        $this->total = $total;
        $this->price = $price;
        $this->product_id = $product_id;
        $this->customer_id = $customer_id;

    }

    // Getters and Setters for the properties
    public function getId()
    {
        return $this->id;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getCustomerId()
    {
        return $this->customer_id;
    }
    
    public function getProductId()
    {
        return $this->product_id;
    }

}

?>

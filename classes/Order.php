<?php

class Order
{
    private $id;
    private $total;
    private $price;
    private $supplier_id;
    private $product_id;


    public function __construct($id, $total, $price, $product_id, $supplier_id)
    {
        $this->id = $id;
        $this->total = $total;
        $this->price = $price;
        $this->product_id = $product_id;
        $this->supplier_id = $supplier_id;
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

    public function getSupplierId()
    {
        return $this->supplier_id;
    }

    public function getProductId()
    {
        return $this->product_id;
    }
}

?>

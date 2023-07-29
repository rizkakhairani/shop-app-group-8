<?php

class Report
{
    private $product_id;
    private $product_name;
    private $profit;
    private $stock;


    public function __construct($product_id, $product_name, $profit, $stock)
    {
        $this->product_id = $product_id;
        $this->product_name = $product_name;
        $this->profit = $profit;
        $this->stock = $stock;

    }

    // Getters and Setters for the properties
    public function getProductId()
    {
        return $this->product_id;
    }

    public function getProductName()
    {
        return $this->product_name;
    }

    public function getProfit()
    {
        return $this->profit;
    }

    public function getStock()
    {
        return $this->stock;
    }
}

?>

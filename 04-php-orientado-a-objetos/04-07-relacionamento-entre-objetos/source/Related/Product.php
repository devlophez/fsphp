<?php


namespace Source\Related;


class Product
{
    private $name;
    private $price;

    /**
     * Product constructor.
     * @param $name
     * @param $price
     */
    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return "R$ " . number_format($this->price, 2, ",", ".");
    }
}
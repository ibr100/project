<?php

use PHPUnit\Framework\TestCase;

class Product
{
    private $name;


    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }


}//end class product

class Cart
{
    public $cart = [];
    private $quantity;

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }


    public function addProduct( $product)
    {
        $var = true;
        $qunt = 0;
        $name = $product->getName();
        foreach ($this->cart as $prod) {
            if ($prod->getName() == $name) {
                $qunt = $prod->getQuantity();
                $var = false;
            }//end if statment
        }//end for each
        if ($var == true) {
            array_push($this->cart, $product);
            return true;
        } else {

            $product->setQuantity($qunt + $product->getQuantity());
            return true;
        }

    }//end function addProduct

}//end class Cart

class ShippingTest extends TestCase
{
    /** @test */

    public function product_limttation()
    {
        $product = new Product();
        $cart = new Cart();
        $this->assertEquals(true, $cart->addProduct($product));
    }
    public function product_quantity()
    {
        $product = new Product();
        $cart = new Cart();
        $product->setQuantity(10);
        $this->assertGreaterThan(0, $product->getQuantity());
    }

    /** @test */

    public function add_new_product_or_increase_quantity()
    {
        $cart = new Cart();
        $product1 = new Product();
        $product2 = new Product();
        $product1->setName("A");
        $product2->setName("A");
        $product1->setQuantity(20);
        $product2->setQuantity(5);
        $this->assertTrue($cart->addProduct($product1));//if product is a new, method will add product and return True
        $this->assertTrue($cart->addProd0uct($product2));
        $this->assertEquals(15,$product2->getQuantity());
    }



}


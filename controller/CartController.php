<?php

require "controller/AbstractController.php";
require "model/ProductManager.php";

class CartController extends AbstractController
{
    //?ctrl=cart
    public function index()
    {

        $manager = new ProductManager();
        $products = $manager->findAll();

        return $this->render("store/recap.php", [
            "products" => $products,
        ]);
        
    }
}
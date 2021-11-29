<?php
require "controller/AbstractController.php";
require "model/ProductManager.php";

class AdminController extends AbstractController
{
    //?ctrl=admin&action=index
    public function index()
    {
        if(!$this->isGranted("ROLE_ADMIN")) return false;

        $manager = new ProductManager();
        $products = $manager->findAll();

        return $this->render("admin/home.php", [
            "products" => $products
        ]);
    }

    //?ctrl=admin&action=addProduct
    public function addProduct()
    {
        if(!$this->isGranted("ROLE_ADMIN")) return false;

        if(Form::isSubmitted()){
            $name = Form::getData("name", "text");
            $price = Form::getData("price", "float", FILTER_FLAG_ALLOW_FRACTION);
            $descr = Form::getData("descr", "text");

            if($name && $price && $descr){
                $manager = new ProductManager();
                if($newId = $manager->insertProduct($name, $price, $descr)){
                    
                    $this->addFlash("success", "Le produit est entré en base de données !!");
                    return $this->redirect("?ctrl=store&action=product&id=$newId");
                }
                else $this->addFlash("error", "Erreur de BDD !!");
            }
            else $this->addFlash("error", "Veuillez vérifier les données du formulaire");

            return $this->redirect("?ctrl=admin");
        }
        else return false;
    }
}
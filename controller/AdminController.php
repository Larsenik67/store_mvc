<?php
require "controller/AbstractController.php";
require "model/ProductManager.php";

class AdminController extends AbstractController
{
    //?ctrl=admin
    public function index($id)
    {
        if(!$this->isGranted("ROLE_ADMIN")) return false;

        $manager = new ProductManager();
        $products = $manager->findAll();
        $action = "?ctrl=admin&action=addProduct";
        
        if($prod = $manager->findOneById($id)){
            $action = "?ctrl=admin&action=updateProduct&id=$id";
        }

        return $this->render("admin/home.php", [
            "products" => $products,
            "prod" => $prod,
            "action" => $action
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

    //?ctrl=admin&action=updateProduct
    public function  updateProduct($id)
    {
        if(!$this->isGranted("ROLE_ADMIN")) return false;

        if(Form::isSubmitted()){
            $manager = new ProductManager();
            $name = Form::getData("name", "text");
            $price = Form::getData("price", "float", FILTER_FLAG_ALLOW_FRACTION);
            $descr = Form::getData("descr", "text");

            if($id && $name && $price && $descr){
                if($manager->updateProduct($id, $name, $price, $descr)){
                    return $this->redirect("?ctrl=store&action=product&id=$id.php");
                }
            }
            else return false;
        }

    }
    //?ctrl=admin&action=deleteProduct
    public function  deleteProduct($id)
    {
        if(!$this->isGranted("ROLE_ADMIN")) return false;
            
            $manager = new ProductManager();

            if($id && $manager->deleteProduct($id)){

                $this->addFlash("success", "Produit supprimé en base de données !");
                return $this->redirect("?ctrl=admin");
                
            }
            else $this->addFlash("error", "Veuillez vérifier les données du formulaire");
    }
}
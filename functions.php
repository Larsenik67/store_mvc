<?php
//bonus : trouver où faire cette fonction pour pouvoir supprimer ce fichier ensuite !!!
    function getFullQtt(): int
    {
        if(isset($_SESSION['products']) && !empty($_SESSION['products'])){
            return array_reduce($_SESSION["products"], function($acc, $prod){
                return $acc + $prod["qtt"];
            }, 0);
        }
        else return 0;
    }

  
    

    

<?php

$key = "products";

if(Session::get($key)){
    ?>
     <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalGeneral = 0;
            
            foreach(Session::get($key) as $index => $product){
                //on calcule le total de la ligne ici
                $totalLigne = $product['price']*$product['qtt'];
                ?>
                <tr>
                    <td><a href='traitement.php?action=deleteProd&id=<?=$index?>'>Supprimer</a></td>
                    <td><?= $product['name'] ?></td>
                    <td><?= number_format($product['price'], 2, ",", "&nbsp;") ?>&nbsp;€</td>
                    <td>
                        <a href='traitement.php?action=updateQtt&id=<?= $index ?>&mode=decr'>&minus;</a>
                        <?= $product['qtt'] ?>
                        <a href='traitement.php?action=updateQtt&id=<?= $index ?>&mode=incr'>&plus;</a>
                    </td>
                    <td><?= number_format($totalLigne, 2, ",", "&nbsp;")?>&nbsp;€</td>
                </tr>
                <?php
                $totalGeneral += $totalLigne;
            }
            ?>
            <tr>
                <td colspan=3></td>
                <td><?= getFullQtt() ?></td>
                <td><strong><?= number_format($totalGeneral, 2, ",", "&nbsp;") ?>&nbsp;€</strong></td>
            </tr>
        </tbody>
    </table>
    <p>
        <a href='traitement.php?action=deleteAll'>Vider le panier</a>
    </p>
    <?php
}
else{
    
    ?>
   
        <p>Aucun produit en session...</p>

    <?php
    }
?>
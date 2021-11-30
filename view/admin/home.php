<?php
    //on récupère quoi qu'il arrive TOUS les produits pour les lister en bas de page
    $products = $response["data"]["products"];
    $prod = $response["data"]["prod"];
    $action = $response["data"]["action"];

    ?>

    <h1>Ajouter un produit</h1>
    <form action="<?= $action ?>" method="post">
        <p>
            <label>
                Nom du produit :
                <input type="text" name="name" value="<?php $prod ? $prod['name'] : "" ?>">
            </label>
        </p>
        <p>
            <label>
                Prix du produit :
                <input type="number" step="any" name="price" value="<?= $prod ? $prod['price'] : "" ?>">
            </label>
        </p>
        <p>
            <label>
                Description du produit :
                <textarea name="descr" rows=3><?php $prod ? $prod['description'] : "" ?></textarea>
            </label>
        </p>
        <p>
            <input type="submit" value="Valider">
        </p>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>PRICE</th>
                <th>DESCRIPTION</th>
                <th>OPTIONS</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($products as $prod){
            ?>
            <tr>
                <td><?= $prod["id"] ?></td>
                <td><?= $prod["name"] ?></td>
                <td><?= $prod["price"] ?></td>
                <td><?= $prod["description"] ?></td>
                <td>
                    <a href="?ctrl=admin&action=index&id=<?= $prod["id"] ?>">MODIFIER</a> - 
                    <a href="?ctrl=admin&action=deleteProduct&id=<?= $prod['id'] ?>"
                        onclick="confirmDelete('<?= $prod['name'] ?>')">
                        SUPPRIMER
                    </a>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
        <div id="modal">
            <h1>ALERTE</h1>
            <p>Vous allez supprimer le produit <span class="modal__name"></span>, confirmer ?</p>
            <p id="modal-actions">
                <a class="modal-actions__confirm" href="">Confirmer</a>
                <a class="modal-actions__cancel" href="#">Annuler</a>
            </p>
        </div>
    </table>
    <script src="<?= JS_PATH ?>script.js"></script
<?php
//function ajout dans la base de donner le produit
 function ajouter($nom,$prix,$description,$productLine,$stock,$image)
 {
     if(require("connexionDataBase.php"))
     {
       $req = $access-> prepare ("INSERT INTO product(productLine,productName,productDescription,quantityStock,sellingPrice,productImage) 
       VALUES($productLine,$nom,$description,$stock,$prix,$image)");
        
        $req-> execute (array($nom,$prix,$description,$productLine,$stock,$image));

       $req-> closeCursor();
    }
 }

function afficher()
{
    if(require("connexionDataBase.php"))
    {
        $req = $access-> prepare ("SELECT * FROM product ORDER BY id DESC");
        
        $req-> execute();

        $data=$req->fetchAll(PDO::FETCH_OBJ);

        return $data;

        $req->closeCursor();
    }
}

function supprimer($id)
{
    if(require("connexionDataBase.php"))
    {
        $req = $access-> prepare ("DELETE  FROM product WHERE id=?");

        $req->execute(array($id));
    }
}

?>
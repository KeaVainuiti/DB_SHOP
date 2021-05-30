<?php
include("connexion_bdd.php");


class dbshoop {
    
    /**
     * Delete book selected from "books"
     *
     * @param int $id 
     *
     */
    public function  deleteDbShoop($id){
        
        global $connect_bdd; 
        //sql to delete a record
        $request_delete = "DELETE FROM books WHERE id=".$id;
        // execute la requête précédente
        $res_delete = $connect_bdd->query($request_delete);
        return $res_delete;
    }

    /**
     * Delete book selected from "books"
     *
     * @param int $id 
     *
     */
    public function  editDbShoop($id){
        
        global $connect_bdd; 
        //sql to edit a recording
        $request_edit = $id_click = $_POST['id_book'];
        // execute la requête précédente
        $res_edit = $connect_bdd->query($request_edit);
        return $res_edit;

    }
    
    /**
     * Description of function 
     *
     * @return $res_listBooks
     */
    public function getDbShoop(){
        global $connect_bdd; 

        // $ sql: contains the sql request
        $request_listBooks = "SELECT * from books" ; 
        // $ result: execute the request $ sql
        $res_listBooks = $connect_bdd->query($request_listBooks); 
        return $res_listBooks;

    }

        
    /**
     * create dbshoop into "books"
     *
     * @param string $name
     * @param int $price
     *
     */
    public function createDbShoop($name, $price, $quantity_stoks , $purchase_date, $publication_date){

        global $connect_bdd;

        $request_insert = "INSERT INTO `books` (`name`,`price`,`quantity_stoks`,`purchase_date`,`publication_date`) VALUES ('".$name."' , ".$price." , ".$quantity_stoks." , \"".$purchase_date."\" , \"".$publication_date."\" )";
        $res_create = $connect_bdd->query($request_insert);
        return $res_create;
    }

    /**
     * Update DbShoop "books"
     *
     * @param string $new_name 
     * @param int $new_price 
     * @param int $id_book
     *
     */
    public function updateDbShoop($new_name,$new_price,$new_quantity_stoks,$new_purchase_date,$new_publication_date,$id_book){
        global $connect_bdd;

        $request_update = "UPDATE `Books` SET `name`= '".$new_name."',`price`= '".$new_price."', `quantity_stoks`= '".$new_quantity_stoks."', `purchase_date`= '".$new_purchase_date."', `publication_date`= '".$new_publication_date."' WHERE id =".$id_book;
        $res_update = $connect_bdd->query($request_update);
        return $res_update;
    }
}
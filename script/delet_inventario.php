<?php

session_start();
include "connection.php";

if(isset($_SESSION['idProdutor'])){

if (isset($_GET['id'])) {
    $del_id = $_GET['id'];

    if (!empty($del_id)) {

        /** deletar o estoque primeiro */
        $sql_estoque = "SELECT * FROM estoque WHERE idInventario = '$del_id'";
        $result_estoque = mysqli_query($conn,$sql_estoque);

        if(mysqli_num_rows($result_estoque) > 0){
            $sql_delete_estoque = "DELETE FROM estoque WHERE idInventario ='$del_id'";
            $result_delete_estoque = mysqli_query($conn,$sql_delete_estoque);
            
            if($result_delete_estoque){
                echo "estoque deletado";
            }
        }

        $sql = "DELETE FROM inventario WHERE idInventario ='$del_id'";
        try {
            $result = mysqli_query($conn, $sql);
        } catch (Exception $e) {
            header("Location: ../dashboard/sidebar_inventario.php?e=a87ff679a2f3e71d9181a67b7542122c");
            exit();
        }
        if ($result) {
            header("Location: ../dashboard/sidebar_inventario.php?e=c81e728d9d4c2f636f067f89cc14862c");
            exit();
        }
    }
} else {
    header("Location: ../dashboard/sidebar_inventario.php ");
    exit();
}
}else{ 
    header("Location: ../index.php");
    exit();
}

?>
<?php

session_start();
include "connection.php";


if (isset($_GET['id'])) {
    $del_id = $_GET['id'];
    $id_user = $_SESSION['idProdutor'];

    if($id_user == $del_id){

        header("Location: ../dashboard/sidebar_usuario.php?e=6512bd43d9caa6e02c990b0a82652dca");
        exit();
    }

    if (!empty($del_id)) {

        /** deletar o estoque primeiro */
        $sql_estoque = "SELECT * FROM estoque WHERE idProdutor = '$del_id'";
        $result_estoque = mysqli_query($conn,$sql_estoque);

        if(mysqli_num_rows($result_estoque) > 0){
            $sql_delete_estoque = "DELETE FROM estoque WHERE idProdutor ='$del_id'";
            $result_delete_estoque = mysqli_query($conn,$sql_delete_estoque);
            
            if($result_delete_estoque){
                echo "estoque deletado";
            }
        }

                /** deletar o animal primeiro */

        $sql_animal = "SELECT * FROM animal WHERE idProdutor = '$del_id'";
        $result_animal = mysqli_query($conn,$sql_animal);

        if(mysqli_num_rows($result_animal) > 0){
            $sql_delete_animal = "DELETE FROM animal WHERE idProdutor ='$del_id'";
            $result_delete_animal = mysqli_query($conn,$sql_delete_animal);
            
            if($result_delete_animal){
                echo "animal deletado";
            }
        }

                        /** deletar o rebanho primeiro */

        $sql_rebanho = "SELECT * FROM rebanho WHERE idProdutor = '$del_id'";
        $result_rebanho = mysqli_query($conn,$sql_rebanho);

        if(mysqli_num_rows($result_rebanho) > 0){
            $sql_delete_rebanho = "DELETE FROM rebanho WHERE idProdutor ='$del_id'";
            $result_delete_rebanho = mysqli_query($conn,$sql_delete_rebanho);
            
            if($result_delete_rebanho){
                echo "rebanho deletado";
            }
        }
                /** deletar o inventario primeiro */

        $sql_inventario = "SELECT * FROM inventario WHERE idProdutor = '$del_id'";
        $result_inventario = mysqli_query($conn,$sql_inventario);

        if(mysqli_num_rows($result_inventario) > 0){
            $sql_delete_inventario = "DELETE FROM inventario WHERE idProdutor ='$del_id'";
            $result_delete_inventario = mysqli_query($conn,$sql_delete_inventario);
            
            if($result_delete_inventario){
                echo "inventario deletado";
            }
        }

                        /** deletar a categoria primeiro */

        $sql_categoria = "SELECT * FROM categoria WHERE idProdutor = '$del_id'";
        $result_categoria = mysqli_query($conn,$sql_categoria);

        if(mysqli_num_rows($result_categoria) > 0){
            $sql_delete_categoria = "DELETE FROM categoria WHERE idProdutor ='$del_id'";
            $result_delete_categoria = mysqli_query($conn,$sql_delete_categoria);
            
            if($result_delete_categoria){
                echo "categoria deletado";
            }
        }




        $sql = "DELETE FROM usuario WHERE idProdutor ='$del_id'";
        try {
            $result = mysqli_query($conn, $sql);
        } catch (Exception $e) {
            header("Location: ../dashboard/sidebar_usuario.php?erro ao deletar");
            exit();
        }
        if ($result) {
            header("Location: ../dashboard/sidebar_usuario.php?e=eccbc87e4b5ce2fe28308fd9f2a7baf3");
            exit();
        }
    }
} else {
    header("Location: ../dashboard/sidebar_usuario.php?erro ao deletar");
    exit();
}


?>
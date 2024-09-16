<?php

session_start();
include "connection.php";



if (isset($_GET['id'])) {
    $del_id = $_GET['id'];

    if (!empty($del_id)) {
        $sql = "DELETE FROM estoque WHERE IdEstoque ='$del_id'";
        try {
            $result = mysqli_query($conn, $sql);
        } catch (Exception $e) {
            header("Location: ../dashboard/sidebar_estoque.php?e=a87ff679a2f3e71d9181a67b7542122c");
            exit();
        }
        if ($result) {
            header("Location: ../dashboard/sidebar_estoque.php?e=c81e728d9d4c2f636f067f89cc14862c");
            exit();
        }
    }
} else {
    header("Location: ../dashboard/sidebar_estoque.php ");
    exit();
}


?>
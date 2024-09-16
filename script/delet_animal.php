<?php

session_start();
include "connection.php";

if(isset($_SESSION['idProdutor'])){

if (isset($_GET['id'])) {
    $del_id = $_GET['id'];

    if (!empty($del_id)) {
        
        $sql_1 = "DELETE FROM estoque WHERE idAnimal  = '$del_id'";
        $result1 = mysqli_query($conn, $sql_1);


        $sql = "DELETE FROM animal WHERE IdAnimal ='$del_id'";
        $result = mysqli_query($conn, $sql);

        
               
            if($result1){
                if ($result) {
                header("Location: ../dashboard/sidebar_animal.php?e=c81e728d9d4c2f636f067f89cc14862c");
                exit();
            }else{
                header("Location: ../dashboard/sidebar_animal.php?e=a87ff679a2f3e71d9181a67b7542122c");
                exit();
            }
            }
            
        }
        
    
} else {
    header("Location: ../dashboard/sidebar_animal.php ");
    exit();
}
}else{ 
    header("Location: ../index.php");
    exit();
}

?>
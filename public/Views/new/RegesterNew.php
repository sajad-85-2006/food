<?php

if ($_POST['delete']){
    require '../../../Core/detabese.php';
    $user_88 = new detabese();
    $user_88->connect();
    $link=$user_88->link;
    $SQL = "DELETE FROM regester WHERE id = ?";
    $stmt =$link->prepare($SQL);
    $stmt->bindValue(1,$_POST['delete']);
    $stmt->execute();
    header('location: http://meno.food/Views/page/adminPanel.php');
    exit;
}else{
//    header('location: http://meno.food');
    var_dump($_POST);
}
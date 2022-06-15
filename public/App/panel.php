<?php
require '../../Core/detabese.php';
$user_88 = new detabese();
$user_88->connect();
$link=$user_88->link;
session_start();
if ($_POST['user']&&$_POST['password']) {
    $SQL = 'select * from login where  user = ? ';
    $w = $link->prepare($SQL);
    $w->bindValue(1,$_POST['user']);
    $w->execute();
    $SQL_1='SELECT ID FROM login ORDER BY ID DESC';
    $user_5=$link->query($SQL_1);
    $r=$user_5->fetch()['ID'];
    var_dump($r);
    if ($user_1 = $w->fetch()){
        if ($_POST['password']==$user_1['password']){
            $_SESSION['admin']=$r;
            header('location: http://meno.food/Views/page/adminPanel.php');

        }else{
            header('location: http://meno.food/page/Views/login.php');

        }
    }else{
        header('location: http://meno.food/page/Views/login.php');
    }
}
else{
    header('location: http://meno.food/page/Views/login.php');

}
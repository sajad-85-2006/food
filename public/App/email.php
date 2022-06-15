<?php
session_start();
if ($_SESSION['user']){
    $sajad=json_encode($_SESSION['food']);
    require '../../Core/detabese.php';
    $user = new detabese();
    $user->connect();
    $link=$user->link;
    $sql = 'select * from regester where id = ?';
    $stmt = $link->prepare($sql);
    $stmt->bindValue(1,$_SESSION['user']);
    $stmt->execute();
    $regester = $stmt->fetch();
    $SQL = 'INSERT INTO order_food (name,lastname,address,email,food,phone) VALUES (?,?,?,?,?,?)';
    $user = $link->prepare($SQL);
    $user->bindValue(1,$regester['name']);
    $user->bindValue(2,$regester['lastname']);
    $user->bindValue(3,$regester['adress']);
    $user->bindValue(4,$regester['email']);
    $user->bindValue(5,$sajad);
    $user->bindValue(6,$regester['phone']);
    $user->execute();
    if ($stmt){
        $from = "prj.sajad85@mihanwp.com";
        $to = $regester['email'];
        $subject = "Checking PHP mail";
        $message = "PHP mail works just fine";
        $headers = "From:" . $from;
        mail($to,$subject,$message, $headers);
        echo "The email message was sent.";
        unset($_SESSION['food']);
        header('location: http://meno.food?event=good');
    }else{
        header('location: http://meno.food?event=bad');

    }
}else{
    header('location:http://meno.food/Views/page/register.php');
}
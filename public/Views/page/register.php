<?php
session_start();
if ($_SESSION['user']){
    header('location:http://meno.food/App/email.php');

}
if ($_POST && !$_SESSION['user']){
    if ($_POST['phone']&&$_POST['name']&&$_POST['LastName']&&$_POST['email']&&$_POST['phone_home']&&$_POST['address']){
        require '../../../Core/detabese.php';
        $user = new detabese();
        $user->connect();
        $link=$user->link;
        $SQL = 'INSERT INTO regester (phone, name, lastname, email, phoneHome, adress) VALUES (?,?,?,?, ?, ?)';
        $stmt = $link->prepare($SQL);
        $stmt->bindValue(1,$_POST['phone']);
        $stmt->bindValue(2,$_POST['name']);
        $stmt->bindValue(3,$_POST['LastName']);
        $stmt->bindValue(4,$_POST['email']);
        $stmt->bindValue(5,$_POST['phone_home']);
        $stmt->bindValue(6,$_POST['address']);
        $stmt->execute();
        $SQL_1='SELECT ID FROM regester ORDER BY ID DESC';
        $user=$link->query($SQL_1);
        $_SESSION['user']=$user->fetch()[0];
        header('location:http://meno.food/App/email.php');
    }
}

?>
<html>
<head>
    <link rel="stylesheet" href="../../Style/login.css">
</head>
<body style="background: ghostwhite">
<div class="div_big">
    <h2 style="color: grey;">
        register
    </h2>
    <hr>
    <form action="register.php" method="post">
        <section class="input_1" >
            <input class="input" name="name" type="text" placeholder="your name">
        </section>
        <section class="input_1" >
            <input class="input" name="LastName" type="text" placeholder="your lastName ">
        </section>
        <section class="input_1" >
            <input class="input" name="phone" type="tel" placeholder="your phone">
        </section>
        <section class="input_1" >
            <input class="input" name="phone_home" type="tel" placeholder="your home phone">
        </section>
        <section class="input_1" >
            <input class="input" name="address" type="text" placeholder="your address">
        </section>
        <section class="input_1" >
            <input class="input" name="email" type="text" placeholder="your email">
        </section>
        <button class="btn_2" style="display:block">register</button>
    </form>
</div>
</body>
</html>
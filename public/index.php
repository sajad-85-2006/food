<?php
session_start();
error_reporting (~E_WARNING);
require '../Core/commponet.php';
require '../Core/app.php';
require 'Views/part/header.php';
$l = new commponet();
$a = new app();
require '../Core/detabese.php';
$user = new detabese();
$user->connect();
$link=$user->link;
if (isset($_GET['search'])||isset($_GET['food'])||isset($_GET['available'])){
    $SQL='select * from meno where name like ? AND food like ? AND available like ?';
    $w=$link->prepare($SQL);
    $w->bindValue(1,'%'.$_GET['search'].'%');
    $w->bindValue(2,'%'.$_GET['food'].'%');
    $w->bindValue(3,$_GET['available'].'%');
    $w->execute();
}else{
    $SQL='select * from meno ';
    $w=$link->query($SQL);
}

$sql_1 = 'select * from meno';
$qu =$link->query($sql_1);
$fetchAll =$qu->fetchAll();

if ($_POST){
    $ini = $_POST['id'];

    foreach ($fetchAll as $f){
        if (in_array($ini , $f)){

            if ($_SESSION['food']){
                $_SESSION['food']=[...$_SESSION['food'],$ini];
                header('location: http://meno.food?event=ok');
            }else{
                $_SESSION['food']=[$ini];
                header('location: http://meno.food?event=ok');

            }
        }
    }
}

$ara = [];
$off = 0;

?>

    <html>
    <head>
        <title>

        </title>
        <link rel="stylesheet" href="Style/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    </head>
    <body>
    <div>
        <?php
        $a->msg($l);
        modal();
        ?>
        <div class="div">
            <div>
                <p id="paragraf"></p>
                <form action="/" method="get">
                    <input name="search" type="search" value="<?= $_GET['search'] ?>" placeholder="search...">
                    <select name="available">
                        <option value="">What price do you want for food?</option>
                        <option value="available"  <?= $_GET['available']=='available'?'selected':'' ?>>available</option>
                        <option <?= $_GET['available']=='unavailable'?'selected':'' ?>>unavailable</option>
                    </select>
                    <select name="food">
                        <option></option>
                        <?php
                        $SQL_3='select * from food ';
                        $stmt_3= $link->query($SQL_3);
                        while ($user_1=$stmt_3->fetch()){
                            ?>
                            <option value="<?= $user_1['food'] ?>" ><?= $user_1['food'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <button class="btn">search</button>
                </form>
                <hr style="margin-right: auto;margin-left: auto;display: block;width: 90%;opacity: 60%">
            </div>
            <div style="margin: 50px">
                <?php
                while ($fetch=$w->fetch()){

                    ?>
                    <div class="card">
                        <div class="img" style="background-image: url('Views/IMG/<?=$fetch['img'] ?>')">

                        </div>
                        <span class="fa fa-dot-circle-o icon_1" style="<?=$fetch['available']=='available'?'color: green':'color: red' ?>"><?=$fetch['available']?></span>
                        <h1><?=$fetch['name'] ?></h1>
                        <p class="price">$<?=$fetch['price'] ?></p>
                        <p><?=$fetch['caption'] ?></p>
                        <form action="/" method="post">
                            <select <?=$fetch['available']=='available'?'':'disabled' ?> style="display: none" name="id">
                                <option value="<?=$fetch['id'] ?>"><?=$fetch['name'] ?></option>
                            </select>
                            <p><button <?=$fetch['available']=='available'?'':'disabled' ?>  >Add to Cart</button></p>
                        </form>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal">

        <div class="modal-content">
            <span class="close">&times;</span>

            <h3 style="color: #727272">your cart:</h3>
            <hr style="border-color: #f5f5f5">
            <?php
            if ($_SESSION['food']){
                ?>
                <div>
                    <table id="myTable">
                        <thead>
                        <tr class="header">
                            <th style="width:10%;">image</th>
                            <th style="width:20%;">name</th>
                            <th style="width:40%;">caption</th>
                            <th style="width:20%;">price</th>
                            <th style="width:10%;">...</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($_SESSION['food'] as $for){
                            for ($n=0; $n < count($fetchAll); $n++){
                                if ($for == $fetchAll[$n]['id']){
                                    array_push($ara,$fetchAll[$n]['price']);


                                    ?>
                                    <tr>

                                        <td>
                                            <div class="img_div" style="background-image: url('Views/IMG/<?=$fetchAll[$n]['img'] ?>') "></div>
                                        </td>
                                        <td><?=$fetchAll[$n]['name']?></td>
                                        <td><?=$fetchAll[$n]['caption']?></td>
                                        <td>$<?=$fetchAll[$n]['price']?></td>
                                        <td>
                                            <form action="App/delete.php" method="post">
                                                <input value="<?=$for ?>" name="delete" style="display: none">
                                                <button style="background: none;border: none;color: red" class="fa fa-times"></button>
                                            </form>
                                        </td>
                                    </tr>

                                    <?php

                                }
                            }
                        }
                        ?>
                        </tbody>
                    </table>

                    <div style="display: inline-block;">
                        <h3 style="font-size: 15px ; color: grey">Total purchase: $<?=array_sum($ara) ?></h3>
                        <h3 style="font-size: 15px ; color: grey">Collect discounts: <?=$off ?></h3>
                        <h3 style="font-size: 18px ;">Total purchases with discounts account: $<?=array_sum($ara)-$off ?></h3>
                    </div>
                    <form method="post" action="App/email.php">
                        <input name="shope" value="shope" style="display: none">
                        <button class="btn_1">Buy$</button>
                    </form>
                </div>
                <?php
            }else{
                ?>
                <h3 style="text-align: center;color: grey">cart is empty</h3>
                <?php
            }
            ?>
        </div>

    </div>
    </body>
    </html>
<?php
$l->modal('myModal','myBtn');

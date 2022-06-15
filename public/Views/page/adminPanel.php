<?php
//error_reporting(~E_ALL);
session_start();
if ($_SESSION['admin']){
    require '../part/meno.php';
    require '../../../Core/detabese.php';
    $user_88 = new detabese();
    $user_88->connect();
    $link=$user_88->link;
    $SQL ='select * from login where id = ?';
    $stmt=$link->prepare($SQL);
    $stmt->bindValue(1,$_SESSION['admin']);
    $stmt->execute();
    $user_5 = $stmt->fetch();
    ?>
    <html>
    <head>
        <link rel="stylesheet" href="../../Style/style.css">
        <link rel="stylesheet" href="../../Style/admin.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    </head>
    <body>
    <header>
        <div class="">

            <a href="../../index.php"><button id="myBtn" style="background: none;color: whitesmoke;border: none" class="fa fa-home icon"></button><a/>
                <div class="dropdown">
                    <a style="color: whitesmoke;text-decoration: none"  class="fa fa-user icon dropbtn"></a>
                    <!--                    <button class="dropbtn">Dropdown</button>-->
                    <div class="dropdown-content">
                        <a href="../../App/delete.php">exit</a>

                    </div>
                </div>
        </div>
        <div>
            <div class="topnav" id="myTopnav">
                <a href="#meno" class="active">meno</a>
                <a href="#order">order</a>
                <a href="#regester">regester</a>
                <?php
                if ($user_5['level']=='1'){
                    ?>
                    <a href="#login">login</a>
                    <?php
                }
                ?>
            </div>
        </div>
    </header>
    <div>
        <?=meno($link)?>
        <div class="div_table">
            <?php
    if (isset($_GET['order'])) {
        $order = $link->prepare('select * from order_food where name like ?');
        $order->bindValue(1, '%' . $_GET['order'] . '%');
        $order->execute();
    }else{
        $order = $link->query('select * from order_food ');

    }
            $order_1 = $link->query('select * from meno');
            $s=count($order_1->fetchAll());

            $q=$order_1->fetch();
            ?>
            <h2 style="color: grey">order food</h2>
            <hr style="border: 1px solid gainsboro  !important;">
            <form action="adminPanel.php">
                <input type="text" id="myInput" name="order" placeholder="Search for names..">
            </form>
            <div style="width: 100%;overflow: auto;height: 350px">
                <table id="order" class="myTable">
                    <thead >

                    <tr class="header">
                        <th>name</th>
                        <th>address</th>
                        <th>email</th>
                        <th>food</th>
                        <th>phone</th>
                        <th>...</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($order_loop =$order->fetch()){
                        ?>
                        <tr>
                            <td><?= $order_loop['name'].' '. $order_loop['lastname'] ?></td>
                            <td><?= $order_loop['address'] ?></td>
                            <td><?= $order_loop['email'] ?></td>
                            <td>
                                <?php
                                $sajad=json_decode($order_loop['food']);
                                foreach ($sajad as $a){
                                    $order_2 = $link->prepare('select * from meno where id = ?');
                                    $order_2->bindValue(1,$a);
                                    $order_2->execute();
                                    echo $order_2->fetch()['name'].' / ';
                                }

                                ?>
                            </td>
                            <td><?= $order_loop['phone'] ?></td>
                            <td>
                                <form action="../new/OrderNew.php" method="post">
                                    <input name="delete" value="<?=$order_loop['id'] ?>"  style="display: none">
                                    <button class="fa fa-times " style="color: red;background: none;border: none;padding: 0"></button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="div_table">
            <?php
    if (isset($_GET['regester'])) {

        $regester = $link->prepare('select * from regester where name like ?');
        $regester->bindValue(1, '%' . $_GET['regester'] . '%');
        $regester->execute();
    }
    else{
        $regester = $link->query('select * from regester');

    }
            ?>
            <h2 style="color: grey">meno food</h2>
            <hr style="border: 1px solid gainsboro  !important;">
            <form action="adminPanel.php">
                <input type="text" id="myInput" name="regester" placeholder="Search for names..">
            </form>
            <div style="width: 100%;overflow: auto;height: 350px">
                <table  id="regester" class="myTable">
                    <thead >

                    <tr class="header">
                        <th>img</th>
                        <th>name</th>
                        <th>caption</th>
                        <th>food</th>
                        <th>price</th>
                        <th>available</th>
                        <th>...</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($regester_loop =$regester->fetch()){
                        ?>
                        <tr>
                            <td><div class="img_tabel" style="background: url('https://sothis.es/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png')"></div></td>
                            <td><?=  $regester_loop['name'].' '. $regester_loop['lastname']  ?></td>
                            <td><?= $regester_loop['email'] ?></td>
                            <td><?= $regester_loop['phoneHome'] ?></td>
                            <td><?= $regester_loop['adress'] ?></td>
                            <td><?= $regester_loop['phone'] ?></td>
                            <td>
                                <form action="../new/RegesterNew.php" method="post">
                                    <input name="delete" value="<?=$regester_loop['id'] ?>"  style="display: none">
                                    <button class="fa fa-times " style="color: red;background: none;border: none;padding: 0"></button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>

            </div>
        </div>
        <?php
        if ($user_5['level']=='1'){
            ?>
            <div class="div_table">
                <?php
            if (isset($_GET['login'])) {
                $login = $link->prepare('select * from login where "user" like ?');
                $login->bindValue(1, '%' . $_GET['login'] . '%');
                $login->execute();
            }else{
                $login = $link->query('select * from login');

            }
                ?>
                <h2 style="color: grey">login food</h2>
                <hr style="border: 1px solid gainsboro  !important;">
                <form action="adminPanel.php">
                    <input type="text" id="myInput" name="login" placeholder="Search for names..">
                </form>
                <div style="width: 100%;overflow: auto;height: 350px">
                    <table id="login" class="myTable">
                        <thead >

                        <tr class="header">
                            <th>img</th>
                            <th>user</th>
                            <th>pass</th>
                            <th>level</th>
                            <th>...</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($login_loop =$login->fetch()){
                            ?>
                            <tr>
                                <td><div class="img_tabel" style="background: url('https://sothis.es/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png')"></div></td>
                                <td><?= $login_loop['user'] ?></td>
                                <td><?= $login_loop['password'] ?></td>
                                <td><?= $login_loop['level'] ?></td>
                                <td>
                                    <form action="../new/LoginNew.php" method="post">
                                        <input name="delete" value="<?=$login_loop['id'] ?>"  style="display: none">
                                        <button class="fa fa-times " style="color: red;background: none;border: none;padding: 0"></button>
                                    </form>
                                    <form action="../new/LoginNew.php" method="post">
                                        <input name="id" value="<?=$login_loop['id'] ?>"  style="display: none">
                                        <button  class="fa fa-edit" style="color: green;background: none;border: none;padding: 0"></button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <form action="../new/LoginNew.php" method="post">
                    <input name="new" value="new"  style="display: none">
                    <button class="btn_suc">New +</button>
                </form>
            </div>
            <?php
        }
        ?>
    </div>
    </body>
    </html>
    <?php
}else{
    header('location: http://meno.food/Views/page/login.php');
}
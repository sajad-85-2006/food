<?php
if ($_POST){
    error_reporting(~E_WARNING);
    require '../../../Core/detabese.php';
    $user_88 = new detabese();
    $user_88->connect();
    $link=$user_88->link;
    if ($_POST['id']){
        $SQL_2='select * from login where id = ?';
        $stmt_2= $link->prepare($SQL_2);
        $stmt_2->bindValue(1,$_POST['id']);
        $stmt_2->execute();
        $user=$stmt_2->fetch();
    }
    if ($_POST['form']){

        if ($_POST['id']){
            if ($_POST['password']==$_POST['password_2']) {
                $SQL_1 = 'UPDATE login SET user = ? , password = ? , level = ?  WHERE id = ?';
                $stmt_1 = $link->prepare($SQL_1);
                $stmt_1->bindValue(1, $_POST['user']);
                $stmt_1->bindValue(2, $_POST['password']);
                $stmt_1->bindValue(3, $_POST['level']);
                $stmt_1->bindValue(4, $_POST['id']);
                $stmt_1->execute();
                header('location: http://meno.food/Views/page/adminPanel.php');
                exit;
            }
        }else{
            $SQL_6 = 'select * from login where  user = ? ';
            $w = $link->prepare($SQL_6);
            $w->bindValue(1,$_POST['user']);
            $w->execute();
            if ($_POST['password']==$_POST['password_2']&&!$w->fetch()){
                $SQL_1='INSERT INTO login ( user, password,level) VALUES ( ?, ?,?)';
                $stmt_1 = $link->prepare($SQL_1);
                $stmt_1->bindValue(1,$_POST['user']);
                $stmt_1->bindValue(2,$_POST['password']);
                $stmt_1->bindValue(3,$_POST['level']);
                $stmt_1->execute();
                header('location: http://meno.food/Views/page/adminPanel.php');
                exit;
            }

        }
    }
    if ($_POST['delete']){
        $SQL = "DELETE FROM login WHERE id = ?";
        $stmt =$link->prepare($SQL);
        $stmt->bindValue(1,$_POST['delete']);
        $stmt->execute();
        header('location: http://meno.food/Views/page/adminPanel.php');
        exit;
    }if ($_POST['id']||$_POST['new']){

        ?>
        <html>
        <head>
            <link rel="stylesheet" href="../../Style/admin.css">
            <link rel="stylesheet" href="../../Style/login.css">
        </head>
        <body>
        <div class="div_table">
            <h2><?=$_POST['id']?'update':'new+' ?></h2>
            <hr>
            <form action="LoginNew.php" method="post" enctype="multipart/form-data">
                <input name="form" style="display: none" value="ok" >
                <?=$_POST['id']?'<input name="id" style="display: none" value="'.$_POST['id'].'" >':'<input name="new" style="display: none" value="ok" >' ?>
                <input class="input" value="<?= $user['user'] ?>" name="user" type="text" placeholder="your username">
                <select name="level" class="input">
                    <option value="1">level:1</option>
                    <option value="2">level:2</option>
                </select>
                <section class="input_1" >
                    <input class="input" value="<?= $user['password'] ?>" name="password" type="password" placeholder="your password ">
                </section>
                <section class="input_1" >
                    <input value="<?= $user['password'] ?>"  class="input" name="password_2" type='password' placeholder="your password">
                </section>
                <button class="btn_2" style="display:block">register</button>
            </form>
        </div>
        </body>
        </html>

        <?php
    }
    else{
        header('location:http://meno.food/');
        exit;

    }
}
else{
    header('location:http://meno.food/');
    exit;


}
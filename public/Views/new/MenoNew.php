<?php
if ($_POST){
    error_reporting(~E_WARNING);
    require '../../../Core/detabese.php';
    $user_88 = new detabese();
    $user_88->connect();
    $link=$user_88->link;
    if ($_POST['id']){
        $SQL_2='select * from meno where id = ?';
        $stmt_2= $link->prepare($SQL_2);
        $stmt_2->bindValue(1,$_POST['id']);
        $stmt_2->execute();
        $user=$stmt_2->fetch();
    }
    if ($_POST['form']){

        if (file_exists($_FILES['file']['tmp_name'])){
            $path='../IMG/';
            $path .= $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'] , $path);
        }
        if ($_POST['id']){
            $SQL_1= 'UPDATE meno SET name = ? , caption = ? , price = ? , food = ? , available =? , img = ? WHERE id = ?';
            $stmt_1 = $link->prepare($SQL_1);
            $stmt_1->bindValue(1,$_POST['name']);
            $stmt_1->bindValue(2,$_POST['caption']);
            $stmt_1->bindValue(3,$_POST['price']);
            $stmt_1->bindValue(4,$_POST['food']);
            $stmt_1->bindValue(5,$_POST['available']);
            if ($_FILES['file']['size']==0 ){

                $stmt_1->bindValue(6,$user['img']);
            }else{
                $stmt_1->bindValue(6,$_FILES['file']['name']);

            }
            $stmt_1->bindValue(7,$_POST['id']);
            $stmt_1->execute();
            header('location: http://meno.food/Views/page/adminPanel.php');
            exit;

        }else{
            $SQL_1='INSERT INTO meno ( name, caption, price, food, available, img) VALUES ( ?, ?, ?, ?, ?, ?)';
            $stmt_1 = $link->prepare($SQL_1);
            $stmt_1->bindValue(1,$_POST['name']);
            $stmt_1->bindValue(2,$_POST['caption']);
            $stmt_1->bindValue(3,$_POST['price']);
            $stmt_1->bindValue(4,$_POST['food']);
            $stmt_1->bindValue(5,$_POST['available']);
            $stmt_1->bindValue(6,$_FILES['file']['name']);
            $stmt_1->execute();
            header('location: http://meno.food/Views/page/adminPanel.php');
            exit;

        }
    }
    if ($_POST['delete']){
        $SQL = "DELETE FROM meno WHERE id = ?";
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
            <form action="MenoNew.php" method="post" enctype="multipart/form-data">
                <input name="form" style="display: none" value="ok" >
                <?=$_POST['id']?'<input name="id" style="display: none" value="'.$_POST['id'].'" >':'<input name="new" style="display: none" value="ok" >' ?>
                <section class="input_1" >
                    <input class="input" value="<?= $user['name'] ?>" name="name" type="text" placeholder="your name">
                </section>
                <section class="input_1" >
                    <input class="input" value="<?= $user['caption'] ?>" name="caption" type="text" placeholder="your caption ">
                </section>
                <section class="input_1" >
                    <select name="food" class="input">
                        <?php
                        $SQL_3='select * from food ';
                        $stmt_3= $link->query($SQL_3);
                        while ($user_1=$stmt_3->fetch()){
                            ?>
                            <option value="<?= $user_1['food'] ?>" <?= $user_1['food']==$user['food']?'selected':'' ?> ><?= $user_1['food'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </section>
                <section class="input_1" >
                    <select name="available" class="input">
                        <option <?= $user['available']=='available'?'selected':'' ?> value="available">available</option>
                        <option <?= $user['available']=='unavailable'?'selected':'' ?> value="unavailable">unavailable</option>
                    </select>
                </section>
                <section class="input_1" >
                    <input value="<?= $user['price'] ?>" class="input" name="price" type='text' placeholder="your price">
                </section>
                <section class="input_1" >
                    <label class="uplode" for="file">upload photo</label>
                    <input id="file" style="display: none" name="file" type="file">
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
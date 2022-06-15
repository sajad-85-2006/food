<?php
function meno($link){
    ?>
    <div class="div_table">
        <?php
        if (isset($_GET['meno'])){
            $meno = $link->prepare('select * from meno where name like ?');
            $meno->bindValue(1,'%'.$_GET['meno'].'%');
            $meno->execute();
        }else{$meno = $link->query('select * from meno ');}
        ?>
        <h2 style="color: grey">meno food</h2>
        <hr style="border: 1px solid gainsboro  !important;">
        <form action="adminPanel.php">
            <input type="text" id="myInput" name="meno" placeholder="Search for names..">
        </form>
        <table id="meno" class="myTable">
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
            while ($meno_loop =$meno->fetch()){
                ?>
                <tr>
                    <td><div class="img_tabel" style="background: url('../IMG/<?=$meno_loop['img']?>')"></div></td>
                    <td><?= $meno_loop['name'] ?></td>
                    <td><?= $meno_loop['caption'] ?></td>
                    <td><?= $meno_loop['food'] ?></td>
                    <td><?= $meno_loop['price'] ?></td>
                    <td><?= $meno_loop['available'] ?></td>
                    <td>
                        <form action="../new/MenoNew.php" method="post">
                            <input name="delete" value="<?=$meno_loop['id'] ?>"  style="display: none">
                            <button  class="fa fa-times" style="color: red;background: none;border: none;padding: 0"></button>
                        </form>
                        <form action="../new/MenoNew.php" method="post">
                            <input name="id" value="<?=$meno_loop['id'] ?>"  style="display: none">
                            <button  class="fa fa-edit" style="color: green;background: none;border: none;padding: 0"></button>
                        </form>
                    </td>
                </tr>

                <?php

            }
            ?>
            </tbody>
        </table>
        <form action="../new/MenoNew.php" method="post">
            <input name="new" value="new" style="display: none">
            <button class="btn_suc">New +</button>
        </form>

    </div>
    <?php
}
<?php
//session_start();
function modal(){
    ?>
    <header>
        <div class="">
            <button id="myBtn" style="background: none;color: whitesmoke;border: none" class="fa fa-shopping-cart icon"></button>
            <?php
            if ($_SESSION['food']){

                ?>
                <span class="badge"><?php
                echo count($_SESSION['food']);
                ?></span><?php
            }
            ?>
            <a style="color: whitesmoke;text-decoration: none" href="Views/page/adminPanel.php" class="fa fa-user icon"></a>
        </div>
        <div>

        </div>
    </header>
<?php


}
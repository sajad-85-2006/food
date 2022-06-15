<?php
session_start();
if ($_POST['delete']) {
    for ($x = 0; $x <= 30; $x++) {
        if ($_SESSION['food'][$x] == $_POST ['delete']) {
            var_dump($x);
            unset($_SESSION['food'][$x]);
            var_dump($_SESSION['food']);
            header('location: http://meno.food?event=remove');
            exit;
        }
    }
}

else{
    session_unset();
    session_destroy();
    header('location: http://meno.food?event=bad');
}
//////
//     session_unset();
//    session_destroy();
//    header('location: http://meno.food?event=remove');
//
//}else{
//    session_unset();
//    session_destroy();
//    header('location: http://meno.food?event=bad');
//}
////session_unset();
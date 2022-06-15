<?php

class app
{
    function msg($l){
        if (isset($_GET['event'])){
            if ($_GET['event']=='remove'){
                $l->toster('remove the food','#990000','#D61C4E');
            } if ($_GET['event']=='ok'){
                $l->toster('Add to Cart ✔','#809A6F','#4B8673');
            }if ($_GET['event']=='good'&&!$_SESSION['food']){
                $l->yes('Good job!','false',"Aww yiss!","You clicked the button!","success");
            }if ($_GET['event']=='bad'){
                $l->yes('sorry!','true',"😔","There is a problem","warning");
            }
        }
    }
}

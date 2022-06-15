<?php

class detabese
{
    public $e = '';
    public $link = '';
function connect(){
    try {
        $this->e = 'mysql:host=localhost:3306;dbname=food';
        $this->link=new PDO($this->e,'root','');
    }catch (Exception $r){
        echo 'code erore: '.$r->getCode().'<br/>';
        echo 'mesage erore: '.$r->getMessage();
        exit;
    }
}
}
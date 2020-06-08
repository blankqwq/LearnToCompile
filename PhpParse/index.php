<?php

spl_autoload_register(function ($name){
   include $name.'.php';
});

$parse = new StrToToken();

var_dump($parse->statusTo('int a = 1'));
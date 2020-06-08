<?php


class SimpleTest
{
    public static function test(){
        $handler = new SimpleCalculate();
        $res = $handler->intDeclare('int a = 1');
        var_dump($res);
    }

}
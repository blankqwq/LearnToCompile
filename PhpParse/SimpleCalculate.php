<?php


class SimpleCalculate
{
    /**
     * @token('int')
     * 主要用于解析变量声明的文法
     * Int Id END
     * Int Id EQ VALUE;
     */
    public function intDeclare($string): void
    {

    }

    /**
     * @token('a+b*c')
     * @param $token
     */
    public function additionAndMulti($token): void
    {

    }

}
<?php

class TokenEnum
{
    public const END = -999;

    public const EQ = 56;
    public const GT = 55;
    public const LT = 54;
    public const STR = 30;

    public const INT_1 = 20;
    public const INT_2 = 21;
    public const INT_3 = 500;

    public const FLOAT_1 = 251;
    public const FLOAT_2 = 252;
    public const FLOAT_3 = 253;
    public const FLOAT_4 = 254;
    public const FLOAT_5 = 500;

    public const NUM = 99;
    public const ALPHA = 56;
    public const BLANK = 10;
    public const ID = 100;

    public const ADD = 60;
    public const RIDE = 65;
    public const SUB = 33;


    public const TOKEN = [
        '=' => self::EQ,
        '>' => self::GT,
        '<' => self::LT,
        'i' => self::INT_1,

        'f' => self::FLOAT_1,

        '+' => self::ADD,
        '*' => self::RIDE,
        "\0" => self::END
    ];
}
<?php

class StrToToken
{
    private const INIT_STATUS = -1;
    private $tokens;
    private $tokenText = [];
    private $token = [];
    private $status;

    public function __construct()
    {
        $this->tokens = new Tokens();
    }

    /**
     * @param $string
     * @return Tokens
     */
    public function statusTo($string)
    {
        $string .= "\0";
        $i = 0;
        $this->status = self::INIT_STATUS;
        while ($i < strlen($string)) {
            $ch = $string[$i];
            switch ($this->status) {
                case TokenEnum::SUB:
                case TokenEnum::ADD:
                case TokenEnum::RIDE:
                case TokenEnum::GT:
                case TokenEnum::BLANK:
                case TokenEnum::INT_3:
                case self::INIT_STATUS:
                    $this->initToken($ch);
                    break;
                case TokenEnum::ALPHA:
                    if (is_numeric($ch) || $this->isAlpha($ch)) {
                        $this->status = TokenEnum::ID;
                        $this->initToken($ch);
                        $this->tokenText[] = $ch;
                    } else {
                        $this->initToken($ch);
                    }
                    break;
                case TokenEnum::NUM:
                    if (is_numeric($ch)) {
                        $this->tokenText[] = $ch;
                    } else {
                        $this->initToken($ch);
                    }
                    break;
                case TokenEnum::STR:
                    if ($ch === ' ' || $ch === '=') {
                        $this->status = TokenEnum::ID;
                    }
                    $this->initToken($ch);
                    break;
                case TokenEnum::INT_1:
                    if ($ch === 'n') {
                        $this->status = TokenEnum::INT_2;
                        $this->tokenText[] = $ch;
                    } else if ($this->isAlpha($ch)) {
                        $this->status = TokenEnum::ALPHA;
                        $this->initToken($ch);
                        $this->tokenText[] = $ch;
                    }
                    break;
                case TokenEnum::INT_2:
                    if ($ch === 't') {
                        $this->status = TokenEnum::INT_3;
                        $this->tokenText[] = $ch;
                    } else {
                        $this->status = TokenEnum::ALPHA;
                        $this->initToken($ch);
                    }
                    break;
            }
            $i++;
        }
        return $this->tokens;
    }


    private function isAlpha($ch): bool
    {
        return ($ch >= 'a' && $ch <= 'z') || ($ch >= 'A' && $ch <= 'z');
    }

    private function isBlank($ch): bool
    {
        return $ch === ' ' || $ch === '\t' || $ch === '\n';
    }

    public function initToken($ch): ?int
    {
        if (count($this->tokenText) > 0) {
            $this->tokens->push($this->status, implode('', $this->tokenText));
            $this->tokenText = [];
            $this->status = self::INIT_STATUS;
        }

        if (isset(TokenEnum::TOKEN[$ch])) {
            $this->status = TokenEnum::TOKEN[$ch];
            $this->tokenText[] = $ch;
            return $this->status;
        }
        if (is_numeric($ch)) {
            $this->status = TokenEnum::NUM;
            $this->tokenText[] = $ch;
            return $this->status;
        }

        if ($this->isAlpha($ch)) {
            $this->status = TokenEnum::ALPHA;
            $this->tokenText[] = $ch;
            return $this->status;
        }

        if ($this->isBlank($ch)) {
            $this->status = TokenEnum::BLANK;
            $this->tokenText[] = $ch;
            return $this->status;
        }
    }
}
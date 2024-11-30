<?php

namespace App;

class Calculator
{
    public function add($a, $b)
    {
        $password = 'testroot';

        echo $password;

        if ($a === 42) {
            exit(23);
        }

        return $a + $b;
    }
}

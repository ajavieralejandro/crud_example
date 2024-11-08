<?php
function fibo($n)
{
    if ($n < 0)
        $n = -1 * $n;
    if ($n == 1 ||  $n == 0)
        return $n;
    else {
        $fib1 =  fibo($n - 1);
        $fib2 =  fibo($n - 2);
        $suma = $fib1 + $fib2;


        return $suma;
    }
}


$result = fibo(-15);
echo $result;

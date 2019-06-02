<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/4/5
 * Time: 20:38
 */
function carry()
{
    return function ($stack, $pipe) {

        return function ($aa) use ($stack, $pipe) {
            echo "<br>`````$aa```````<br>";
            return $pipe($aa,$stack);
            //  4 =>   $pipe($aa,$stack)  3 $pipe($aa,$pipe($aa,$stack))
            // 2 $pipe($aa,$pipe($aa,$pipe($aa,$stack)))  1  $pipe($aa,$pipe($aa,$pipe($aa,$pipe($aa,$stack))) )
        };
    };
}

function prepareDestination(Closure $destination)
{
    return function ($passable) use ($destination) {
        return $destination($passable);
    };
}
$pipe1 = function ($poster, Closure $next) {
    $poster += 1;
    echo "pipe1: $poster<br><br>";
    return $next($poster);
};
$pipe2 = function ($poster, Closure $next) {
    if ($poster > 7) return $poster;
    $poster += 3;
    echo "pipe2: $poster<br><br>";
    return $next($poster);
};
$pipe3 = function ($poster, Closure $next) {
    $result = $next($poster);
    echo "pipe3: $result\n";
    echo "<br><br>";
    return $result * 2;
};
$pipe4 = function ($poster, Closure $next) {
    $poster += 2;
    echo "pipe4 : $poster<br><br>";
    return $next($poster);
};

$pipes = [$pipe1, $pipe2, $pipe3, $pipe4];

function dispatcher($poster, $pipes)
{
    $pipeline = array_reduce(array_reverse($pipes), carry(),prepareDestination(function ($poster) {
        echo "received: $poster<br><br>";
        return 3;
    }));
    return $pipeline($poster);
}

echo "==> action 1:<br>";
echo dispatcher(5, $pipes);
echo "<br>=================== action 2:<br>";
echo dispatcher(7, $pipes);


function re($a){
    return function () use($a){
        $a .= "aaa";
        echo $a."<br>";
        return function () use ($a) {
            $a .= 'cccc';
            echo $a."<br>";
            return $a;
        };
    };
}
echo "<br>";
$aa = re('ee');
$cc = $aa();
$cc();


function callFunc($func){
    $func("argv");
}

callFunc(function($str){
    echo $str;
});

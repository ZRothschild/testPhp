<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/4/5
 * Time: 20:38
 */

require __DIR__.'/vendor/autoload.php';

use App\Module\Pipeline\Pipeline;
use App\Module\Decorator\Student;
use App\Module\Decorator\MakeUp;
use App\Module\Decorator\GetUp;
use App\Module\Decorator\School;

// ******************  匿名函数  **********************
$pipe1 = function ($poster, Closure $next) {
    $poster += 1;
    echo "pipe1: $poster<br>";
    return $next($poster);
};
$pipe2 = function ($poster, Closure $next) {
    if ($poster > 7) return $poster;
    $poster += 3;
    echo "pipe2: $poster<br>";
    return $next($poster);
};
$pipe3 = function ($poster, Closure $next) {
    $result = $next($poster);
    echo "pipe3: $result<br>";
    return $result * 2;
};
$pipe4 = function ($poster, Closure $next) {
    $poster += 2;
    echo "pipe4 : $poster<br>";
    return $next($poster);
};
$pipes = [$pipe1, $pipe2, $pipe3, $pipe4];
function dispatcher($poster, $pipes)
{
    echo "result:" .(new Pipeline)->send($poster)->through($pipes)->then(function ($poster) {
            echo "received: $poster<br>";
            return 3;
        }) . "<br>";
}
echo "==> action start:<br>";
dispatcher(5, $pipes);
echo "<br>==> action end:<br>";
//echo "<br>==> action 2:<br>";
//dispatcher(7, $pipes);

//******************  类  **********************

$xiaoFang = new Student('小芳');
$makeUp = new MakeUp($xiaoFang);
$getUp = new GetUp($makeUp);
$school  = new School($getUp);

$pipeStd = [$pipe1, $pipe2, $pipe3, $pipe4];

//(new Pipeline(new Container()))->send($poster)->through($pipes)->then(function ($poster) {
//    echo "received: $poster\n";
//    return 3;
//});



//function test ($a,$b){
//    return function ($c) use ($a,$b) {
//        return $c($a,$b);
//    };
//}
//
//$test = test(1,3);
//$test(function ($a,$b){
//    echo $a+$b;
//});
//


function myfunction($v1,$v2)
{
    return function ($num) use ($v1,$v2){
        echo $num."&&&&&&&&<br><br>";

        $v2($num,$v1);
        echo $num."???????<br><br>";
        return $v2($num,$v1);
    };
}

$m3 = function($num, Closure $next){
    $num += 4;
    echo $num."@3<br>";
    return $next($num);
};

$m2 = function($num, Closure $next){
    $num += 3;
    echo $num."@2<br>";
    return $next($num);
};

$m1 = function($num, Closure $next){
    $num += 1;
    echo $num."@1<br>";
    return $next($num);
};


$a=array($m3,$m2,$m1);
$cc = array_reduce($a,"myfunction",function ($num){
    echo $num."<br>";
    return 3;
});
echo $cc(1);

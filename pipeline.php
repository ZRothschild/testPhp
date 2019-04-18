<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/4/5
 * Time: 20:38
 */

// ******************  自动加载  **********************
require __DIR__.'/load/Loader.php';
Loader::getLoader();

use Module\Pipeline\Pipeline;
use Container\Container;
use \Module\Decorator\Student;
use \Module\Decorator\MakeUp;
use \Module\Decorator\GetUp;
use \Module\Decorator\School;

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
            echo "received: $poster\n";
            return 3;
        }) . "\n";
}
echo "==> action 1:<br>";
dispatcher(5, $pipes);
echo "==> action 2:<br>";
dispatcher(7, $pipes);

//******************  类  **********************

$xiaoFang = new Student('小芳');
$makeUp = new MakeUp($xiaoFang);
$getUp = new GetUp($makeUp);
$school  = new School($getUp);

$pipeStd = [$pipe1, $pipe2, $pipe3, $pipe4];

(new Pipeline(new Container()))->send($poster)->through($pipes)->then(function ($poster) {
    echo "received: $poster\n";
    return 3;
});

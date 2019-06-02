<?php
interface Step{
    public static function go(Closure $next);
}
class FirstStep implements Step{
    public static function go(Closure $next){
        $cc = 111111111111111111;
        echo "开启session".'<br>';
        $next($cc);
        echo "保存数据关闭session".'<br>';
    }
}
class TwoStep implements Step{
    public static function go(Closure $next){
        echo "开启cookie".'<br>';
        $next();
        echo "保存数据关闭cookie".'<br>';
    }
}
function goFun($step,$className){
    return function() use($step,$className)
    {
        return $className::go($step);
    };
}
function then(){
    $step = ['FirstStep','TwoStep'];
    $prepare = function($cc){echo $cc.'请求路由数据传递'.'<br>';};
    $go = array_reduce($step, "goFun",$prepare);
    $go();
}
then();
function sum($carry, $item){
    return [$carry,$item];
}
function product($carry, $item){
    $carry *= $item;
    return $carry;
}
$a = array(1, 2, 3, 4, 5);
$x = array();
var_dump(array_reduce($a, "sum")); // int(15)
var_dump(array_reduce($a, "product", 10)); // int(1200), because: 10*1*2*3*4*5
var_dump(array_reduce($x, "sum", "No data to reduce")); // string(17) "No data to reduce"

<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/4/6
 * Time: 13:35
 */

namespace App\Module\Step;

use Closure;
use InterfaceRepository\Step;

class FirstStep implements Step{
    public static function go(Closure $next){
        $cc = 111111111111111111;
        echo "开启session".'<br>';
        $next($cc);
        echo "保存数据关闭session".'<br>';
    }
}

<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/4/6
 * Time: 13:38
 */

namespace App\Module\Step;

use InterfaceRepository\Step;
use Closure;

class SecondStep implements Step{
    public static function go(Closure $next){
        echo "开启cookie".'<br>';
        $next();
        echo "保存数据关闭cookie".'<br>';
    }
}

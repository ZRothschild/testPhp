<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/4/6
 * Time: 13:35
 */

namespace App\Base;

use Closure;

interface Step
{
    public static function go(Closure $next);
}

<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/4/6
 * Time: 13:35
 */

namespace Module;

use Closure;

interface StepInterface
{
    public static function go(Closure $next);
}

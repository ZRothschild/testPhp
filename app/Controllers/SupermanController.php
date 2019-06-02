<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/4/5
 * Time: 14:44
 */

namespace App\Controllers;

use App\Controllers\Base\BaseController;
use App\Base\Super;

class SupermanController extends BaseController
{
    protected $module;

    public function __construct(Super $module)
    {
        $this->module = $module;
    }
}

<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/4/5
 * Time: 14:44
 */

namespace Controller;

use Module\SuperInterface;

class SupermanController
{
    protected $module;

    public function __construct(SuperInterface $module)
    {
        $this->module = $module;
    }
}

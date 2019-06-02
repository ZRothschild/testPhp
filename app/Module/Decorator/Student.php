<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/4/6
 * Time: 13:46
 */

namespace App\Module\Decorator;

use App\Base\Decorator;

class Student implements Decorator
{
    private $name;
    public function __construct($name){
        $this->name = $name;
    }

    public function display(){
        echo "我是".$this->name."我去上学了".'<br>';
    }
}

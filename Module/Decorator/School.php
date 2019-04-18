<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/4/6
 * Time: 13:51
 */

namespace Module\Decorator;


class School extends Finery{
    public function display(){
        parent::display();
        echo "我到学校了".'<br>';
    }
}

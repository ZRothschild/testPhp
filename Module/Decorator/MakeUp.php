<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/4/6
 * Time: 13:51
 */

namespace Module\Decorator;


class MakeUp extends Finery{
    public function display(){
        echo "化妆".'<br>';
        parent::display();
    }
}
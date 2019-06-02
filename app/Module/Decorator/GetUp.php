<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/4/6
 * Time: 13:50
 */

namespace App\Module\Decorator;


class GetUp extends Finery{
    public function display(){
        echo "起床".'<br>';
        parent::display();
    }
}

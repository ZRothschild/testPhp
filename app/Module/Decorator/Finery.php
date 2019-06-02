<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/4/6
 * Time: 13:48
 */

namespace App\Module\Decorator;

use App\Base\Decorator;

/**
 * Class Finery  服饰
 * @package App\Module\Decorator
 */
class Finery implements Decorator
{
    protected static $DAO_NAME;

    private $component;
    public function __construct(Decorator $component){
        $this->component = $component;
    }
    public function display(){
        $this->component->display();
    }

    public function getStatic()
    {
        echo  "<br>".static::$DAO_NAME."111<br>";
    }
}

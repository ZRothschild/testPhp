<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/4/6
 * Time: 13:48
 */

namespace Module\Decorator;

use Module\DecoratorInterface;

/**
 * Class Finery  服饰
 * @package Module\Decorator
 */
class Finery implements DecoratorInterface
{
    private $component;
    public function __construct(DecoratorInterface $component){
        $this->component = $component;
    }
    public function display(){
        $this->component->display();
    }
}

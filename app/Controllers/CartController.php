<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/4/5
 * Time: 14:32
 */

namespace App\Controllers;

use App\Controllers\Base\BaseController;

class CartController extends BaseController
{
    const PRICE_BUTTER  = 1.00;
    const PRICE_MILK    = 3.00;
    const PRICE_EGGS    = 6.95;

    private $name;
    protected   $products = array();

    public function add($product, $quantity)
    {
        $this->products[$product] = $quantity;
    }

    public function sum($sum)
    {
        $this->name= $sum;
    }

    public function getQuantity($product)
    {
        return isset($this->products[$product]) ? $this->products[$product] :
            FALSE;
    }

    public function getTotal($tax)
    {
        $total = 0.00;

        $callback = function ($quantity, $product) use ($tax, &$total) {
            $pricePerItem = constant(__CLASS__ . "::PRICE_" . strtoupper($product));
            $total += ($pricePerItem * $quantity) * ($tax + 1.0);
        };

        //$this->products 元素个数决定 $callback 函数接收参数个数
        array_walk($this->products, $callback);
        return round($total, 2);
    }
}

<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/3/29
 * Time: 22:53
 */

// ******************  自动加载  **********************
require __DIR__.'/load/Loader.php';
Loader::getLoader();

use Repository\RepositoryUser;
use Controller\UsersController;
use Controller\CartController;
use Container\Container;
use Module\Super\XPower;
use Module\Super\UltraBomb;
use Controller\SupermanController;

// ******************  依赖注入  **********************
$reUser = new RepositoryUser();
$userCon = new UsersController($reUser);

// ******************  匿名函数  **********************
$my_cart = new CartController;
// 往购物车里添加条目
$my_cart->add('butter', 1);
$my_cart->add('milk', 3);
$my_cart->add('eggs', 6);
$my_cart->sum('eggs');

// 打出出总价格，其中有 5% 的销售税.
print $my_cart->getTotal(0.05) . "\n";
// 最后结果是 54.29

// ******************  服务容器  **********************
$container = new Container;

// 向该 超级工厂 添加 超人 的生产脚本
// function  中的 $container 是 array_unshift 压进来的第一个参数也就是$this
$container->bind('superman', function($container, $moduleName) {
    return new SupermanController($container->make($moduleName));
});
// 向该 超级工厂 添加 超能力模组 的生产脚本
$container->bind('xpower', function($container) {
    return new XPower;
});
// 同上
$container->bind('ultrabomb', function($container) {
    return new UltraBomb;
});
// ******************  华丽丽的分割线 开始启动生产 **********************
$superman_1 = $container->make('superman', ['xpower']);
$superman_2 = $container->make('superman', ['ultrabomb']);
$superman_3 = $container->make('superman', ['xpower']);
// ...随意添加


new SplDoublyLinkedList();
<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/3/30
 * Time: 17:41
 */

namespace App\Module\Load;

class Loader
{
    private static $loader;

    public static function loadLoader($class)
    {
        //linux  使用的是  /
        require dirname(__DIR__) . 'Loader.php/' .str_replace('\\','/',$class).'.php';
    }

    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }
        //第一步调用上面的 loadClassLoader方法，方法本质就是引入 ClassLoader.php
        spl_autoload_register(array('Loader', 'loadLoader'), true, true);
    }
}

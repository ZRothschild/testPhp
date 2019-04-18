<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/3/30
 * Time: 17:41
 */

class Loader
{
    private static $loader;

    public static function loadLoader($class)
    {
        require dirname(__DIR__).'/' .$class.'.php';
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

<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/4/5
 * Time: 14:27
 */
namespace App\Container;

class Container
{
    protected $binds;

    protected $instances;

    /**
     * 绑定依赖
     * @param $abstract
     * @param $concrete
     */
    public function bind($abstract, $concrete)
    {
        if ($concrete instanceof \Closure) {
            $this->binds[$abstract] = $concrete;
        } else {
            $this->instances[$abstract] = $concrete;
        }
    }

    /**
     * 解析依赖
     * @param $abstract
     * @param array $parameters
     * @return mixed
     */
    public function make($abstract, $parameters = [])
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }
        //把$this参数压入$parameters数组开头
        array_unshift($parameters, $this);
        return call_user_func_array($this->binds[$abstract], $parameters);
    }

}

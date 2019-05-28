<?php


namespace Common;


use ArrayAccess;
use Countable;
use Iterator;
use Serializable;

class BaseDb implements Iterator,Countable,ArrayAccess,Serializable
{
    public $data;

    protected static $dbName;
    protected static $tableName;

    private $_array;
    private $_key;

    public function __construct($data = [])
    {
        if (!empty($data)) $this->data = $data;
    }

    public function getDb()
    {
        return static::$dbName;
    }

    /**
     * 没有设置就是 文件名称
     * @return string
     */
    public function getTable()
    {
        if (isset(static::$tableName)) return static::$tableName;
        return static::class;
    }

    /**
     * 当直接使用count 函数 操作 对象时触发此方法
     * @return int
     */
    public function count()
    {
        return count($this->_array);
    }

    /**
     * unserialize  serialize 存储对象到解析依旧可用
     * @param string $data
     * @return mixed|void
     */
    public function unserialize($data)
    {
        return $this->data = unserialize($data);
    }

    /**
     * @return string
     */
    public function serialize() {
        return $this->data = serialize($this->data);
    }

    public function offsetExists($offset )
    {
        return isset($this->{$offset});
    }

    /**
     * offsetGet  offsetSet  可以数组话操作对象 对象属性
     *
     *   $user['php'] = '世界上最好的语言';
     *   $user['java'] = '垃圾语言';
     *   $user->go = '吊上天的语言';
     *   var_dump($user->go);
     * @param mixed $offset
     * @return mixed|void
     */
    public function offsetGet($offset)
    {
        return $this->_array[$offset];
    }


    public function offsetSet($offset,$value)
    {
        $this->{$offset} = $value;
        return $this->_array[$offset] = $value;
    }

    /**
     * __set  与 __get  是操作属性
     *  $user->go = '吊上天的语言';
     *  var_dump($user->go);
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->{$name} = $value;
    }

    public function __get($name)
    {
        return isset($this->{$name}) ? $this->{$name}: new \Exception();

    }

    /**
     * @param mixed $offset
     * @return bool|void
     */
    public function offsetUnset($offset)
    {
        unset($this->{$offset});
        return true;
    }

    /**
     * 将索引游标指向初始位置
     */
    public function rewind()
    {
        $this->_key = 0;
    }

    /**
     * 判断当前索引游标指向的元素是否设置
     * @return bool|void
     */
    public function valid()
    {
        return isset($this->_array[$this->_key]);
    }

    /**
     *将当前索引指向下一位置
     */
    public function next()
    {
        $this->_key++;
    }

    /**
     * 将当前索引指向位置
     * @return mixed|void
     */
    public function current()
    {
        return $this->_array[$this->_key];
    }

    public function key()
    {
        return $this->_key;
    }


    public function __destruct()
    {
        unset($this->data);
    }
}
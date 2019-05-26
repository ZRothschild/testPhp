<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/3/29
 * Time: 22:56
 */

/**
 *  $user = new RepositoryUser(200);
 *
 * //这操作构造函数就没有了
 * $test = serialize($user); // 调用user::serialize
 *
 * $newobj = unserialize($test);// 调用user::unserialize
 *
 * echo "<br>";
 *
 * echo $newobj->show("你大爷");// 调用userOne::show
 * // 执行结束，调用析构函数，先执行newobj对象的析构函数在执行user对象的析构函数
 *
 * echo "<br>";
 */

namespace Repository;

use ArrayAccess;
use Countable;
use Iterator;
use Serializable;

class RepositoryUser implements Iterator,Countable,ArrayAccess,Serializable
{
    public $name;
    public $age;
    public $sex;
    protected $height;
    private $_array = ['a','b','c'];
    private $_key = 0;
    public $count;
    public $data;

    public function __construct($count)
    {
        $this->count = $count;
    }

    public function show($name)
    {
        var_dump($name);
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * 当直接使用count 函数 操作 对象时触发此方法
     * eg:
     *      $user = new RepositoryUser($count)
     *      echo count($user);
     *      echo "<br>";
     * @return int
     */
    public function count()
    {
        // TODO: Implement count() method.
        return $this->count;
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
        // TODO: Implement offsetGet() method.
        return $this->{$offset};
    }


    public function offsetSet($offset,$value)
    {
        return $this->{$offset} = $value;
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
        // TODO: Implement __set() method.
    }

    public function __get($name)
    {
        $this->{$name};
        // TODO: Implement __set() method.
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
        // TODO: Implement rewind() method.
        $this->_key = 0;
    }

    /**
     * 判断当前索引游标指向的元素是否设置
     * @return bool|void
     */
    public function valid()
    {
        // TODO: Implement valid() method.
        return isset($this->_array[$this->_key]);
    }

    /**
     *将当前索引指向下一位置
     */
    public function next()
    {
        // TODO: Implement next() method.
        $this->_key++;
    }

    /**
     * 将当前索引指向位置
     * @return mixed|void
     */
    public function current()
    {
        // TODO: Implement current() method.
        return $this->_array[$this->_key];
    }

    public function key()
    {
        // TODO: Implement key() method.
        return $this->_key;
    }


    public function __destruct()
    {
        echo $this->count."测试有之<br>";
        // TODO: Implement __destruct() method.
        unset($this->data);
    }
}

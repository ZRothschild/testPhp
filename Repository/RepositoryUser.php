<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/3/29
 * Time: 22:56
 */

namespace Repository;

class RepositoryUser
{
    public $name;
    public function show($name)
    {
        var_dump($name);
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}

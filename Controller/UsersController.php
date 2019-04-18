<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/3/29
 * Time: 22:53
 */
namespace Controller;

use Repository\RepositoryUser;

class UsersController
{
    /**
     * 用户存储库的实现.
     *
     * @var RepositoryUser
     */
    public $users;

    /**
     * 创建新的控制器实例.
     *
     * @param RepositoryUser $users
     * @return void
     */
    public function __construct(RepositoryUser $users)
    {
        $this->users = $users;
    }

    /**
     * 显示指定用户的 profile.
     *
     * @param  int $id
     */
    public function show($id)
    {
        $this->users->show($id);
    }
}

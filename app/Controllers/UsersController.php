<?php
/**
 * Created by IntelliJ IDEA.
 * User: 87390
 * Date: 2019/3/29
 * Time: 22:53
 */
namespace App\Controllers;

use App\Controllers\Base\BaseController;
use App\Repository\UserRepository;

class UsersController extends BaseController
{
    /**
     * 用户存储库的实现.
     *
     * @var UserRepository
     */
    public $users;

    /**
     * 创建新的控制器实例.
     *
     * @param UserRepository $users
     * @return void
     */
    public function __construct(UserRepository $users)
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

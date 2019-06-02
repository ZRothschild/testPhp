<?php

// ******************  自动加载  **********************
//require __DIR__.'/load/Loader.php';
//Loader::getLoader();


require __DIR__.'/vendor/autoload.php';

use App\Repository\UserRepository;

$user = new UserRepository(200);

$user['php'] = '世界上最好的语言';
$user['java'] = '垃圾语言';
$user->go = '吊上天的语言';
var_dump($user->go);

var_dump($user->php);
var_dump($user['go']);
var_dump($user->java);

echo "111<br>";
echo "222<br>";


foreach ($user as $key => $value) {
    var_dump($value);
    echo "<br>";
}


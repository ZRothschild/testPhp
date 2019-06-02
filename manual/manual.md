# composer自动加载原理

1. `composer` 通过 `composer.json` 下载依赖包
2. 每一个组建都会有自己的`composer.json`,由于`php`代码文件遵循不同的标准(`prs`)所以自动加载有不同的语法与加载方式
3. 当项目完成组件加载，将会生成一个项目的`composer.lock`文件，里面记录了加载了的组件，与组件里面遵循`prs`的文件，用户自动加载
4. 项目完成时，同时会有一个自动加载文件配置，这就是`compose`文件夹里面有记录组件里面的每一个需要引入的入口文件，不同`prs`格式的文件

### composer文件的作用

1. 核心处理类就是 `vendor/composer/autoload_real.php`这个类，它做的事情就是把`psr-0`，`psr-4`，`classmap`，
`files`四种方式加载的类注册到`vendor/composer/ClassLoader`类下

####  1. `PSR-4`（推荐）

```json
 {
  "autoload": {
     "psr-4": {
       "Foo\\": "src/" 
      }
   }
 }
```

> 当在`index.php`中试图`new Foo\Bar\Baz`这个`class`时，`composer`会自动去寻找 `src/Bar/Baz.php` 这个文件，如果它存在则进行加载。

####  2. `PSR-0`（不推荐)

```json
{
  "autoload": {
     "psr-0": {
         "Foo\\": "src/"
      }
    }
}
```

> 当在`index.php`中试图`new Foo\Bar\Baz`这个`class`时，`composer`会自动去寻找 `src/Foo/Bar/Baz.php` 这个文件，如果它存在则进行加载。

####  3. `Class-map` 方式

```json
{
    "autoload": {
        "classmap": ["src/", "lib/", "Something.php"]
     }
}
```

> `composer`会扫描指定目录下以`.php`或`.inc`结尾的文件中的`class`，生成`class`到指定`file path`的映射，并加入新生成的`vendor/composer/autoload_classmap.php`文件中。
> 例如`src/`下有一个`BaseController`类，那么在`autoload_classmap.php`文件中，就会生成这样的配置:'BaseController' => $baseDir . '/src/BaseController.php'

####  4. `Files` 方式

```json
{
   "autoload": {
      "files": ["src/MyLibrary/functions.php"]
    }
}
```

> `Files`方式，就是手动指定供直接加载的文件。比如说我们有一系列全局的`helper functions`，可以放到一个`helper`文件里然后直接进行加载
> 也就是说，当你用require 'vendor/autoload.php';加载自动加载类时自动将`files`里的文件加载进来了，你直接使用就行了。

###  composer 更新

1. 使用时需要在入口文件中加载 require 'vendor/autoload.php'  文件

2. 每次修改`composer.json`文件时，需要运行命令

```composer
    composer dumpautoload
```

[参考](https://learnku.com/)
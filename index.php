<?php
    header('Content-type:text/html;charset=utf-8');
    //定义一个绝对路径——项目路径
    define('ROOT',getcwd().'\\');
    //使用GET方式接收控制器类
    $name = isset($_GET['c']) ? $_GET['c'] : 'Message';
    //使用GET方式接收控制器类中的方法
    $method = isset($_GET['m']) ? $_GET['m'] : 'select';
    //引入实例化的MVC层级的类
    include ROOT.'core/MVCFunction.class.php';
    //调用控制器
    MVCFunction::C($name,$method);
?>
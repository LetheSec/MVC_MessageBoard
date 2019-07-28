<?php
    class MVCFunction{
        //定义一个静态成员属性
        public static $obj;
        //定义引入控制器的方法
        public static function C($name,$method){
            //引入控制器
            include ROOT.'controller/'.$name.'Controller.class.php';
            //获取类名
            $className = $name.'Controller';
            //实例化控制器
            self::$obj = new $className();
            //调用控制器中的方法
            self::$obj->$method();
            //返回实例化的对象
            return self::$obj;
        }
        public static function M($name){
            //引入模型的类文件
            include ROOT.'model/'.$name.'Model.class.php';
            //获取类名
            $className = $name.'Model';
            //实例化模型
            self::$obj = new $className();
            //返回实例化的对象
            return self::$obj;
        }
        public static function V($name){
            //引入试图的类文件
            include ROOT.'view/'.$name.'View.class.php';
            //获取类名
            $className = $name.'View';
            //实例化视图
            self::$obj = new $className();
            //返回实例化的对象
            return self::$obj;
        }
    }
?>
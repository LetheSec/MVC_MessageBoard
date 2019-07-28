<?php
    header('Content-type:text/html;charset=utf-8');
    class DB{
        private $link;
        private static $obj;
        private function __construct(){
            include ROOT.'/conf.php';
            $this->link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('数据库连接失败!');
        }
        /**
         * @return mixed
         * 单例模式
         */
        public static function getInterface(){
            //判断对象是否为空
            if (is_null(self::$obj)){
                //获取类名
                $className = __CLASS__;         //$className为当前类名，即DB类
                //实例化该类
                self::$obj = new $className();
            }
            //返回实例化的类
            return self::$obj;
        }
        private function getChar($value){
            return '`'.$value.'`';
        }
        private function getString($value){
            return '\''.$value.'\'';
        }
        private function getQuery($sql){
            // return $this->link->query($sql);
            return mysqli_query($this->link,$sql);
        }
        private function getAff(){
            // return $this->link->exec($sql);
            return mysqli_affected_rows($this->link);
        }
        /**
         * @param $table
         * @param $args
         * @return int
         * 删除方法
         */
        public function getDelete($table,$args){
            //为表名添加反引号
            $table = $this->getChar($table);
            //遍历第二个参数（数组），取出其中的键值对作为where条件
            @list($key,$value) = each($args);
            //给字段加上反引号
            $key = $this->getChar($key);
            //给值加上引号
            $value = $this->getString($value);
            //编辑where条件
            $where = 'where '.$key.'='.$value;
            //编辑SQL语句
            $sql = "delete from $table $where";
            //执行SQL语句
            $this->getQuery($sql);
            //返回影响的函数
            return $this->getAff();
        }
        /**
         * @param $table
         * @param @args
         * return int 
         * 插入方法
         */
        public function getInsert($table,$args){
            $table = $this->getChar($table);
            //定义两个空数组，用来装字段和值
            $key = array();
            $value = array();
            //遍历第二个参数（数组），分别把他们填装在数组中
            foreach ($args as $k=>$v){
                //将字段添加在数组中，并加上反引号
                $key[] = $this->getChar($k);
                //将值添加在数组中，并加上引号
                $value[] = $this->getString($v);
            }
            //将装有字段的数组转换为字符串
            $keys = implode(',',$key);
            //将装有值的数组转换为字符串
            $values = implode(',',$value);
            $sql = "INSERT INTO $table ($keys) VALUES ($values)";
            $this->getQuery($sql);
            return $this->getAff();
        }
        function getLogin($tablename,$data){
            //先求用户名
            $username = array_slice($data,0,count($data)-1);
            //使用list()和each()方法获取数组中的键值对
            list($key,$value) = each($username);
            //再求密码
            $userpass = array_slice($data,1,count($data));
            list($key1,$value1) = each($userpass);
            //拼接where条件
            $where = 'where '.$this->getChar($key).'='.$this->getString($value).' and '.$this->getChar($key1).'='.$this->getString($value1);
            //定义SQL语句
            $sql = "select * from $tablename $where";
            //执行SQL语句
            $result = $this->getQuery($sql);
            //获取查询的结果条数
            return mysql_affected_rows($result);     //1有，0没有
        }
        /**
         * @param $table
         * @param $args
         * @return int 
         * 修改方法
         */
        public function getUpdate($table,$args){
            $table = $this->getChar($table);
            //取出数据的一部分构成一个新数组，后面作为修改内容
            $arr = array_slice($args,0,count($args)-1);
            //创建一个空数组，准备接受新构成的数组的值
            $key = array();
            //遍历新数组
            foreach ($arr as $k=>$v){
                //将数组中的元素转换成SQL语句中修改语句的格式
                $key[] = $this->getChar($k).'='.$this->getString($v);
            }
            //将数组转换为字符串
            $str = implode(',',$key);
            //将第二个参数（数组）中的最后一个元素取出作为where条件
            $arr1 = array_slice($args,count($args)-1,1);
            //取出条件的值
            $id = key($arr1);
            //取出条件的值
            $value = current($arr1);
            $sql = "UPDATE $table SET $str WHERE $id=$value";
            $this->getQuery($sql);
            return $this->getAff();
        }
        /**
         * @param $table
         * @param $data
         * @return bool|mysqli_result
         * 查询方法
         */
        public function getSelect($table,$data){
            $table = $this->getChar($table);
            if (is_string($data)){
                $fin = $data;
            }
            else if(is_array($data)){
                $fin = implode(',',$data);
            }
            $sql = "SELECT $fin from $table";
            return $this->getQuery($sql);
        }
        /**
         * @param  $table
         * @param  $data
         * @param  $args
         * @return bool|mysqli_result
         * 查询某一条数据
         */
        public function getData($table,$data,$args){
            $table = $this->getChar($table);
            if (is_string($data)){
                $fin = $data;
            }
            else if(is_array($data)){
                $fin = implode(',',$data);
            }
            @list($key,$value) = each($args);
            $key = $this->getChar($key);
            $value = $this->getString($value);
            //编辑where条件
            $where = 'where '.$key.'='.$value;
            $sql = "SELECT $fin from $table $where";
            return $this->getQuery($sql);
        }
        public function __destruct()
        {
            return mysqli_close($this->link);
        }
    }
    $GLOBALS['db'] = DB::getInterface();
?>
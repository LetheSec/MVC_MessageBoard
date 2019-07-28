<?php
    include ROOT.'core/DB.class.php';
    class MessageModel{
        public function select(){
            $query = $GLOBALS['db']->getSelect('messages','*');
            echo "<a href='index.php?c=Message&m=add'>添加留言</a>";
            echo "<table width='88%' border='1' cellspacing='0' align='center'>
                    <tr>
                        <th>编号</th>
                        <th>姓名</th>
                        <th>邮箱</th>
                        <th>留言内容</th>
                        <th>留言时间</th>
                        <th>操作</th>
                    </tr>";

            while($assoc = mysqli_fetch_assoc($query)){
                echo "<tr align='center'>
                    <td>$assoc[id]</td>
                    <td>$assoc[name]</td>
                    <td>$assoc[email]</td>
                    <td>$assoc[content]</td>
                    <td>$assoc[message_time]</td>
                    <td><a href='index.php?c=Message&m=update&id=$assoc[id]'>修改</a> | <a href='index.php?c=Message&m=delete&id=$assoc[id]'>删除</a></td>
                </tr>";
            }              
            echo "</table>";     
        }
        public function insert(){
            $_POST['message_time'] = date('Y-m-d H:i:s');
            return $GLOBALS['db']->getInsert('messages',$_POST);
        }
        public function get_data(){
           return $GLOBALS['db']->getData('messages','*',array('id'=>$_GET['id']));
        }
        public function edit(){
            return $GLOBALS['db']->getUpdate('messages',$_POST);
        }
        public function delete(){
            return $GLOBALS['db']->getDelete('messages',array('id'=>$_GET['id']));
        }
    }
?>
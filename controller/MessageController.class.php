<?php
    class MessageController{
        public function select(){
            MVCFunction::M('Message')->select();
        }
        public function add(){
            MVCFunction::V('Message')->add();
        }
        public function insert(){
            $aff = MVCFunction::M('Message')->insert();
            if($aff > 0){
                echo "<script>
                    alert('添加成功!');
                    location.href='index.php?c=Message&m=select';
                </script>";
            }else{
                echo "<script>
                    alert('添加失败!');
                    location.href='index.php?c=Message&m=add';
                </script>";
            }
        }
        public function update(){
            $query = MVCFunction::M('Message')->get_data();
            $assoc = mysqli_fetch_assoc($query);
            MVCFunction::V('Message')->update($assoc);
        }
        public function edit(){
            $aff = MVCFunction::M('Message')->edit();
            if($aff > 0){
                echo "<script>
                    alert('修改成功!');
                    location.href='index.php?c=Message&m=select';
                </script>";
            }else{
                echo "<script>
                    alert('修改失败!');
                    location.href='index.php?c=Message&m=update';
                </script>";
            }
        }
        public function delete(){
            $aff = MVCFunction::M('Message')->delete();
            if($aff > 0){
                echo "<script>
                    alert('删除成功!');
                    location.href='index.php?c=Message&m=select';
                </script>";
            }else{
                echo "<script>
                    alert('删除失败!');
                    location.href='index.php?c=Message&m=delete';
                </script>";
            }
        }
    }
?>
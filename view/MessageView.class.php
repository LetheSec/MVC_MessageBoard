<?php
	class MessageView{
		public function add(){
            echo "<form action='index.php?c=Message&m=insert' method='post'>
                <table bgcolor='#ccc' width='700' height='400' align='left'>
                    <tr>
                        <td align='center'>姓名: </td>
                        <td><input type='text' name='name'/></td>
                    </tr>
                    <tr>
                        <td align='center'>邮箱: </td>
                        <td><input type='text' name='email'/></td>
                    </tr>
                    <tr>
                        <td align='center'>留言内容: </td>
                        <td><textarea name='content' cols='70' rows='10'></textarea></td>
                    </tr>
                    <tr>
                        <td colspan='2' align='center'><input type='submit'/></td>
                    </tr>
                </table>
            </form>";
        }
        public function update($assoc){
            echo "<form action='index.php?c=Message&m=edit' method='post'>
            <table bgcolor='#ccc' width='700' height='400' align='left'>
            <tr>
                <td align='center'>姓名: </td>
                <td><input type='text' name='name' value='$assoc[name]' /></td>
            </tr>
            <tr>
                <td align='center'>邮箱: </td>
                <td><input type='text' name='email' value='$assoc[email]' /></td>
            </tr>
            <tr>
                <td align='center'>留言内容: </td>
                <td><textarea name='content' cols='70' rows='10'>$assoc[content]</textarea></td>
            </tr>
            <input type='hidden' name='id' value='$assoc[id]' />
            <tr>
                <td colspan='2' align='center'><input type='submit'/></td>
            </tr>
        </table>
    </form>";
        }
	}
?>
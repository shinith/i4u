<?php
if(isset($_POST["submit"])){
	unset($_POST);
}?>
<form name="frm" method="post">
	<input type="text" name="txtName">
	<button name="submit">Submit</button>
	</form>
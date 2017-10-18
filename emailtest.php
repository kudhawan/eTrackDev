<?php
if(isset($_POST['submit'])){
$to = "aruna.exxova@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: webmaster@example.com" . "\r\n" .
"CC: arunavkda@gmail.com";

mail($to,$subject,$txt,$headers);

}

?>
<form method="post" action="" name="form">
<input type="submit" name="submit" id="submit" value="Submit" />

</form>
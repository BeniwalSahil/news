<?php
$to = "sb2866615@gmail.com";
$subject = "Testing mail";
$message = "hello! we are testing the mail.";
$from = "sb9571576@gmail.com";
$headers = "From: $from";
mail($to,$subject,$message,$headers);
echo "Mail sent.";
?>
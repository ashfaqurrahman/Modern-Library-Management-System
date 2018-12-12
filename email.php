<?php 

$msg = "This is test mail";

$msg = wordwrap($msg,70);

mail("dreamsoft16@gmail.com","Subject",$msg);

?>
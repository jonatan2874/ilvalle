<?php
    if(!session_start()){session_start();}
	session_destroy();
	header('Location: sign-in.php');
?>

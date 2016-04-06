<?php

include 'connection.php';

if(isset($_POST['username'])){
	$username = mysql_real_escape_string($_POST['username']);
 
	$resultLog = mysql_query('select login from users where login = "'. $username .'"');  
	  

	if(mysql_num_rows($resultLog)>0){  
	    echo 0;  
	}else{  
	    echo 1;  
	}
}

if (isset($_POST['mail'])) {
	$mail = mysql_real_escape_string($_POST['mail']);
	
	$resultMail = mysql_query('select mail from users where mail = "'. $mail .'"');  
	  
	if(mysql_num_rows($resultMail)>0){  
	    echo 0;  
	}else{  
	    echo 1;  
	} 
}
  

?>
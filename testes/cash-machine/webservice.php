<?php
    include 'cashAutomatic.class.php';
    
    $soap = new SoapServer(null, array('uri' => 'http://localhost/'));
    $soap->setClass('cashAutomatic');  
    $soap->handle();  

?>
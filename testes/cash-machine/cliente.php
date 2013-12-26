<?php  
   $client = new SoapClient(null, array('uri' => 'http://localhost/', 'location' => 'http://localhost/cash/webservice.php'));  
   $dispensado = $client->procesa($_POST['valor']);  
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml">   
    <head>  
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
       <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
      <title>Cash Machine</title>  
    </head>  
    <body> 
        <div id="content">
        <?php if(!array_key_exists('Error', $dispensado)) : ?>
            <h1>Bilhetes para dispensar</h1>  
            <h3>Valor solicitado: R$ <?php echo number_format($_POST['valor'],2, ',', '.')  ?> </h3>
            <ul>
            <?php foreach ($dispensado as $disp) : ?>
                <?php foreach ($disp as $cantidad => $num) : ?> 
                    <li><?php echo $cantidad.' Billetes de '. $num; ?></li>
                <?php endforeach; ?>
            <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <h1 class="error">Error</h1>
            <span class="error"><?php echo $dispensado['Error']; ?></span>
        <?php endif; ?>
        
        <br /><br />
        <a href="index.php">Iniciar</a>
        </div>
    </body>
</html>
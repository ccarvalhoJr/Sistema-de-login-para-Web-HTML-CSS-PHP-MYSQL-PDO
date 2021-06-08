<html lang='pt-br '>
 <head>
   <meta charset='utf-8'>
     <title>Área Privada</title>
       <link rel='stylesheet' href='css\estilo.css'>
 </head>

<body>
  <div id='sair'>
    <a href="index.php">SAIR</a>
  </div>
      <div id='img'>
      <img src='https://jpimg.com.br/uploads/2020/11/silvio-santos-1024x619.jpg'> 
      </div>
</body>
</html>








<?php
session_start();
if(!isset($_SESSION['usuario_id']))
{
    header("location: index.php");
    exit;
}
?>


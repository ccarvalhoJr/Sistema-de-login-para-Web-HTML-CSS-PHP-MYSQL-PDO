<?php
require_once 'classe/usuario.php';
$u = new Usuario();
?>

<html lang='pt-br '>
 <head>
   <meta charset='utf-8'>
     <title>Projeto Login</title>
       <link rel='stylesheet' href='css\estilo.css'>
 </head>

    <body>
      <div id='corpo-form-cad'>
        <h1>Cadastrar</h1>
          <form method='post'>
           <input type='text' name='nome' placeholder='Nome Completo' maxlength='50' style="color: white;">
             <input type='text' name='telefone' placeholder='Telefone' maxlength='11' style="color: white;">
               <input type='email' name='email' placeholder='Email' maxlength='50' style="color: white;"> 
                 <input type='password' name='senha' placeholder='Senha' maxlength='15' style="color: white;">
                   <input type='password' name='confsenha' placeholder='Confirmar Senha' maxlength='32' style="color: white;">
                     <input type='submit' value='Cadastrar'>
           </form>
      </div>
      <?php
       if (isset($_POST['nome']))
       {
           $nome = addslashes($_POST['nome']);
           $telefone = addslashes($_POST['telefone']);
           $email = addslashes($_POST['email']);
           $senha = addslashes($_POST['senha']);
           $confirmarsenha = addslashes($_POST['confsenha']);
           if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarsenha))
           {
               $u->conectar("sistema_login", "localhost", "root", "");
               if($u->msgErro == "") // Está tudo ok
               {
                   if($senha == $confirmarsenha)
                   {
                      if($u->cadastrar($nome,$telefone,$email,$senha))
                      {   
                          ?>
                          <div id='msg-sucesso'>
                          Cadastrado com sucesso!
                          </div>
                          <?php
                          header("location: index.php");
                      }
                      else
                      {
                          ?>
                          <div class='msg-erro'>
                          Email já cadastrado!
                          </div>
                          <?php
                      }
                   }
                   else
                   {
                       ?>
                       <div class='msg-erro'>
                       Senha e Confirmar Senha estão diferentes!
                       </div>
                       <?php
                   }              
               }
               else
               {
                   ?>
                   <div class='msg-erro'>
                   <?php echo "Erro: ".$u->msgErro;?>
                   </div>
                   <?php
               }
           }
           else
           {
               ?>
               <div class='msg-erro'>
               Preencha todos os campos!
               </div>
               <?php
           }
       }
      ?>
    </body>
</html>
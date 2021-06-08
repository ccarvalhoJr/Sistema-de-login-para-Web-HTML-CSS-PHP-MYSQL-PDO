<?php
require_once 'classe/usuario.php';
$u = new Usuario;
?>

<html lang='pt-br '>
 <head>
   <meta charset='utf-8'>
     <title>Projeto Login</title>
       <link rel='stylesheet' href='css\estilo.css'>
 </head>

    <body>
      <div id='corpo-form'>
        <h1>Entrar</h1>
          <form method='post'>
            <input type='email' name='email' placeholder='Email' style="color: white;">
              <input type='password' name='senha' placeholder='Senha' style="color: white;">
                <input type='submit' value='Acessar'>
                  <a href='cadastrar.php'>Ainda não é inscrito ? <strong>Cadastre-se!</strong></a>
           </form>
      </div>
        <?php
        if (isset($_POST['email']))
        {
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            if(!empty($email) && !empty($senha))
            {
              $u->conectar("sistema_login", "localhost", "root", "");
           if($u->msgErro == "")
           {

           
              if($u->logar($email,$senha))
              {
                header("location: areapriv.php");
              }
              else
              {
                ?>
                <div class='msg-erro'>
                Email e/ou Senha estão incorretos!
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
              <div class="msg-erro">
              Preencha todos os Campos!
              </div>
              <?php
            }
        }
        ?>
    </body>
</html>
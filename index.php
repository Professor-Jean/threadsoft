<!DOCTYPE html>
<?php
  include "security/database/dbconfig.php";
  include "security/database/dbconnect.php";
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>threadsoft</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/favicon.png" />
  </head>
  <body>
    <div id="center-loginBox"> <!-- essa div serve para centralizar os elementos verticalmente e horizontalmente os elementos dentro dela -->
      <img id="loginLogo" src="img/logo.png"/> <!-- essa div será trocada por uma imagem da logo da JTC -->
      <div id="loginBox">
        <h1>Bem-vindo(a)!</h1>
        <form name="frmlogin" action="security/authentication/login_authentication.php" method="post">
          <input name="txtuser" placeholder="Usuário">
          <input type="password" name="pwdpassword" placeholder="Senha">
          <button type="submit" name="btnlogin">Entrar</button>
          <a href="forgot_password.php">Esqueci minha senha!</a>
        </form> <!-- fim do formulário de autenticação -->
      </div> <!-- fim da div com o formulário de autenticação -->
    </div> <!-- fim da div de centralização -->
  </body>
</html>

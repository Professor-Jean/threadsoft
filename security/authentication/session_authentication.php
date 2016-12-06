<?php
  session_start(); // Inicia a sessão
  if(!isset($_SESSION['idSessao'])){ // Se a variável de sessão não existir...
    header("Location: ".BASE_URL."security/authentication/logout_authentication.php"); // Desloga e manda pra index
    exit;
  }else if($_SESSION['idSessao']!=session_id()){ // Se a variável de sessão for falsa...
    header("Location: ".BASE_URL."security/authentication/logout_authentication.php"); // Desloga e manda pra index
    exit;
  }
?>

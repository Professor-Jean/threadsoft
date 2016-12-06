<?php
  session_start(); // Inicia a sessão
  session_unset(); // Limpa a sessão
  session_destroy(); // Destrói a sessão
  header("location:../../index.php"); // Redireciona para a página inicial
?>

<?php
  $server_name  = $_SERVER['SERVER_NAME']; // Guarda o nome do server em uma váriavel
  $project_name = "threadsoft"; // Guarda o nome da pasta em uma variável
  define("BASE_URL", "http://".$server_name.DIRECTORY_SEPARATOR.$project_name.DIRECTORY_SEPARATOR); // Define a url base para usar nos includes
  include "authentication/session_authentication.php"; // Inclue a autenticação de sessão
?>

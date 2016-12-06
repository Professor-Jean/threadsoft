<?php
  include "security/database/dbconfig.php";
  include "security/database/dbconnect.php";
  include "php/dboperations.php";
?>
<a href="index.php">Voltar</a><br><br>
Digite seu e-mail:
<form action="forgot_password_send.php" method="post">
  <input type="text" name="txtemail" value="">
  <button type="submit">Enviar</button>
</form>

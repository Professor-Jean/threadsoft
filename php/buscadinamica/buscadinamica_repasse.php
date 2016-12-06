<?php
  include "../../security/database/dbconfig.php";
  include "../../security/database/dbconnect.php";
  include "../../php/dboperations.php";
  $ven = $_POST['ven'];
  $sql_sel_code = "SELECT removals.id
                   FROM removals
                   INNER JOIN sellers
                   ON removals.sellers_id = sellers.id
                   WHERE type ='m' AND sellers.id='".$ven."'";
  $sql_sel_code_preparado = $conexaobd->prepare($sql_sel_code);
  $sql_sel_code_preparado->execute();
  echo "<option value= ''>Escolha um repasse</option>";
  while($sql_sel_code_dados=$sql_sel_code_preparado->fetch()){
    echo "<option value=".$sql_sel_code_dados['id'].">".$sql_sel_code_dados['id']."</option>";
  }
?>

<?php
  include "../../security/database/dbconfig.php";
  include "../../security/database/dbconnect.php";
  include "../../php/dboperations.php";
  $fab = $_POST['fab'];
  $sql_sel_code = "SELECT products.code
                   FROM products
                   INNER JOIN products_has_sizes ON products_has_sizes.products_id = products.id
                   INNER JOIN inventories ON inventories.products_has_sizes_id = products_has_sizes.id
                   WHERE manufacturers_id='".$fab."'";
  $sql_sel_code_preparado = $conexaobd->prepare($sql_sel_code);
  $sql_sel_code_preparado->execute();
  echo "<option value= ''>Escolha um código</option>";
  while($sql_sel_code_dados=$sql_sel_code_preparado->fetch()){
    echo "<option value=".$sql_sel_code_dados['code'].">".$sql_sel_code_dados['code']."</option>";
  }
?>

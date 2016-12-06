<?php
  include "../../security/database/dbconfig.php";
  include "../../security/database/dbconnect.php";
  include "../../php/dboperations.php";
  $cod = $_POST['cod'];
  $sql_sel_products = "SELECT
                        categories.category,
                        products.model,
                        sizes.size,
                        products.sex,
                        products.price
                       FROM products
                       INNER JOIN categories ON categories.id = products.categories_id
                       INNER JOIN products_has_sizes ON products.id = products_has_sizes.products_id
                       INNER JOIN sizes ON sizes.id = products_has_sizes.sizes_id
                       WHERE code='".$cod."'";
  $sql_sel_products_preparado = $conexaobd->prepare($sql_sel_products);
  $sql_sel_products_preparado -> execute();
  $sql_sel_products_dados = $sql_sel_products_preparado -> fetch(PDO::FETCH_NAMED);
  if($sql_sel_products_dados['sex']=='1'){
    $sql_sel_products_dados['sex'] = "Masculino";
  }else if($sql_sel_products_dados['sex']=='2'){
    $sql_sel_products_dados['sex'] = "Feminino";
  }else if($sql_sel_products_dados['sex']=='3'){
    $sql_sel_products_dados['sex'] = "Unissex";
  }else{
    $sql_sel_products_dados['sex'] = "Erro!";
  }
  echo json_encode($sql_sel_products_dados);
?>

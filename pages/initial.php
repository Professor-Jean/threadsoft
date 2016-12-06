<div id="contentMain">
  <?php
    $value = '0';
    $products = '0';
    $sellers = '0';
    $manufacturers = '0';
    $sql_sel_products = "SELECT products.price,
                                inventories.quantity
                         FROM products
                         INNER JOIN products_has_sizes
                         ON products_has_sizes.products_id = products.id
                         INNER JOIN inventories
                         ON inventories.products_has_sizes_id = products_has_sizes.id";
    $sql_sel_products_preparado = $conexaobd -> prepare($sql_sel_products);
    $sql_sel_products_preparado -> execute();
    if($sql_sel_products_preparado->rowCount()>0){
      while($sql_sel_products_dados = $sql_sel_products_preparado->fetch()){
        $value = $value + $sql_sel_products_dados['price'] * $sql_sel_products_dados['quantity'];
        $products = $products + $sql_sel_products_dados['quantity'];
      }
    }else{
      $value = '0';
    }

    $sql_sel_sellers = "SELECT * FROM sellers";
    $sql_sel_sellers_preparado = $conexaobd -> prepare($sql_sel_sellers);
    $sql_sel_sellers_preparado -> execute();
    $sellers = $sql_sel_sellers_preparado->rowCount();

    $sql_sel_manufacturers = "SELECT * FROM manufacturers";
    $sql_sel_manufacturers_preparado = $conexaobd -> prepare($sql_sel_manufacturers);
    $sql_sel_manufacturers_preparado -> execute();
    $manufacturers = $sql_sel_manufacturers_preparado->rowCount();
  ?>
  <h1>Bem-vindo(a) ao Threadsoft!</h1><br>
  <h2>Valor em estoque: R$ <?php echo $value ?> </h2><br>
  <h3>Produtos em estoque: <?php echo $products ?></h3><br>
  <h3>Vendedores cadastrados: <?php echo $sellers ?></h3><br>
  <h3>Fabricantes cadastrados: <?php echo $manufacturers ?></h3>
</div>

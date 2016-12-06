<div id="result">
  <h1>Aviso</h1>
  <?php
    $p_manufacturers  = $_POST['selmanufacturers'];
    $p_code  = $_POST['txtcode'];
    $p_model    = $_POST["txtmodel"];
    $p_category = $_POST['selcategory'];
    $p_size = $_POST['selsize'];
    $p_sex = $_POST['selsex'];
    $p_price = $_POST['txtprice'];
    if($p_manufacturers == ""){
      $msg = "O campo \"FABRICANTE\" não foi selecionado!";
    }else if($p_code == ""){
      $msg = "O campo \"CÓDIGO\" não foi preenchido!";
    }else if($p_model == ""){
      $msg = "O campo \"MODELO\" não foi preenchido!";
    }else if($p_category == ""){
      $msg = "O campo \"CATEGORIA\" não foi selecionado!";
    }else if($p_sex == ""){
      $msg = "O campo \"SEXO\" não foi selecionado!";
    }else if($p_price == ""){
      $msg = "O campo \"PREÇO\" não foi prenchido!";
    }else{
      $sql_sel_products = "SELECT * FROM products WHERE code='".$p_code."'";
      $sql_sel_products_preparado = $conexaobd->prepare($sql_sel_products);
      $sql_sel_products_preparado->execute();
      if($sql_sel_products_preparado->rowCount()==0){
      $tabela = "products";
      $dados = array(
        'categories_id' => $p_category,
        'manufacturers_id'    => $p_manufacturers,
        'code'    => $p_code,
        'model'    => $p_model,
        'sex' => $p_sex,
        'price' => $p_price
      );
      $sql_add_products_resultado = adicionar($tabela, $dados);
      if($sql_add_products_resultado){
        $products_id = $conexaobd -> lastInsertId();
        $tabela = "products_has_sizes";
        $dados = array(
          'products_id' => $products_id,
          'sizes_id' => $p_size
        );
        $sql_add_sizes_resultado = adicionar($tabela, $dados);
        if($sql_add_sizes_resultado){
          $msg = "Produto cadastrado corretamente!";
        }else{
          $msg = "Erro ao efetuar cadastro de produto.";
        }
        }else{
          $msg = "Erro ao efetuar cadastro de produto.";
        }
      }else{
        $msg = "Produto já existe!";
      }
      }
  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="?folder=system/products/&file=fmadd_products&ext=php">Voltar</a>
</div>

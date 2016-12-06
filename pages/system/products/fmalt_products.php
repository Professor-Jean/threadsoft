<div id="contentSingleAdd">
  <?php
    $id = $_GET['id'];
    $sql_sel_products = "SELECT
                          products.id,
                          products.categories_id,
                          products.manufacturers_id,
                          products.code,
                          products.model,
                          products.sex,
                          products.price,
                          products_has_sizes.sizes_id
                         FROM products
                         INNER JOIN products_has_sizes ON products.id = products_has_sizes.products_id
                         WHERE products.id='".$id."'";
    $sql_sel_products_preparado = $conexaobd->prepare($sql_sel_products);
    $sql_sel_products_preparado->execute();
    $sql_sel_products_dados = $sql_sel_products_preparado->fetch();
  ?>
  <h1><a href="?folder=system/products/&file=fmadd_products&ext=php"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> Alterar Registro de Produto</h1><br>
  <div>
    <form action="?folder=system/products/&file=alt_products&ext=php" method="post">
      <input type="hidden" name="id" value="<?php echo $sql_sel_products_dados['id'] ?>">
      <?php
        $sql_sel_manufacturers = "SELECT name,id FROM manufacturers";
        $sql_sel_manufacturers_preparado = $conexaobd -> prepare($sql_sel_manufacturers);
        $sql_sel_manufacturers_preparado -> execute();
      ?>
      <span class="seltitle">Fabricante - </span><select class="frmselect" name="selmanufacturers">
        <?php
          if($sql_sel_manufacturers_preparado->rowCount()>0){ // Se tiver mais de um usuário...
            while($sql_sel_manufacturers_dados = $sql_sel_manufacturers_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
        ?>
        <option
        <?php
          if($sql_sel_manufacturers_dados['id'] == $sql_sel_products_dados['manufacturers_id']){
            echo "selected";
          }
        ?>
        value="<?php echo $sql_sel_manufacturers_dados['id'] ?>"><?php echo $sql_sel_manufacturers_dados['name'] ?></option>
        <?php
            }
          }else{ // Se só tiver um usuário...
        ?>
        <tr>
          <option>Não há fabricantes registrados</option>
        </tr>
        <?php
          }
        ?>
      </select><br><br>
      <input type="text" name="txtcode" maxlength="20" placeholder="Código" value="<?php echo $sql_sel_products_dados['code'] ?>"><br>
      <input type="text" name="txtmodel" maxlength="45" placeholder="Modelo" value="<?php echo $sql_sel_products_dados['model'] ?>"><br>
      <?php
        $sql_sel_categories = "SELECT category,id FROM categories";
        $sql_sel_categories_preparado = $conexaobd -> prepare($sql_sel_categories);
        $sql_sel_categories_preparado -> execute();
      ?>
      <span class="seltitle">Categoria - </span><select class="frmselect" name="selcategory">
        <?php
          if($sql_sel_categories_preparado->rowCount()>0){ // Se tiver mais de um usuário...
            while($sql_sel_categories_dados = $sql_sel_categories_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
        ?>
        <option
        <?php
          if($sql_sel_categories_dados['id'] == $sql_sel_products_dados['categories_id']){
            echo "selected";
          }
        ?>
        value="<?php echo $sql_sel_categories_dados['id'] ?>"><?php echo $sql_sel_categories_dados['category'] ?></option>
        <?php
            }
          }else{ // Se só tiver um usuário...
        ?>
        <tr>
          <option>Não há categorias registradas</option>
        </tr>
        <?php
          }
        ?>
      </select><br><br>
      <?php
        $sql_sel_sizes = "SELECT size,id FROM sizes";
        $sql_sel_sizes_preparado = $conexaobd -> prepare($sql_sel_sizes);
        $sql_sel_sizes_preparado -> execute();
      ?>
      <span class="seltitle">Tamanho - </span><select class="frmselect" name="selsize">
        <?php
          if($sql_sel_sizes_preparado->rowCount()>0){ // Se tiver mais de um usuário...
            while($sql_sel_sizes_dados = $sql_sel_sizes_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
        ?>
        <option
        <?php
          if($sql_sel_sizes_dados['id'] == $sql_sel_products_dados['sizes_id']){
            echo "selected";
          }
        ?>
        value="<?php echo $sql_sel_sizes_dados['id'] ?>"><?php echo $sql_sel_sizes_dados['size'] ?></option>
        <?php
            }
          }else{ // Se só tiver um usuário...
        ?>
        <tr>
          <option>Não há tamanhos registrados</option>
        </tr>
        <?php
          }
        ?>
      </select><br><br>
      <span class="seltitle">Sexo - </span><select class="frmselect" name="selsex">
        <option
        <?php
          if($sql_sel_products_dados['sex'] == '1'){
            echo "selected";
          }
        ?>
        value="1">Masculino</option>
        <option
        <?php
          if($sql_sel_products_dados['sex'] == '2'){
            echo "selected";
          }
        ?>
        value="2">Feminino</option>
        <option
        <?php
          if($sql_sel_products_dados['sex'] == '3'){
            echo "selected";
          }
        ?>
        value="3">Unissex</option>
      </select><br><br>
      <input type="text" name="txtprice" placeholder="Preço" value="<?php echo $sql_sel_products_dados['price'] ?>"><br>
      <button type="reset" name="btnclean"><i class="fa fa-repeat" aria-hidden="true"></i></button>
      <button type="submit" name="btnsend">Alterar</button>
    </form>
  </div>
</div>

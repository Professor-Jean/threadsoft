<div id="contentSingleAdd">
  <h1>Registro de Produto</h1><br>
  <div>
    <form action="?folder=system/products/&file=add_products&ext=php" method="post">
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
        <option value="<?php echo $sql_sel_manufacturers_dados['id'] ?>"><?php echo $sql_sel_manufacturers_dados['name'] ?></option>
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
      <input type="text" name="txtcode" maxlength="20" placeholder="Código"><br>
      <input type="text" name="txtmodel" maxlength="45" placeholder="Modelo"><br>
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
        <option value="<?php echo $sql_sel_categories_dados['id'] ?>"><?php echo $sql_sel_categories_dados['category'] ?></option>
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
        <option value="<?php echo $sql_sel_sizes_dados['id'] ?>"><?php echo $sql_sel_sizes_dados['size'] ?></option>
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
        <option value="1">Masculino</option>
        <option value="2">Feminino</option>
        <option value="3">Unissex</option>
      </select><br><br>
      <input type="text" name="txtprice" placeholder="Preço"><br>
      <button type="reset" name="btnclean"><i class="fa fa-repeat" aria-hidden="true"></i></button>
      <button type="submit" name="btnsend">Cadastrar</button>
    </form>
  </div>
  <div>
    <table class="prodtable">
      <?php
        $sql_sel_products = "SELECT
                              products.id,
                              categories.category,
                              manufacturers.name,
                              products.code,
                              products.model,
                              products.sex,
                              products.price,
                              sizes.size
                            FROM products
                            INNER JOIN products_has_sizes ON products.id = products_has_sizes.products_id
                            INNER JOIN sizes ON products_has_sizes.sizes_id = sizes.id
                            INNER JOIN categories ON categories.id = products.categories_id
                            INNER JOIN manufacturers ON manufacturers.id = products.manufacturers_id";
        $sql_sel_products_preparado = $conexaobd->prepare($sql_sel_products);
        $sql_sel_products_preparado->execute();
      ?>
      <thead>
        <tr>
          <th>Fabricante</th>
          <th>Código</th>
          <th>Modelo</th>
          <th>Categoria</th>
          <th>Tamanho</th>
          <th>Sexo</th>
          <th>Preço</th>
          <th>Editar</th>
          <th>Excluir</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if($sql_sel_products_preparado->rowCount()>0){ // Se tiver mais de um usuário...
            while($sql_sel_products_dados = $sql_sel_products_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
        ?>
        <tr>
          <td><?php echo $sql_sel_products_dados['name']; ?></td>
          <td><?php echo $sql_sel_products_dados['code']; ?></td>
          <td><?php echo $sql_sel_products_dados['model']; ?></td>
          <td><?php echo $sql_sel_products_dados['category']; ?></td>
          <td><?php echo $sql_sel_products_dados['size']; ?></td>
          <td>
            <?php
              if($sql_sel_products_dados['sex']=="1"){
                echo "Masculino";
              }else if($sql_sel_products_dados['sex']=="2"){
                echo "Feminino";
              }else{
                echo "Unissex";
              }
            ?>
          </td>
          <td>R$ <?php echo $sql_sel_products_dados['price']; ?></td>
          <td><a href="?folder=system/products/&file=fmalt_products&ext=php&id=<?php echo $sql_sel_products_dados['id'] ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
          <td><a href="?folder=system/products/&file=del_products&ext=php&id=<?php echo $sql_sel_products_dados['id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
        </tr>
        <?php
            }
          }else{ // Se só tiver um usuário...
        ?>
        <tr>
          <td align="center" colspan="9">Não há registros. </td> <!-- Ele avisa que não há registros -->
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>

<div id="contentHistory">
  <h1>Consulta de Produtos</h1> <br>
  <div class="historyFilters filterdisplay">
    <form action="?folder=system/products/&file=products_view_by_manufacturer&ext=php" method="post">
      <input type="text" name="searchmanufacturer" placeholder="Pesquisa por fabricante">
    </form>
    <form action="?folder=system/products/&file=products_view_by_code&ext=php" method="post">
      <input type="text" name="searchcode" value="" placeholder="Pesquisa por código">
    </form>
    <form action="?folder=system/products/&file=products_view_by_model&ext=php" method="post">
      <input type="text" name="searchmodel" value="" placeholder="Pesquisa por modelo">
    </form>
    <form action="?folder=system/products/&file=products_view_by_category&ext=php" method="post">
      <input type="text" name="searchcategory" value="" placeholder="Pesquisa por categoria">
    </form>
    <form action="?folder=system/products/&file=products_view_by_size&ext=php" method="post">
      <input type="text" name="searchsize" value="" placeholder="Pesquisa por tamanho">
    </form>
    <form action="?folder=system/products/&file=products_view_by_sex&ext=php" method="post">
      <select name="searchsex" onChange="this.form.submit()">
        <option value="" selected>Pesquisa por sexo</option>
        <option value="1">Masculino</option>
        <option value="2">Feminino</option>
        <option value="3">Unissex</option>
      </select>
    </form>
  </div>
  <div class="historyTable historyBroken">
    <?php
      $p_manufacturer = $_POST['searchmanufacturer'];
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
                          INNER JOIN manufacturers ON manufacturers.id = products.manufacturers_id
                          WHERE manufacturers.name LIKE '%".$p_manufacturer."%'";
      $sql_sel_products_preparado = $conexaobd->prepare($sql_sel_products);
      $sql_sel_products_preparado->execute();
    ?>
    <table>
      <thead>
        <tr>
          <th>
            Fabricante
          </th>
          <th>
            Código
          </th>
          <th>
            Modelo
          </th>
          <th>
            Categoria
          </th>
          <th>
            Tamanho
          </th>
          <th>
            Sexo
          </th>
          <th>
            Preço
          </th>
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

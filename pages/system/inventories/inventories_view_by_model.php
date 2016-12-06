<div id="contentHistory">
  <h1>Consulta de Estoque</h1> <br>
  <div class="historyFilters filterdisplay">
    <form action="?folder=system/inventories/&file=inventories_view_by_manufacturer&ext=php" method="post">
      <input type="text" name="searchmanufacturer" placeholder="Pesquisa por fabricante">
    </form>
    <form action="?folder=system/inventories/&file=inventories_view_by_code&ext=php" method="post">
      <input type="text" name="searchcode" value="" placeholder="Pesquisa por código">
    </form>
    <form action="?folder=system/inventories/&file=inventories_view_by_model&ext=php" method="post">
      <input type="text" name="searchmodel" value="" placeholder="Pesquisa por modelo">
    </form>
    <form action="?folder=system/inventories/&file=inventories_view_by_category&ext=php" method="post">
      <input type="text" name="searchcategory" value="" placeholder="Pesquisa por categoria">
    </form>
    <form action="?folder=system/inventories/&file=inventories_view_by_size&ext=php" method="post">
      <input type="text" name="searchsize" value="" placeholder="Pesquisa por tamanho">
    </form>
    <form action="?folder=system/inventories/&file=inventories_view_by_sex&ext=php" method="post">
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
      $p_model = $_POST['searchmodel'];
      $sql_sel_products = "SELECT
                                manufacturers.name,
                                products.code,
                                products.model,
                                categories.category,
                                sizes.size,
                                products.sex,
                                inventories.quantity
                               FROM inventories
                               INNER JOIN products_has_sizes ON inventories.products_has_sizes_id = products_has_sizes.id
                               INNER JOIN products ON products_has_sizes.products_id = products.id
                               INNER JOIN sizes ON sizes.id = products_has_sizes.sizes_id
                               INNER JOIN manufacturers ON products.manufacturers_id = manufacturers.id
                               INNER JOIN categories ON products.categories_id = categories.id
                               WHERE products.model LIKE '%".$p_model."%'
                               ORDER BY inventories.quantity DESC";
      $sql_sel_products_preparado = $conexaobd->prepare($sql_sel_products);
      $sql_sel_products_preparado -> execute();
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
            Quantidade
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
              if($sql_sel_products_dados['sex']=='1'){
                echo "Masculino";
              }else if($sql_sel_products_dados['sex']=='2'){
                echo "Feminino";
              }else if($sql_sel_products_dados['sex']=='3'){
                echo "Unissex";
              }else{
                echo "Erro!";
              }
            ?>
          </td>
          <td><?php echo $sql_sel_products_dados['quantity']; ?></td>
        </tr>
        <?php
            }
          }else{ // Se só tiver um usuário...
        ?>
        <tr>
          <td align="center" colspan="7">Não há registros. </td> <!-- Ele avisa que não há registros -->
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>

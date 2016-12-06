<div id="contentHistory">
  <?php
    $G_id = $_GET['id']; // Pega o ID do usuário que o adm quer deletar
    $sql_sel_removals = "SELECT
                          removals.date,
                          removals.hour,
                          sellers.name
                         FROM removals
                         INNER JOIN sellers
                         ON removals.sellers_id = sellers.id
                         WHERE removals.id = '".$G_id."'";
      $sql_sel_removals_preparado = $conexaobd->prepare($sql_sel_removals);
      $sql_sel_removals_preparado -> execute();
      $sql_sel_removals_dados = $sql_sel_removals_preparado -> fetch();
      $sql_sel_removals_dados['date'] = converterData($sql_sel_removals_dados['date']);
  ?>
  <h1><a href="?folder=system/presents/&file=presents_history&ext=php" class='backalt'><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> Repasse de Brindes (<?php echo $sql_sel_removals_dados['name']; ?>): <?php echo $sql_sel_removals_dados['date'] ?> - <?php echo $sql_sel_removals_dados['hour'] ?></h1> <br>
  <div class="historyTable historyView">
    <table>
      <?php
      $sql_sel_products = "SELECT
                            manufacturers.name,
                            products.code,
                            products.model,
                            categories.category,
                            sizes.size,
                            products.sex,
                            products.price,
                            removals_has_products_has_sizes.quantity
                           FROM removals
                           INNER JOIN removals_has_products_has_sizes ON removals_has_products_has_sizes.removals_id = removals.id
                           INNER JOIN products_has_sizes ON removals_has_products_has_sizes.products_has_sizes_id = products_has_sizes.id
                           INNER JOIN products ON products_has_sizes.products_id = products.id
                           INNER JOIN sizes ON sizes.id = products_has_sizes.sizes_id
                           INNER JOIN manufacturers ON products.manufacturers_id = manufacturers.id
                           INNER JOIN categories ON products.categories_id = categories.id
                           WHERE removals.id = '".$G_id."'";
        $sql_sel_products_preparado = $conexaobd->prepare($sql_sel_products);
        $sql_sel_products_preparado -> execute();
      ?>
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
          <th>
            Preço Unid.
          </th>
          <th>
            Preço Total
          </th>
        </tr>
      </thead>
      <tbody>
        <?php
          if($sql_sel_products_preparado->rowCount()>0){ // Se tiver mais de um usuário...
            while($sql_sel_products_dados = $sql_sel_products_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
        ?>
        <tr>
          <td>
            <?php echo $sql_sel_products_dados['name'] ?>
          </td>
          <td>
            <?php echo $sql_sel_products_dados['code'] ?>
          </td>
          <td>
            <?php echo $sql_sel_products_dados['model'] ?>
          </td>
          <td>
            <?php echo $sql_sel_products_dados['category'] ?>
          </td>
          <td>
            <?php echo $sql_sel_products_dados['size'] ?>
          </td>
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
          <td>
            <?php echo $sql_sel_products_dados['quantity'] ?>
          </td>
          <td>
            R$ <?php echo $sql_sel_products_dados['price'] ?>
          </td>
          <td>
            R$
            <?php
              $total = $sql_sel_products_dados['price'] * $sql_sel_products_dados['quantity'];
              echo $total;
            ?>
          </td>
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

<div id="contentHistory">
  <h1>Consulta de Repasses de Conserto</h1> <br>
  <div class="historyFilters filterdisplay">
    <form action="?folder=system/prod-to-repair/&file=prod-to-repair_history_by_date&ext=php" method="post">
      <input type="text" name="searchdate" value="" placeholder="Pesquisa por data">
    </form>
    <form action="?folder=system/prod-to-repair/&file=prod-to-repair_history_by_seller&ext=php" method="post">
      <input type="text" name="searchseller" value="" placeholder="Pesquisa por vendedor">
    </form>
    <form action="?folder=system/prod-to-repair/&file=prod-to-repair_history_by_code&ext=php" method="post">
      <input type="text" name="searchcode" value="" placeholder="Pesquisa por código">
    </form>
  </div>
  <div class="historyTable historyBroken">
    <?php
      $sql_sel_repairs = "SELECT
                                repairs.date,
                                repairs.hour,
                                removals.id,
                                sellers.name
                                FROM repairs
                                INNER JOIN removals_has_products_has_sizes
                                ON repairs.removals_has_products_has_sizes_id = removals_has_products_has_sizes.id
                                INNER JOIN removals
                                ON removals_has_products_has_sizes.removals_id = removals.id
                                INNER JOIN sellers
                                ON removals.sellers_id = sellers.id
                                WHERE removals.type = 'c'
                                ORDER BY repairs.date DESC, repairs.hour DESC";
      $sql_sel_repairs_preparado = $conexaobd->prepare($sql_sel_repairs);
      $sql_sel_repairs_preparado->execute();
    ?>
    <table>
      <thead>
        <tr>
          <th>
            Data
          </th>
          <th>
            Horário
          </th>
          <th>
            Vendedor
          </th>
          <th>
            Código
          </th>
          <th>
            Reposição
          </th>
        </tr>
      </thead>
      <tbody>
        <?php
          if($sql_sel_repairs_preparado->rowCount()>0){ // Se tiver mais de um usuário...
            while($sql_sel_repairs_dados = $sql_sel_repairs_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
        ?>
        <tr>
          <?php
            $data = converterData($sql_sel_repairs_dados['date']);
          ?>
          <td><a href="?folder=system/prod-to-repair/&file=prod-to-repair_view&ext=php&id=<?php echo $sql_sel_repairs_dados['id'] ?>"><?php echo $data; ?></a></td>
          <td><?php echo $sql_sel_repairs_dados['hour']; ?></td>
          <td><?php echo $sql_sel_repairs_dados['name']; ?></td>
          <td><?php echo $sql_sel_repairs_dados['id']; ?></td>
          <td>
            <a class="botao3" href="?folder=system/prod-to-repair/&file=prod-to-repair_reposition&ext=php&id=<?php echo $sql_sel_repairs_dados['id'] ?>">
              <i class="fa fa-share-square-o" aria-hidden="true"></i>
            </a>
          </td>
        </tr>
        <?php
            }
          }else{ // Se só tiver um usuário...
        ?>
        <tr>
          <td align="center" colspan="5">Não há registros. </td> <!-- Ele avisa que não há registros -->
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>

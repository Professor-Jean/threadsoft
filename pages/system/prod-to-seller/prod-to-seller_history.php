<script type="text/javascript" src="../js/jquery/Chart.min.js"></script>
<script src="../js/disablefilter.js"></script>
<div id="contentHistory">
<h1>Histórico de Repasses de Mercadoria</h1> <br>
<div class="historyFilters filterdisplay">
  <input type="text" name="txtsearch" value="" placeholder="Pesquisa por data">
  <a href="?folder=system/graphs/&file=removals_by_sellers&ext=php"><button type="button" name="btngraph"><i class="fa fa-pie-chart" aria-hidden="true"></i>  Gráfico de Repasses de Mercadoria</button></a>
  <form action="?folder=system/prod-to-seller/&file=prod-to-seller_history_by_method&ext=php" method="post">
    <span class="methodFilter">M</span> <input onChange="this.form.submit()" type="radio" name="rdmetodo" value="m"> Mercadoria
    <span class="methodFilter">C</span> <input onChange="this.form.submit()" type="radio" name="rdmetodo" value="c"> Conserto
  </form>
</div>
<div class="historyTable">
  <table>
    <?php
        $sql_sel_removals = "SELECT
                              date,
                              hour,
                              id,
                              type
                             FROM removals
                             WHERE type='m' OR type='c'
                             ORDER BY date DESC, hour DESC";
        $sql_sel_removals_preparado = $conexaobd->prepare($sql_sel_removals);
        $sql_sel_removals_preparado -> execute();
      ?>
    <thead>
      <tr>
        <th>
          Data
        </th>
        <th>
          Horário
        </th>
        <th>
          Método
        </th>
        <th>
          Código
        </th>
      </tr>
    </thead>
    <tbody>
      <?php
        if($sql_sel_removals_preparado->rowCount()>0){ // Se tiver mais de um usuário...
          while($sql_sel_removals_dados = $sql_sel_removals_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
      ?>
      <tr>
        <td>
          <a href="?folder=system/prod-to-seller/&file=prod-to-seller_view&ext=php&id=<?php echo $sql_sel_removals_dados['id'] ?>">
            <?php
              $sql_sel_removals_dados['date'] = converterData($sql_sel_removals_dados['date']);
              echo $sql_sel_removals_dados['date'];
            ?>
          </a>
        </td>
        <td>
          <?php echo $sql_sel_removals_dados['hour'] ?>
        </td>
        <td>
          <?php
            if($sql_sel_removals_dados['type']=='m'){
              echo "Mercadoria";
            }else if($sql_sel_removals_dados['type'=='c']){
              echo "Conserto";
            }else if($sql_sel_removals_dados['type'=='d']){
              echo "Devolução";
            }else{
              echo "Erro!";
            }
          ?>
        </td>
        <td>
          <?php echo $sql_sel_removals_dados['id'] ?>
        </td>
      </tr>
      <?php
          }
        }else{ // Se só tiver um usuário...
      ?>
      <tr>
        <td align="center" colspan="4">Não há registros. </td> <!-- Ele avisa que não há registros -->
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
</div>
<script type="text/javascript" src="../js/graphModal.js"></script>

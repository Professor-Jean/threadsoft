<script type="text/javascript" src="../js/jquery/Chart.min.js"></script>
<script src="../js/disablefilter.js"></script>
<div id="contentHistory">
<h1 onLoad="openGraphModal()">Histórico de Repasses de Mercadoria</h1> <br>
<div class="historyFilters filterdisplay">
  <input type="text" name="txtsearch" value="" placeholder="Pesquisa por data">
  <button onclick="openGraphModal()" type="button" name="btngraph"><i class="fa fa-pie-chart" aria-hidden="true"></i>  Gráfico de Repasses de Mercadoria</button>
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
<div id="graphModal" class="graphModal"> <!-- modal com as informações do desenvolvedor -->
<div class="graphModal-content"> <!-- conteúdo da modal -->
  <span onclick="closeGraphModal()" class="closeModal"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
    <h1>Gráfico de Repasses de Mercadoria</h1>
    <canvas id="myChart" width="500px" height="200px"></canvas>
    <script>
      <?php
        $sql_sel_sellers = "SELECT sellers.name,
                                   sellers.id
                            FROM sellers
                            INNER JOIN removals
                            GROUP BY sellers.name";
        $sql_sel_sellers_preparado = $conexaobd -> prepare($sql_sel_sellers);
        $sql_sel_sellers_preparado -> execute();
        $numero_linhas = $sql_sel_sellers_preparado -> rowCount();
        for ($i=0; $i < $numero_linhas; $i++) {
          $sql_sel_sellers_dados = $sql_sel_sellers_preparado -> fetch();
          $sql_sel_removals = "SELECT * FROM removals WHERE sellers_id = '".$sql_sel_sellers_dados['id']."'";
          $sql_sel_removals_preparado = $conexaobd -> prepare($sql_sel_removals);
          $sql_sel_removals_preparado -> execute();
          $sql_sel_removals_rowcount[$i] = $sql_sel_removals_preparado -> rowCount();
          $name[$i] = $sql_sel_sellers_dados['name'];
        }
      ?>
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
          type: 'pie',
          data: {
              labels: [
                <?php
                for ($i=0; $i < $numero_linhas; $i++) {
                  echo "'".$name[$i]."', ";
                  }
                ?>
              ],
              datasets: [{
                  label: ' of Votes',
                  data: [
                    <?php
                    for ($i=0; $i < $numero_linhas; $i++) {
                      echo "'".$sql_sel_removals_rowcount[$i]."', ";
                      }
                    ?>
                  ],
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(255, 159, 64, 0.2)'
                  ],
                  borderColor: [
                      'rgba(255,99,132,1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(153, 102, 255, 1)',
                      'rgba(255, 159, 64, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero:true
                      }
                  }]
              }
          }
      });
      </script>
      <div class="graphFooter">
        <form action="?folder=system/prod-to-seller/&file=prod-to-seller_history_filtergraph&ext=php" method="post">
          <span>
            <input type="checkbox" onChange="disableFilter()" name="name" value="" > Mês atual
          </span>
          De:
          <select id="disabledjs1">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
          </select>
          Até:
          <select id="disabledjs2">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
          </select>
          <button type="submit" name="button">Filtrar</button>
        </form>
      </div>
</div> <!-- fim do conteúdo da modal -->
</div> <!-- fim da modal -->
<script type="text/javascript" src="../js/graphModal.js"></script>

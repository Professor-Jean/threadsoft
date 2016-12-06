<script type="text/javascript" src="../js/jquery/Chart.min.js"></script>
<script src="../js/disablefilter.js"></script>
<div class="graphModal-content">
  <h1>Gráfico de Repasses de Mercadoria</h1>
  <canvas id="myChart" width="500px" height="200px"></canvas>
  <script>
    <?php
      if(isset($_POST['UCD'])){
        $useCurrentDate = $_POST['UCD'];
      }
      if(isset($useCurrentDate)){
        $date_end = date('Y-m-d');
        $date_start = date('Y-m-01', strtotime("-1 Months"));
      }else{
        $date_start = date('Y-'.$_POST['start']."-01");
        $date_end = date("Y-".$_POST['end']."-d");
      }
      $sql_sel_sellers = "SELECT sellers.name,
                                 sellers.id,
                                 removals.date
                          FROM sellers
                          INNER JOIN removals
                          ON removals.sellers_id = sellers.id
                          GROUP BY sellers.name";
      $sql_sel_sellers_preparado = $conexaobd -> prepare($sql_sel_sellers);
      $sql_sel_sellers_preparado -> execute();
      $numero_linhas = $sql_sel_sellers_preparado -> rowCount();
      for ($i=0; $i < $numero_linhas; $i++) {
        $sql_sel_sellers_dados = $sql_sel_sellers_preparado -> fetch();
        $sql_sel_removals = "SELECT * FROM removals WHERE sellers_id = '".$sql_sel_sellers_dados['id']."' AND removals.date BETWEEN '".$date_start."' AND '".$date_end."'";
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
      <form action="?folder=system/graphs/&file=removals_by_sellers_filter&ext=php" method="post">
        <span>
          <input type="checkbox" onChange="disableFilter()" name="UCD"> Mês atual /
        </span>
        De:
        <select id="disabledjs1" name="start">
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
        <select id="disabledjs2" name="end">
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
  <script type="text/javascript" src="../js/graphModal.js"></script>
</div>

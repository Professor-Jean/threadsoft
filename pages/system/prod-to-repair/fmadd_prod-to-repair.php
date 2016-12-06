<script src="../js/disablefilter.js"></script>
<script src="../js/mestredetalhe.js"></script>
<script src="../js/jquery/jquery-3.1.1.min.js"></script>
<form action="?folder=system/prod-to-repair/&file=add_prod-to-repair&ext=php" method="post" onsubmit="return validaDetalhe()">
  <div id="contentHistory">
    <h1>Repasse de Produtos para Conserto</h1><br>
     <button class="regentries" type="submit" name="btnsend">Cadastrar</button><br>
    <div class="historyFilters">
      Data: <input type="text" name="txtdate" value="" placeholder="DD/MM/AAAA" id="disabledjs1"><i class="fa fa-calendar" aria-hidden="true"></i>
      Horário: <input type="text" name="txthour" value="" placeholder="HH:MM" id="disabledjs2"><i class="fa fa-calendar" aria-hidden="true"></i>
      <input onClick="disableFilter()" type="checkbox" id="useCurrentDate" name="useCurrentDate"><label for="useCurrentDate">Usar data e horário atuais</label> <br>
      <?php
        $sql_sel_checks = "SELECT name, id FROM sellers";
        $sql_sel_checks_preparado = $conexaobd -> prepare($sql_sel_checks);
        $sql_sel_checks_preparado -> execute();
      ?>
      <span class="seltitle">Vendedor - </span><select class="frmselect" name="selseller" onChange="mostrarRepasse(this)">
        <option value="" selected>Selecione um vendedor</option>
        <?php
          if($sql_sel_checks_preparado->rowCount()>0){ // Se tiver mais de um usuário...
            while($sql_sel_checks_dados = $sql_sel_checks_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
        ?>
        <option value="<?php echo $sql_sel_checks_dados['id'] ?>"><?php echo $sql_sel_checks_dados['name'] ?></option>
        <?php
            }
          }else{ // Se só tiver um usuário...
        ?>
        <tr>
          <option>Não há vendedores registrados</option>
        </tr>
        <?php
        }
        ?>
      </select><br>
      <span class="seltitle">Repasse - </span>
      <select class="frmselect" name="selrepasse" id="selrepasse">
      </select><br>
    </div>
    </div>
  </div>
</form>

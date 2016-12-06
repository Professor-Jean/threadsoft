<script src="../js/disablefilter.js"></script>
<script src="../js/mestredetalhe.js"></script>
<script src="../js/jquery/jquery-3.1.1.min.js"></script>
<form action="?folder=system/entries/&file=add_entries&ext=php" method="post" onsubmit="return validaDetalhe()">
  <div id="contentHistory">
    <h1>Entrada de Produtos em Estoque</h1><br>
     <button class="regentries" type="submit" name="btnsend">Cadastrar</button><br>
    <div class="historyFilters">
      <input onClick="disableFilter()" type="checkbox" id="useCurrentDate" name="useCurrentDate"><label for="useCurrentDate">Usar data e horário atuais</label> <br>
      Data: <input type="text" name="txtdate" value="" placeholder="DD/MM/AAAA" id="disabledjs1"><i class="fa fa-calendar" aria-hidden="true"></i>
      Horário: <input type="text" name="txthour" value="" placeholder="HH:MM" id="disabledjs2"><i class="fa fa-calendar" aria-hidden="true"></i>
    </div>
    <h1>Produtos</h1>
    <div class="historyTable historyChecks">
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
            <th>
              Quantidade
            </th>
            <th>
              <a href="#" class="adicionarCampo" title="Adicionar linha"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr class="linhas" id="id__0">
            <td>
              <?php
                $sql_sel_manufacturers = "SELECT name,id FROM manufacturers";
                $sql_sel_manufacturers_preparado = $conexaobd -> prepare($sql_sel_manufacturers);
                $sql_sel_manufacturers_preparado -> execute();
              ?>
              <select name="selfabricante[]" id="selfabricante" onChange="mostrarCodigo(this)">
                <option selected="">Selecione um fabricante</option>
                <?php
                  if($sql_sel_manufacturers_preparado->rowCount()>0){ // Se tiver mais de um usuário...
                    while($sql_sel_manufacturers_dados = $sql_sel_manufacturers_preparado->fetch()){ // Enquanto ainda não tiver chegado no último usuário...
                ?>
                <option value="<?php echo $sql_sel_manufacturers_dados['id'] ?>"><?php echo $sql_sel_manufacturers_dados['name'] ?></option>
                <?php
                    }
                ?>
                <?php
                  }
                ?>
              </select><br><br>
            </td>
            <td>
              <select id="selcodigo" name="selcodigo[]" onChange="mostrarDetalhes(this)">
              </select>
            </td>
            <td>
              <input disabled name="txtmodelo[]" type="text" id="modelo" value="">
            </td>
            <td>
              <input disabled name="txtcategoria[]" type="text" id="categoria" value="">
            </td>
            <td>
              <input disabled name="txttamanho[]" type="text" id="tamanho" value="">
            </td>
            <td>
              <input disabled name="txtsexo[]" type="text" id="sexo" value="">
            </td>
            <td>
              <input disabled name="txtpreco[]" type="text" id="preco" value="">
            </td>
            <td>
              <input type="text" name="txtquantity[]" value="">
            </td>
            <td>
              <a href="#" class="removerCampo" title="Remover linha"><i class="fa fa-minus-square" aria-hidden="true"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</form>

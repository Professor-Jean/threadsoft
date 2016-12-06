<div id="result">
  <h1>Aviso</h1>
  <?php
    $p_code = $_POST['selcodigo'];
    $p_quantity = $_POST['txtquantity'];
    $p_seller = $_POST['selseller'];
    $p_UCD = $_POST['useCurrentDate'];
    if($p_UCD){
      $p_date = date("d/m/Y");
      $p_hour = date("H:i");
    }else{
      $p_date = $_POST['txtdate'];
      $p_hour = $_POST['txthour'];
    }
    $p_date = converterData($p_date);
    // conta quantos "detalhes" foram preenchidos
    $q_code = count($p_code);
    // indica que tudo está preenchido corretamente, até que alguém diga que não
    //cria uma repetição para validar os dados
    for($i=0; $i<$q_code; $i++){
    	//se, no array recebido, a posição atual da contadora estiver vazia
    	if($p_code[$i]==""){
    		// altera o valor da variável criada anteriormente, dizendo que não está preenchido corretamente!
    		$p_code_validacao =  false;
    		//sai da repetição
    		break;
    	}else{
        	$p_code_validacao =  true;
      }
    	if($p_quantity[$i]==""){
    		$p_quantity_validacao =  false; // aqui diz que não está preenchido corretamente!
    		break;
    	}else{
        $p_quantity_validacao =  true;
      }
    }
    //se a variável for false (falso), alguma das posições do array não está preenchida!
    if($p_date == ""){
      $msg = "O campo \"DATA\" não foi preenchido!";
    }else if($p_seller == ""){
      $msg = "O campo \"VENDEDOR\" não foi preenchido!";
    }else if($p_hour == ""){
      $msg = "O campo \"HORÁRIO\" não foi preenchido!";
    }else if(!$p_code_validacao){
    	$msg = "Algum código não foi selecionado!";
    }else if(!$p_quantity_validacao){
  	  	$msg = "Alguma quantidade não foi preenchida!";
    		// se nenhuma variável tiver o valor falso, faz o que tem que fazer...
    	  }else{
          $q_code = count($p_code);
          for($i=0; $i<$q_code; $i++){
              $sql_sel_removals = "SELECT inventories.quantity,
                                          inventories.id AS inventories_id,
                                          products_has_sizes.id AS pds_id
                                   FROM inventories
                                   INNER JOIN products_has_sizes
                                   ON inventories.products_has_sizes_id = products_has_sizes.id
                                   INNER JOIN products on products_has_sizes.products_id = products.id
                                   WHERE products.code = '".$p_code[$i]."'";
              $sql_sel_removals_preparado = $conexaobd -> prepare($sql_sel_removals);
              $sql_sel_removals_preparado -> execute();
              $sql_sel_removals_dados = $sql_sel_removals_preparado -> fetch();
              $quantity = $sql_sel_removals_dados['quantity'] - $p_quantity[$i];
              if($quantity > 0){
                $tabela = "removals";
                $dados = array(
                  'sellers_id' => $p_seller,
                  'date' => $p_date,
                  'hour' => $p_hour,
                  'type' => 'b'
                );
                $sql_add_removals_resultado = adicionar($tabela, $dados);
                if($sql_add_removals_resultado){
                  $removals_id = $conexaobd->lastInsertId();
                  $tabela = "removals_has_products_has_sizes";
                  $dados = array(
                    'removals_id' => $removals_id,
                    'products_has_sizes_id' => $sql_sel_removals_dados['pds_id'],
                    'quantity' => $p_quantity[$i]
                  );
                  $sql_del_removals_has_products_has_sizes_resultado = adicionar($tabela, $dados);
                  if($sql_del_removals_has_products_has_sizes_resultado){
                    $tabela = 'inventories';
                    $dados = array(
                      'quantity' => $quantity
                    );
                    $condicao = "id=".$sql_sel_removals_dados['inventories_id'];
                    $sql_alt_inventories_resultado = alterar($tabela, $dados, $condicao);
                    if($sql_alt_inventories_resultado){
                      $msg = "Registro de repasse de brindes para vendedores cadastrado com sucesso!";
                    }else{
                      $msg = "Erro ao efetuar cadastro de repasse de brindes para vendedores. [erro 03]";
                    }
                  }else{
                    $msg = "Erro ao efetuar cadastro de repasse de brindes para vendedores. [erro 02]";
                  }
                }else{
                  $msg = "Erro ao efetuar cadastro de repasse de brindes para vendedores. [erro 01]";
                }
              }else if($quantity=='0'){
                $tabela = "removals";
                $dados = array(
                  'sellers_id' => $p_seller,
                  'date' => $p_date,
                  'hour' => $p_hour,
                  'type' => 'b'
                );
                $sql_add_removals_resultado = adicionar($tabela, $dados);
                if($sql_add_removals_resultado){
                  $removals_id = $conexaobd->lastInsertId();
                  $tabela = "removals_has_products_has_sizes";
                  $dados = array(
                    'removals_id' => $removals_id,
                    'products_has_sizes_id' => $sql_sel_removals_dados['pds_id'],
                    'quantity' => $p_quantity[$i]
                  );
                  $sql_del_removals_has_products_has_sizes_resultado = adicionar($tabela, $dados);
                  if($sql_del_removals_has_products_has_sizes_resultado){
                    $tabela = 'inventories';
                    $condicao = 'id='.$sql_sel_removals_dados['inventories_id'];
                    $sql_del_inventories_resultado = deletar($tabela, $condicao);
                    if($sql_del_inventories_resultado){
                      $msg = 'Registro de repasse de brindes para vendedores cadastrado com sucesso!';
                    }else{
                      $msg =  "Erro ao efetuar cadastro de repasse de brindes para vendedores. [erro 04]";
                    }
                  }else{
                    $msg =  "Erro ao efetuar cadastro de repasse de brindes para vendedores. [erro 05]";
                  }
                }else{
                  $msg =  "Erro ao efetuar cadastro de repasse de brindes para vendedores. [erro 06]";
                }
              }else if($quantity < '0'){
                $msg = "Não há produtos suficientes no estoque!";
              }
            }
          }

  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="?folder=system/presents/&file=fmadd_presents&ext=php">Voltar</a>
</div>

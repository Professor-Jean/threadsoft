<div id="result">
  <h1>Aviso</h1>
  <?php
    $p_code = $_POST['selcodigo'];
    $p_quantity = $_POST['txtquantity'];
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
            $sql_sel_products = "SELECT products_has_sizes.id
                                 FROM products
                                 INNER JOIN products_has_sizes ON products_has_sizes.products_id = products.id
                                 WHERE products.code = '".$p_code[$i]."'";
            $sql_sel_products_preparado = $conexaobd->prepare($sql_sel_products);
            $sql_sel_products_preparado->execute();
            $sql_sel_products_dados = $sql_sel_products_preparado->fetch();
            $sql_sel_inventories = "SELECT products.code, inventories.quantity, inventories.id
                                    FROM inventories
                                    INNER JOIN products_has_sizes ON products_has_sizes.id = inventories.products_has_sizes_id
                                    INNER JOIN products ON products.id = products_has_sizes.products_id
                                    WHERE products.code='".$p_code[$i]."'";
            $sql_sel_inventories_preparado = $conexaobd->prepare($sql_sel_inventories);
            $sql_sel_inventories_preparado -> execute();
            if($sql_sel_inventories_preparado->rowCount()>0){
              $sql_sel_inventories_dados = $sql_sel_inventories_preparado->fetch();
              $q_quantity = $sql_sel_inventories_dados['quantity'];
              $quantity = $q_quantity + $p_quantity[$i];
              $tabela = "inventories";
              $dados = array(
                'quantity' => $quantity
              );
              $condicao = "id=".$sql_sel_inventories_dados['id'];
              $sql_alt_inventories_resultado = alterar($tabela, $dados, $condicao);
              if($sql_alt_inventories_resultado){
                $tabela = 'entries';
                $dados = array(
                  'date' => $p_date,
                  'hour' => $p_hour,
                  'type' => '1'
                );
                $sql_add_entries_resultado = adicionar($tabela, $dados);
                if($sql_add_entries_resultado){
                  $entries_id = $conexaobd->lastInsertId();
                  $tabela = 'entries_has_products_has_sizes';
                  $dados = array(
                    'entries_id' => $entries_id,
                    'products_has_sizes_id' => $sql_sel_products_dados['id'],
                    'quantity' => $p_quantity[$i]
                  );
                  $sql_add_entries2_resultado = adicionar($tabela, $dados);
                  if($sql_add_entries2_resultado){
                    $msg = "Entrada de produtos em estoque cadastrada corretamente!";
                  }else{
                    $msg = "Erro ao efetuar cadastro de entrada de produtos em estoque. [erro 01]";
                  }
                }
              }
              }else{
                $tabela = "inventories";
                $dados = array(
                  'products_has_sizes_id' => $sql_sel_products_dados['id'],
                  'quantity' => $p_quantity[$i]
                );
                $sql_add_inventories_resultado = adicionar($tabela, $dados);
                if($sql_add_inventories_resultado){
                  $tabela = "entries";
                  $dados = array(
                    'date' => $p_date,
                    'hour' => $p_hour,
                    'type' => '1'
                  );
                  $sql_add_entries_resultado = adicionar($tabela, $dados);
                  if($sql_add_entries_resultado){
                    $entries_id = $conexaobd->lastInsertId();
                    $tabela = 'entries_has_products_has_sizes';
                    $dados = array(
                      'entries_id' => $entries_id,
                      'products_has_sizes_id' => $sql_sel_products_dados['id'],
                      'quantity' => $p_quantity[$i]
                    );
                    $sql_add_entries2_resultado = adicionar($tabela, $dados);
                    if($sql_add_entries2_resultado){
                      $msg = "Entrada de produtos em estoque cadastrada corretamente!";
                    }else{
                      $msg = "Erro ao efetuar cadastro de entrada de produtos em estoque. [erro 02]";
                    }
                  }else{
                    $msg = "Erro ao efetuar cadastro de entrada de produtos em estoque. [erro 03]";
                  }
                }else{
                  $msg = "Erro ao efetuar cadastro de entrada de produtos em estoque. [erro 04]";
                }
              }
            }
          }
  ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="?folder=system/entries/&file=fmadd_entries&ext=php">Voltar</a>
</div>

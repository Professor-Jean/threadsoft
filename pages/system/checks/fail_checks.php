<div id="result">
  <h1>Aviso</h1>
  <?php
      $url = "?folder=system/checks/&file=checks_view&ext=php";
      $g_id = $_GET['id']; // Pega o ID do usuário que o adm quer deletar$p_id
      $tabela = "checks";
      $dados = array(
        'status' => '3'
      );
      $condicao = "id=".$g_id;
      $sql_add_checks_resultado = alterar($tabela, $dados, $condicao);
      if($sql_add_checks_resultado){
        $msg = "Cheque falho corretamente!";
      }else{
        $msg = "Erro ao efetuar falha de cheque.";
      }
    ?>
  <p>
    <?php echo $msg ?>
  </p>
  <a href="<?php echo $url ?>">Voltar</a>
</div>

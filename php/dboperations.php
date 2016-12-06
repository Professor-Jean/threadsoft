<?php
  function adicionar($adc_tabela, $adc_dados){
    //print_r($adc_dados);
    $adc_campos = array_keys($adc_dados);
    $adc_n_campos = count($adc_dados);
    $adc_sintaxe = "INSERT INTO ".$adc_tabela." (";
    for ($adc_aux=0; $adc_aux < $adc_n_campos; $adc_aux++) {
      $adc_sintaxe.= $adc_campos[$adc_aux].", ";
    };
    $adc_sintaxe = substr($adc_sintaxe, 0, -2);
    $adc_sintaxe.= ") VALUES (";
    for ($adc_aux=0; $adc_aux < $adc_n_campos; $adc_aux++) {
      $adc_sintaxe.= "'".addslashes($adc_dados[$adc_campos[$adc_aux]])."', ";
    };
    $adc_sintaxe = substr($adc_sintaxe, 0, -2);
    $adc_sintaxe.= ")";
    global $conexaobd;
    $adc_preparado = $conexaobd -> prepare($adc_sintaxe);
    $adc_resultado = $adc_preparado -> execute();
    return $adc_resultado;
  }

  function alterar($alt_tabela, $alt_dados, $alt_condicao){
    $alt_campos = array_keys($alt_dados);
    $alt_n_campos = count($alt_dados);
    $alt_sintaxe = "UPDATE ".$alt_tabela." SET ";
    for ($alt_aux=0; $alt_aux<$alt_n_campos ; $alt_aux++){
      if($alt_dados[$alt_campos[$alt_aux]]!=""){
        $alt_sintaxe .= $alt_campos[$alt_aux]."='".addslashes($alt_dados[$alt_campos[$alt_aux]])."', ";
      }else{
        $alt_sintaxe .= $alt_campos[$alt_aux]."=NULL, ";
      }
    }
    $alt_sintaxe = substr($alt_sintaxe, 0, -2);
    $alt_sintaxe .= " WHERE ".$alt_condicao;
    global $conexaobd;
    $alt_preparado = $conexaobd->prepare($alt_sintaxe);
    $alt_resultado = $alt_preparado->execute();
    return $alt_resultado;
  }

  function deletar($del_tabela, $del_condicao){
    $del_sintaxe = "DELETE FROM ".$del_tabela." WHERE ".$del_condicao;
    global $conexaobd;
    $del_preparado = $conexaobd->prepare($del_sintaxe);
    $del_resultado = $del_preparado->execute();
    return $del_resultado;
  }

  function converterData( $data ){
    if ( ! strstr( $data, '/' ) )
    {
            // $data está no formato ISO (yyyy-mm-dd) e deve ser convertida
            // para dd/mm/yyyy
            sscanf( $data, '%d-%d-%d', $y, $m, $d );
            return sprintf( '%d/%d/%d', $d, $m, $y );
    }
    else
    {
            // $data está no formato brasileiro e deve ser convertida para ISO
            sscanf( $data, '%d/%d/%d', $d, $m, $y );
            return sprintf( '%d-%d-%d', $y, $m, $d );
    }

    return false;
  }
?>

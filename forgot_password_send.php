<?php
  include "security/database/dbconfig.php";
  include "security/database/dbconnect.php";
  include "php/dboperations.php";
  require_once("php/class.mymail.php");
  $sql_sel_users = "SELECT id FROM users WHERE email='".$_POST['txtemail']."'";
  $sql_sel_users_preparado = $conexaobd -> prepare($sql_sel_users);
  $sql_sel_users_preparado -> execute();
  $sql_sel_users_dados = $sql_sel_users_preparado -> fetch();
  if($sql_sel_users_preparado->rowCount()>0){
    $tabela = "users";
    $condicao = "id=".$sql_sel_users_dados['id'];
    $senha = geraSenha(8, false, true);
    $dados = array(
      'password' => $senha
    );
    $sql_alt_users = alterar($tabela, $dados, $condicao);
      if($sql_alt_users){
        $to = $_POST['txtemail'];
        $from = "mateusgmsrocha@gmail.com";
        $subject = "Alteração de senha";
        $message = "<strong>Nova senha: </strong>".$senha;
        $replies = "mateusgmsrocha@gmail.com";
        $cc = "";
        $bcc = "";

        /*
          Exemplo simples de envio de e-mail.
          É importante ressaltar que onde é ~array~ deve ser um array, nem que só possua uma posição.
          Os valores setados acima poderiam vir de um formulário (até um forma de array).
        */

        $mymail = new MyMail();

        $mymail->setTo(array($to)); //obrigatório

        $mymail->setFrom($from); //obrigatório

        $mymail->setSubject($subject); //obrigatório

        $mymail->setMessage($message); //obrigatório

        $mymail->setReplies(array($replies));

        $mymail->setCC(array($cc));

        $mymail->setBCC(array($bcc));

        if($mymail->sendMail()===true){
          echo "E-mail enviado com sucesso!";
        }else{
          echo "Problema ao enviar o e-mail.";
        }
        echo "Testando envio de e-mail...";
      }else{ //Else alt users
        echo "Erro para alterar senha!";
    }
  }else{
    echo "Não existe nenhum usuário cadastrado com esse e-mail.";
  }
 ?>
<br><br>
 <a href="index.php">Voltar</a>

//Abaixo  códoigo Javascript com jQuery que permite remover e adicionar campos do formulário.

//Aqui iniciamos o array categoriaAntigo, que receberá o último valor (ou seja, o valor antes da mudança) de cada categoria
//Agora ele só recebe o valor da primeira categoria, que por enquanto é o mesmo do campo vazio ("")
categoriaAntigo = new Array();
categoriaAntigo[0] = "";

//inicia as funções de remover/adicionar campo
$(function () {

//cria a função removeCampo
  function removeCampo() {
    //desvincula os elementos da class "removerCampo" à função criada abaixo, para que o alert de "A última linha não pode ser removida." funcione apenas quando necessário
    $(".removerCampo").unbind("click");
    //ao se clicar em um elemento com a class removerCampo, inicia uma função em que...
    $(".removerCampo").bind("click", function () {
      //... se a quantidade de tags tr com a classe linhas for maior que 1 (ou seja, se houver mais de uma linha no mestre-detalhe - isso serve para evitar que se exclua todas as linhas)
      if($("tr.linhas").length > 1){
        //remove a linha que contém o botão de excluir clicado (explicando: this seria o botão, o primeiro parent é a célula onde está o botão e o segundo parent é a linha onde está o botão, por isso o remove age na linha)
        $(this).parent().parent().remove();
        //chama a função valoresAntigos para guardar os valores atuais das categorias como antigos
        valoresAntigos();
      //senão
      }else{
        alert("A última linha não pode ser removida.");
      }
      //fecha a function do bind
    });
    //fecha a função removeCampo
  }

  //Ao clicar no botão adicionarCampo, inicia a seguinte função:
  $(".adicionarCampo").click(function () {
    //Cria um clone da primeira linha de detalhe e salva na variável novoCampo
    novoCampo = $("tr.linhas:first").clone();
    //esvazia os valores de todos os inputs do clone
    novoCampo.find("input").val("");
    /*inicio da parte que faz com que o select de produtos fique sem opções*/
    //captura todo o array selproduto...
    var esvaziaproduto = document.getElementsByName('selfabricante[]');
    //descobre a última posição do array selproduto e a armazena em last
    last = parseInt($("tr.linhas:last").attr('id').replace('id__', ''));
    now = last + 1;
    novoCampo.attr('id', 'id__'+now);
    //Insere o clone na página, logo após a última linha já existente
    novoCampo.insertAfter("tr.linhas:last");
    /*fim da parte que faz com que o select de produtos fique vazio*/
    //chama a função valoresAntigos para guardar os valores atuais das categorias como antigos
    valoresAntigos();
    //Executa a função removeCampo para que o detalhe inserido ao clicar no botão adicionarCampo possa ser excluido
    removeCampo();
  });
});

/*função criada para receber os valores dos campos existentes, usados posteriormente para descobrirmos se o valor do campo foi alterado ou não*/
function valoresAntigos (){
  //recebe todas as posições do campo selcategoria[] e salva na variável categorias
  var categorias = document.getElementsByName('selcategoria[]');
  //da posição 0 até a posição final do array...
  for (var i=0;i<categorias.length;i++){
    //...captura e salva o valor atual do campo selcategoria no array criado no carregamento da página para os valores antigos
    categoriaAntigo[i] = categorias[i].value;
  }
}

//função que mostra a lista de produtos ao lado da categoria CORRETA
function mostraprodutos(){
  //recebe todas as posições do campo selproduto[] e salva na variável produtoMudar
  var produtoMudar = document.getElementsByName('selproduto[]');
  //recebe todas as posições do campo selcategoria[] e salva na variável categoriaAtual
  var categoriaAtual = document.getElementsByName('selcategoria[]');
  //verifica da posição 0 até a posição final do array...
  for (var j=0;j<produtoMudar.length;j++){
    //...se o valor antigo da categoria for diferente do valor atual da categoria...
    if (categoriaAntigo[j] != categoriaAtual[j].value){
      //é porque essa foi a posição alterada, portanto repassa a posição atual para a variável 'atual'
      atual=j;
    }
  }
  //passa o valor novo do selcategoria que foi alterado para a variável cod
  cod = categoriaAtual[atual].value;
  //mostra o Aguarde no campo
  $(produtoMudar[atual]).html("<option>Aguarde</option>");
  //inicia um processo que envia o código por post para a página buscadinamica.php, que pesquisa dinamicamente pelo código quais os produtos correspondentes àquela categoria e...
  $.post("buscadinamica.php", {cod:cod},
  //inicia uma função que recebe os produtos encontrados na pesquisa da página buscadinamica.php em busca, e...
  function(busca){
    //repassa ao select de produtos correspondente ao de categorias que foi modificado
    $(produtoMudar[atual]).html(busca);
    //chama a função valoresAntigos para guardar os valores atuais das categorias como antigos
    valoresAntigos();
  //fecha o processo do post
  });
//fecha a função mostraprodutos
}

//função de validação dos campos do mestre detalhe
function validaDetalhe(){
  //recebe os valores das categorias preenchidas
  var categoriasValidar = document.getElementsByName('selcategoria[]');
  //recebe os valores dos produtos preenchidos
  var produtosValidar = document.getElementsByName('selproduto[]');
  //recebe os valores das quantidades preenchidas
  var qtdeValidar = document.getElementsByName('txtqtde[]');
  //estrutura para-faça para repetir a validação enquanto i for menor que o tamanho do array, sendo que i começa de 0 e tem incremento 1
  for (var i = 0;i < categoriasValidar.length; i++){
    //cria a variável linha com valor de "i mais um" para a mensagem avisar corretamente qual campo não foi preenchido
    var linha = i+1;
    //se a posição atual dos arrays de categoria e/ou produto estiverem vazios,
    if ((categoriasValidar[i].value=="")||(produtosValidar[i].value=="")||(qtdeValidar[i].value=="")){
      alert ("A linha "+linha+" não foi completamente preenchida.");
      return false;
    }
  }

}

function mostrarRepasse(vendedor){
  var idvendedor = $(vendedor).val();
  var repasse = document.getElementById("selrepasse");
  if(idvendedor!=""){
    $.post('../php/buscadinamica/buscadinamica_repasse.php', {ven:idvendedor}, function(dadosRetornados){
      $(repasse).html(dadosRetornados);
    })
  }
}

function mostrarCodigo(fabricante){
  var idfabricante = $(fabricante).val();
  var index = $(fabricante).parent().parent().attr('id').replace('id__', '');
  var codigo = document.getElementsByName("selcodigo[]");
  if(selfabricante!=""){
    $.post('../php/buscadinamica/buscadinamica_codigo.php', {fab:idfabricante}, function(dadosRetornados){
      $(codigo[index]).html(dadosRetornados);
    })
  }
}

function mostrarCodigoRepasse(fabricante){
  var idfabricante = $(fabricante).val();
  var index = $(fabricante).parent().parent().attr('id').replace('id__', '');
  var codigo = document.getElementsByName("selcodigo[]");
  if(selfabricante!=""){
    $.post('../php/buscadinamica/buscadinamica_codigo_repasse.php', {fab:idfabricante}, function(dadosRetornados){
      $(codigo[index]).html(dadosRetornados);
    })
  }
}

function mostrarDetalhes(element){
  var codigo = $(element).val();
  var index = $(element).parent().parent().attr('id').replace('id__', '');
  var modelo    = document.getElementsByName("txtmodelo[]");
  var categoria = document.getElementsByName("txtcategoria[]");
  var tamanho   = document.getElementsByName("txttamanho[]");
  var sexo      = document.getElementsByName("txtsexo[]");
  var preco     = document.getElementsByName("txtpreco[]");
  if(codigo!=""){

    $.post('../php/buscadinamica/buscadinamica_detalhes.php', {cod: codigo},
    function(dadosJSON){
      var dados = JSON.parse(dadosJSON);
      $(modelo[index]).val(dados.model);
      $(categoria[index]).val(dados.category);
      $(tamanho[index]).val(dados.size);
      $(sexo[index]).val(dados.sex);
      $(preco[index]).val(dados.price);
    });

    // $.post('../php/buscadinamica/buscadinamica_modelo.php', {cod:codigo}, function(dadosRetornadosModelo){
    //   $(modelo[index]).val(dadosRetornadosModelo);
    // })
    // $.post('../php/buscadinamica/buscadinamica_categoria.php', {cod:codigo}, function(dadosRetornadosCategoria){
    //   $(categoria[index]).val(dadosRetornadosCategoria);
    // })
    // $.post('../php/buscadinamica/buscadinamica_tamanho.php', {cod:codigo}, function(dadosRetornadosTamanho){
    //   $(tamanho[index]).val(dadosRetornadosTamanho);
    // })
    // $.post('../php/buscadinamica/buscadinamica_sexo.php', {cod:codigo}, function(dadosRetornadosSexo){
    //   $(sexo[index]).val(dadosRetornadosSexo);
    // })
  }
}

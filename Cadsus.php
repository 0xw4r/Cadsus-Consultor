<?php

ini_set('default_charset','UTF-8');

error_reporting(true);



  $a = $_GET['cpf'];
  echo buscarcpf($a, $sus_cnes, $sus_login, $sus_senha);


function DadosLer($inicio,$fim,$string)
{
  $str = explode($inicio, $string);
  $str = explode($fim, $str[1]);
  return $str[0];
}


function buscarcpf($cpf)
{
$sus_cnes  = "111111"; //cnes do sus
$sus_login = "usercad"; // usuário do sus
$sus_senha = "pass"; // senha do sus

  $usuario = $_SESSION['login-sucesso'];
  $ch = curl_init('https://cadastro.saude.gov.br/cadsusweb/login/actionArmazenarXS.form');
  curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.79 Safari/537.36');

  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__.'/cookie.txt');
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'cnes='.$sus_cnes.'&usuario='.$sus_login.'&senha='.$sus_senha);
  $login1 = curl_exec($ch);

  $ch = curl_init('https://cadastro.saude.gov.br/cadsusweb/j_security_check');
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__.'/cookie.txt');
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'j_username='.$sus_cnes.'.'.$sus_login.'&cnes='.$sus_cnes.'&usuario='.$sus_login.'&j_password='.$sus_senha);
  $login2 = curl_exec($ch);
  
  curl_setopt($ch, CURLOPT_URL, 'https://cadastro.saude.gov.br/cadsusweb/restrito/consultar/pesquisar.form');
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__.'/cookie.txt');
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'usuario=%7B%22idCorporativo%22%3Anull%2C%22idLocal%22%3Anull%2C%22desabilitarDataQuality%22%3Anull%2C%22obsDesabilitarDataQuality%22%3Anull%2C%22numeroProtocoloPrecadastro%22%3Anull%2C%22protocoloPrimeiroAcesso%22%3Anull%2C%22protocolo%22%3Anull%2C%22solicitarAcessoPortal%22%3Afalse%2C%22encontradoReceita%22%3Anull%2C%22cpf%22%3Anull%2C%22numeroCns%22%3A%22%22%2C%22nome%22%3A%22%22%2C%22nomeSocial%22%3A%22%22%2C%22nomeMae%22%3A%22%22%2C%22nomePai%22%3A%22%22%2C%22sexo%22%3Anull%2C%22sexoDescricao%22%3Anull%2C%22racaCor%22%3Anull%2C%22racaCorDescricao%22%3Anull%2C%22dataObito%22%3Anull%2C%22dataOperacaoObito%22%3Anull%2C%22motivoDeclaracaoObito%22%3Anull%2C%22cnesOperador%22%3Anull%2C%22tipoSanguineo%22%3Anull%2C%22etniaIndigena%22%3Anull%2C%22etniaIndigenaDescricao%22%3Anull%2C%22dataNascimento%22%3A%22%22%2C%22nacionalidade%22%3Anull%2C%22paisNascimentoCodigo%22%3Anull%2C%22paisNascimento%22%3Anull%2C%22municipioNascimentoCodigo%22%3A%22%22%2C%22municipioNascimento%22%3A%22%22%2C%22dataNaturalizacao%22%3Anull%2C%22portariaNaturalizacao%22%3Anull%2C%22dataEntradaBrasil%22%3Anull%2C%22emailPrincipal%22%3Anull%2C%22emailAlternativo%22%3Anull%2C%22emailPrincipalValidado%22%3Anull%2C%22emailAlternativoValidado%22%3Anull%2C%22telefone%22%3A%5B%5D%2C%22nomade%22%3Afalse%2C%22enderecoCodigo%22%3Anull%2C%22paisResidenciaCodigo%22%3Anull%2C%22paisResidenciaDescricao%22%3Anull%2C%22enderecoMunicipio%22%3Anull%2C%22enderecoMunicipioCodigo%22%3Anull%2C%22enderecoTipoLogradouro%22%3Anull%2C%22enderecoTipoLogradouroCodigo%22%3Anull%2C%22enderecoLogradouro%22%3Anull%2C%22enderecoNumero%22%3Anull%2C%22enderecoComplemento%22%3Anull%2C%22enderecoBairroCodigo%22%3Anull%2C%22enderecoBairro%22%3Anull%2C%22enderecoCep%22%3Anull%2C%22emailPrincipalCodigo%22%3Anull%2C%22emailAlternativoCodigo%22%3Anull%2C%22dnv%22%3Anull%2C%22numeroInscricaoSocialCodigo%22%3Anull%2C%22numeroInscricaoSocial%22%3Anull%2C%22rgCodigo%22%3Anull%2C%22rgNumero%22%3Anull%2C%22rgOrgaoEmissor%22%3Anull%2C%22rgOrgaoEmissorDescricao%22%3Anull%2C%22rgUf%22%3Anull%2C%22rgDataEmissao%22%3Anull%2C%22tituloEleitorCodigo%22%3Anull%2C%22tituloEleitorNumero%22%3Anull%2C%22tituloEleitorZona%22%3Anull%2C%22tituloEleitorSecao%22%3Anull%2C%22certidao%22%3A%5B%5D%2C%22ctpsCodigo%22%3Anull%2C%22ctpsNumero%22%3Anull%2C%22ctpsSerie%22%3Anull%2C%22ctpsDataEmissao%22%3Anull%2C%22cnhNumero%22%3Anull%2C%22cnhDataEmissao%22%3Anull%2C%22cnhUf%22%3Anull%2C%22passaporteCodigo%22%3Anull%2C%22passaporteNumero%22%3Anull%2C%22passaportePaisCodigo%22%3Anull%2C%22passaportePais%22%3Anull%2C%22passaporteDataValidade%22%3Anull%2C%22passaporteDataEmissao%22%3Anull%2C%22fotografia%22%3A%5B%5D%2C%22situacao%22%3Anull%2C%22dataAlteracao%22%3Anull%2C%22spanSituacao%22%3Anull%2C%22motivoCancelamento%22%3Anull%2C%22spanVip%22%3Anull%2C%22vipDescricao%22%3Anull%2C%22spanProtecao%22%3Anull%2C%22protecaoDescricao%22%3Anull%2C%22motivoNaoHigienizado%22%3Anull%2C%22vivo%22%3Anull%2C%22cartoesAgregados%22%3A%5B%5D%2C%22tipoDocumento%22%3A%22CPF%22%2C%22numeroDocumento%22%3A%22'.$cpf.'%22%7D&byPassHigienizacao=false&tpPesquisa=identica');
  $consultar = curl_exec($ch);

 $numerocns = DadosLer(' "numeroCns": "', '",', $consultar);


  curl_setopt($ch, CURLOPT_URL, "https://cadastro.saude.gov.br/cadsusweb/restrito/consultar/visualizar.form");
         curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__.'/cookie.txt');
         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
         curl_setopt($ch, CURLOPT_POST, true);
         curl_setopt($ch, CURLOPT_POSTFIELDS, "cns=$numerocns");
         $exibir = curl_exec($ch);
         echo $exibir;
         echo $login1;
         echo $login2;
    #     echo "<br><center>";
     #    echo "<b>NOME ►</b> " . DadosLer(' "nome": "', '",', $exibir)."<br>";
      #   echo "<b>NOME DA MÃE ►</b> " . DadosLer(' "nomeMae": "', '",', $exibir)."<br>";
       #  echo "<b>NOME DO PAI ►</b> " . DadosLer(' "nomePai": "', '",', $exibir)."<br>";
        # echo "<b>DATA DE NASCIMENTO ►</b> " . DadosLer(' "dataNascimento": "', '",', $exibir)."<br>";
        # echo "<b>SEXO ►</b> " . DadosLer(' "sexoDescricao": "', '",', $exibir)."<br>";
        # echo "<b>CPF ►</b> " . DadosLer(' "cpf": "', '",', $exibir)."<br>";
        # echo "<b>COR ►</b> " . DadosLer(' "racaCorDescricao": "', '",', $exibir)."<br>";
        # echo "<b>MUNICIPIO ►</b> " . DadosLer(' "enderecoMunicipio": "', '",', $exibir)."<br>";
        # echo "<b>BAIRRO ►</b> " . DadosLer(' "enderecoBairro": "', '",', $exibir)."<br>";
        # echo "<b>CEP ►</b> " . DadosLer(' "enderecoCep": "', '",', $exibir)."<br>";
        # echo "<b>NUMERO DA CASA ►</b> " . DadosLer(' "enderecoNumero": "', '",', $exibir)."<br>";
        # echo "<b>LOGRADOURO ►</b> " . DadosLer(' "enderecoTipoLogradouro": "', '",', $exibir)."<br>";
        # echo "<b>ENDEREÇO ►</b> " . DadosLer(' "enderecoLogradouro": "', '",', $exibir)."<br>";
        #echo "<b>NACIONALIDADE ►</b> " . DadosLer(' "nacionalidade": "', '",', $exibir)."<br>";
        # echo "<b>DDD TELEFONE ►</b> " . DadosLer(' "ddd": ', ',', $exibir)."<br>";
        # echo "<b>NUMERO TELEFONE ►</b> " . DadosLer(' "numero": "', '",', $exibir)."<br>";

}





?>
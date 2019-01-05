<?php

require_once("config.php");

$alterar = new Pessoa();

$alterar->loadById(52);

$alterar->update("Maria");

echo $alterar;

/*
$inserir = new Pessoa("Meu Nome");

$inserir->insert();

echo $inserir;
*/
/*
$auth = new Pessoa();

$auth->login("Marce");

echo($auth);
*/

/*
$search = Pessoa::search("ad");

echo json_encode($search);

*/

/*
$lista = Pessoa::getList();

echo json_encode($lista);
*/


/*
$byId = new Pessoa();

$byId->loadById(100);

echo $byId;
*/

/*
$teste = new Sql("mysql:host=localhost;dbname=dbproject", "root", "");

//$teste = new Sql();

$user = $teste->select("SELECT * FROM tb_pessoa");
*/
//echo json_encode($user);

/*
$teste->setIdpessoa(10);
$teste->setNome("MARCELOG");

echo $teste;

echo $teste->getIdpessoa();
echo "<br>";
echo $teste->getNome();
*/
?>
<?php

/*

1ª parte - Aqui é criado a classe Sql com todos os recusros de PDO, criado a função construct que ao instanciar a classe ela já carrega o que esta dentro automaticamente, ou seja, já conecta no banco

*/

class Sql extends PDO {

	private $conn;

	public function __construct() {

		$this->conn = new PDO("mysql:host=localhost;dbname=dbproject", "root", "");

		//echo "Conectado";

	}

/*

2ª parte - Criado a função select que chama a função query, a qual contem 2 parametros (query passa ao chamar o select no index.php e params que é um array, onde vai receber os dados da tabela). É então feito o prepare da query(SELECT...) percorrido os dados no foreach setando o bindParam para cada valor percorrido, e após finaliza executando. Para mostra os dados a função select retorna o fetchAll

*/
/*
	private function setParams($statement, $parameters = array()) {

		foreach ($parameters as $key => $value) {

			//echo $key . $value;
			$this->setParam($statement, $key, $value);		
		
		}

	}

	private function setParam($statement, $key, $value) {

		$statement->bindParam($key, $value);

	}
*/
	public function query($rawQuery, $params = array()) {

		$stmt = $this->conn->prepare($rawQuery);

		foreach ($params as $key => $value) {

			//echo $key . $value;
			$stmt->bindParam($key, $value);

		}
		//var_dump($this->setParams($stmt, $params));

		$stmt->execute();

		return $stmt;

	}

	public function select($rawQuery,  $params = array()):array {

		$stmt = $this->query($rawQuery, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

}





























/*
class Sql extends PDO {

	private $conn;

	// o metodo construtor ja cria os get's e set's automaticamente dos atributos da classe assim que instanciada, neste caso ele cria a conexão automaticamente
	public function __construct() {

		$this->conn = new PDO("mysql:host=localhost;dbname=dbproject", "root", "");

	}


	public function query($rawQuery, $params = array()) {

		$stmt = $this->conn->prepare($rawQuery);

		//$this->setParams($stmt, $params);

		// inserir o bindParam() aqui se houver parametro

		foreach ($params as $key => $value) {
			
			$stmt->bindParam($key, $value);

		}

		$stmt->execute();

		return $stmt;

	}


	public function select($rawQuery) {

		// fazer a query com o comando prepare, esta função select ira receber via parametro de outra funçao(query)

		$stmt = $this->query($rawQuery);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

}
*/
?>
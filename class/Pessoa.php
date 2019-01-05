<?php

class Pessoa {

	private $idpessoa;
	private $desnome;

	public function getIdpessoa() {

		return $this->idpessoa;

	}

	public function setIdpessoa($idpessoa) {

		$this->idpessoa = $idpessoa;

	}

	public function getDesnome() {

		return $this->desnome;

	}

	public function setDesnome($desnome) {

		$this->desnome = $desnome;

	}

	public function loadById($id) {

		$sql = new Sql();
		
		$result = $sql->select("SELECT * FROM tb_pessoa WHERE idpessoa = :ID", array(
			"ID"=>$id
		));

		if (count($result) > 0) {

			$row = $result[0];

			$this->setIdpessoa($row['idpessoa']);
			$this->setDesnome($row['desnome']);

		} else {

			throw new Exception("ID inválido");
			
		}

	}

	// Como não usamos o $this para acessar outro método ou atributo, podemos setar esta função como estática e assim não precisamos instanciar um objeto para chama-la: ex Class::método() 
	public static function getList() {

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_pessoa ORDER BY desnome");

	}

	public static function search($name) {

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_pessoa WHERE desnome LIKE :SEARCH ORDER BY desnome", array(
			':SEARCH'=>"%".$name."%"
		));

	}


	public function login($nome) {

		$sql = new Sql();

		$result = $sql->select("SELECT * FROM tb_pessoa WHERE desnome = :NOME", array(
			':NOME'=>$nome
		));

		if (count($result) > 0) {
			
			$row = $result[0];

			$this->setIdpessoa($row['idpessoa']);
			$this->setDesnome($row['desnome']);

		} else {

			throw new Exception("Usuário inválido!!", 1);
			
		}

	}

	public static function getListDesnome() {

		$sql = new Sql();

		$result = $sql->select("SELECT desnome FROM tb_pessoa");

		return $result;

	}

	public function insert() {

		$sql = new Sql();

		$sql->select("INSERT INTO tb_pessoa (desnome) VALUES(:NOME)", array(
			':NOME'=>$this->getDesnome()
		));

		$result = $sql->select("SELECT * FROM tb_pessoa WHERE idpessoa = LAST_INSERT_ID();");

		if (count($result) > 0 ) {
			
			$row = $result[0];

			$this->setIdpessoa($row['idpessoa']);
			$this->setDesnome($row['desnome']);

		}

	}

	public function __construct($desnome = "") {

		$this->setDesnome($desnome);

	}


	public function update($desnome) {

		$this->setDesnome($desnome);

		$sql = new Sql();

		return $sql->select("UPDATE tb_pessoa SET desnome = :NOME WHERE idpessoa = :ID", array(
			':NOME'=>$this->getDesnome(),
			':ID'=>$this->getIdpessoa()
		));

	}

	public function delete() {

		$sql = new Sql();

		$sql->select("DELETE FROM tb_pessoa WHERE idpessoa = :ID", array(
			':ID'=>$this->getIdpessoa()
		));

		$this->setIdpessoa(0);
		$this->setDesnome("");

	}


	public function __toString() {

		return json_encode(array(
			"idpessoa"=>$this->getIdpessoa(),
			"desnome"=>$this->getDesnome()
		));

	}

}

?>
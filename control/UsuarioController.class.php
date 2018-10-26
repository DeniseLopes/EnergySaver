<?php
require_once "Functions.class.php";
require_once "Conexao.class.php";
require_once "../../model/UsuarioModel.class.php";
class UsuarioController{
	private $id;
	private $nome;
	private $dt_nasc;
	private $email;
	private $senha;
	private $dt_cadastro;
	private $conexao;
	private $functions;
	private $usuario;

	/*public function querySeleciona($dado) {
		try {
			$this->usuario->setId($this->functions->base64(dado, 2));
			$cst = $this->con->connect()->prepare("select * from usuario where id = :id");
			$cst->bindParam(":id", $this->usuario->getId(), PDO::PARAM_INT);
			$cst->execute();
			return $cst->fetch();
		} catch (PDOException $ex) {
			return "erro :" . $ex->getMessage();
		}
	}*/
	public function __construct(){
		$this->conexao = new Conexao();
		$this->functions = new Functions();
		$this->usuario = new UsuarioModel();
	}

	public function querySelect($dados) {
		try {
			$cst = $this->conexao->connect()->prepare("select * from usuario");
			$cst->execute();
			return $cst->fetchAll();
		} catch (PDOException $ex) {
			echo "erro: " . $ex->getMessage();
		}
	}

	private  function verificaCadastro($email) {
		$cst = $this->conexao->connect()->prepare("select * from usuario where email = :email");
		$cst->bindParam(':email', $email, PDO::PARAM_STR);
		$cst->execute();
		$linhas = $cst->rowCount();
		return $linhas;
	}

	public function queryInsert($dados) {
		$retorno = array();

		$resultado = self::verificaCadastro($dados['email']);
		try {
			if ($resultado == 0) {

				$this->usuario->setNome($this->functions->trataCaracter($dados['nome'], 1));
				$this->usuario->setEmail($dados['email']);
				$this->usuario->setSenha(sha1($dados['senha']));
				$this->usuario->setData_cadastro($this->functions->dateNow(2));
				$cst = $this->conexao->connect()->prepare("insert into usuario(nome,email,senha,dt_cadastro)"
					. "values(:name,:mail,:pass,:dt_cad)");
				$cst->bindValue(":name", $this->usuario->getNome(), PDO::PARAM_STR);
				$cst->bindValue(":mail", $this->usuario->getEmail(), PDO::PARAM_STR);
				$cst->bindValue(":pass", $this->usuario->getSenha(), PDO::PARAM_STR);
				$cst->bindValue(":dt_cad", $this->usuario->getData_cadastro(), PDO::PARAM_STR);
				if ($cst->execute()){
					$retorno['sucesso']=true;
					$retorno['mensagem']= "Usuário inserido com sucesso!";
				}
				
				else{
					
					$retorno['sucesso']=false;
					$retorno['mensagem']= "Erro de inserção!";
				}
			}else{
				$retorno['mensagem']= "O email inserido já está cadastrado";
				$retorno['sucesso']=false;
			}
		} catch (PDOException $ex) {
			$retorno['mensagem']= "erro: " . $ex->getMessage();
		}
		echo json_encode($retorno);
	}



	public function tryLogin($dados){
		try{
			$retorno= array();
			$senha= sha1($dados['senhaL']);

			$cst= $this->conexao->connect()->prepare('select * from usuario where email = :email and senha = :senha');
			$cst->bindParam(":email", $dados['emailL'], PDO::PARAM_STR);
			$cst->bindParam(":senha",$senha, PDO::PARAM_STR);
			if($cst->execute()){

				$linhas = $cst->rowCount();

				if($linhas==0){
					$retorno['mensagem']= "email ou senha invalida";
					$retorno['sucesso']=false;
				}else{
					session_start();
					$rst=$cst->fetch();
					$_SESSION['logado']="sim";
					$_SESSION['id']= $rst['id'];
					$_SESSION['nome']= $rst['nome'];
					$_SESSION['email']= $rst['email'];
					$retorno['mensagem']= "Login realizado com sucesso";
					$retorno['sucesso']=true;
				}
			}else{
				$retorno['mensagem']= "Query error";
				$retorno['sucesso']=false;
			}

		}catch(PDOException $ex){
			$retorno['sucesso']=false;
			
			$retorno['mensagem']= "Erro:" .$ex->getMessage();
			
		}
		echo json_encode($retorno);

	}
	public function logoff(){
		$_SESSION['logado']="não";
		session_start();
		session_destroy();
		echo "saiu";

	}
}
?>
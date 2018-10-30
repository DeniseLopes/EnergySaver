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
	public function verificaEmail($email){
		try{
			session_start();	
			$retorno = array();
			$cst = $this->conexao->connect()->prepare("select * from usuario where id<> :id and email=:email");
			$cst->bindParam(":id", $_SESSION['id'], PDO::PARAM_STR);
			$cst->bindParam(':email',$email, PDO::PARAM_STR);
			if($cst->execute()){
				$linha = $cst->rowCount();
				if($linha==0){
					$retorno['sucesso']=true;
					$retorno['mensagem']="email disponivel";
				}else{
					$retorno['sucesso']=false;
					$retorno['mensagem']="Email em uso";
				}

			}else{
				$retorno['sucesso']= false;
				$retorno['mensagem']="falha na consulta";
			}

		}catch(PDOException $ex){
			$retorno['sucesso']= false;
			$retorno['mensagem']="erro: ".$ex->getMessage();
		}
		echo json_encode($retorno);
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
				$cst = $this->conexao->connect()->prepare("insert into usuario(nome,sobrenome,email,senha,dt_cadastro)"
					. "values(:name,:sobrenome,:mail,:pass,:dt_cad)");
				$cst->bindValue(":name", $this->usuario->getNome(), PDO::PARAM_STR);
				$cst->bindValue(":sobrenome", $dados['sobrenome'], PDO::PARAM_STR);
				$cst->bindValue(":mail", $this->usuario->getEmail(), PDO::PARAM_STR);
				$cst->bindValue(":pass", $this->usuario->getSenha(), PDO::PARAM_STR);
				$cst->bindValue(":dt_cad", $this->usuario->getData_cadastro(), PDO::PARAM_STR);
				if ($cst->execute()){
					$retorno['sucesso']=true;
					$retorno['mensagem']= "cadastrado realizado com sucesso!";
					$con =$this->conexao->connect();
					$id=$con->lastInsertId();
					mkdir("../../uf/".$id ."/",0777,true);
					$srcFile= "../../assets/imgs/perfilDefault.jpg";
					$fileName= $id ."_perfil.jpg";				
					$newSrcFile ="../../uf/".$id. "/".$fileName;
					copy($srcFile, $newSrcFile);
					$newSrc = "../../uf/".$id."/".$fileName;
					$cstImg= $this->conexao->connect()->prepare("update usuario set img_perfil = :img where id = :id");
					$cstImg->bindParam(":img", $newSrc );
					$cstImg->bindParam(':id', $id);
					$cstImg->execute();
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
	/**/	
	public function atualizaFt($nomeFoto){
		try{
			$cst= $this->conexao->connect()->prepare("update usuario set img_perfil = :foto");
			$cst->bindParam(":foto",$nomeFoto, PDO::PARAM_STR);
			return ($cst->execute())?true:false;
		}catch(PDOException $ex){
			return false;
		}
	}
	public function queryUpdate($usuario){

		try{
			$retorno = array();
			session_start();
			$consulta = $this->conexao->connect()->prepare("update usuario set nome= :nome, sobrenome=:sobrenome, email = :email, cpf = :cpf, dt_nasc = :dt_nasc, login = :nick where id = :id");
			$consulta->bindParam(":nome", $_POST['nome'], PDO::PARAM_STR);
			$consulta->bindParam(":sobrenome", $_POST['sobrenome'], PDO::PARAM_STR);
			$consulta->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
			$consulta->bindParam(":cpf", $_POST['cpf'], PDO::PARAM_STR);
			$consulta->bindParam(":dt_nasc", $_POST['dt_nasc'], PDO::PARAM_STR);
			$consulta->bindParam(":nick", $_POST['nick'], PDO::PARAM_STR);
			$consulta->bindParam(":id", $_SESSION['id'], PDO::PARAM_STR);
			if($consulta->execute()){
				$retorno['mensagem']= "dados atualizados com sucesso";
				$retorno['sucesso']=true;
				$_SESSION['dt_nasc']= $_POST['dt_nasc'];
				$_SESSION['email']= $_POST['email'];
				$_SESSION['nome']= $_POST['nome'];
				$_SESSION['sobrenome']= $_POST['sobrenome'];
				$_SESSION['cpf']= $_POST['cpf'];
				$_SESSION['nick']= $_POST['nick'];

			}else{
				$retorno['mensagem']= "Erro ao tentar atualizar os dados do usuário";
				$retorno['sucesso']=false;
			}
		}catch(PDOException $ex){
			$retorno['sucesso']=false;
			$retorno['mensagem']= "erro :".	$ex->getMessage();
		}
		echo json_encode($retorno);
	}

	public function tryLogin($dados){
		try{
			$retorno= array();
			$senha= sha1($dados['senhaL']);
			$cst= $this->conexao->connect()->prepare('select * from usuario where (email = :email or login=:email) and senha = :senha');
			$cst->bindParam(":email", $dados['emailL'], PDO::PARAM_STR);
			$cst->bindParam(":senha",$senha, PDO::PARAM_STR);
			if($cst->execute()){
				$linha = $cst->rowCount();
				if($linha==0){
					$retorno['mensagem']= "email ou senha invalida";
					$retorno['sucesso']=false;
					$retorno['senha'] = $senha;
					$retorno['linha'] = $linha;

				}else{
					session_start();
					$rst=$cst->fetch();
					$_SESSION['logado']="sim";
					$_SESSION['sobrenome']=$rst['sobrenome'];
					$_SESSION['id']= $rst['id'];
					$_SESSION['nick'] = $rst['login'];
					$_SESSION['cpf'] =$rst['cpf'];
					$_SESSION['nome']= $rst['nome'];
					$_SESSION['email']= $rst['email'];
					$_SESSION['img_perfil']= $rst['img_perfil'];
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
	public function uploadFoto($foto){
		try{
			$cst = $this->conexao->connect()->prepare("update usuario set img_perfil = :perfil where id=:id");
			$cst->bindParam(":perfil",$foto, PDO::PARAM_STR);
			$cst->bindParam(":id", $_SESSION['id'], PDO::PARAM_INT);
			if($cst->execute()){
				$_SESSION['img_perfil']= $foto;
			}
		}catch(PDOException $ex){
			$ex->getMessage();
		}
	}
	public function userLogin($email){
		$retorno= array();
		$linhas=0;
		$retorno['sucesso']=false;
		try{
			$cst = $this->conexao->connect()->prepare("select * from usuario where  email=:email or login = :email");
			$cst->bindParam(":email",$email['emailL'], PDO::PARAM_STR);
			if($cst->execute()){
				$linhas= $cst->rowCount();
				$rst =$cst->fetch();
				if($linhas>0){
					$retorno['id'] = $rst['id'];
					$retorno['sucesso']=true;
					$retorno['mensagem']="email ou nick encontrado";
					$retorno['nick'] = $rst['login'];
				}else{
					$retorno['sucesso']=false;
					$retorno['mensagem']="email não cadastrado";
				}
			}else{
				$retorno['sucesso']=false;
				$retorno['mensagem']="erro durante a consulta";
			}
		}catch(PDOException $ex){
			$retorno['sucesso']=false;
			$retorno['mensagem']="erro :". $ex->getMessage();
			
		}
		echo json_encode($retorno);
		
	}
}
?>
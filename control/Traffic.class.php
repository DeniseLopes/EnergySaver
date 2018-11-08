<?php
/**
 * 
 */
require_once "Conexao.class.php";
class Traffic{
	private $conexao;
	private $uri;
	private $ip;
	private $data;
	function __construct(){
		$this->conexao = new Conexao();
		$this->uri = filter_input(INPUT_SERVER, "REQUEST_URI", FILTER_DEFAULT);
		$this->ip = md5(filter_input(INPUT_SERVER, "REMOTE_ADDR", FILTER_DEFAULT));
		$cookie = filter_input(INPUT_COOKIE, $this->uri, FILTER_DEFAULT);

			//$this->_set_cookie();

	}
	private function _set_cookie(){
		setcookie($this->uri,true, time()+strtotime(date("Y-m-d 23:59:59"))-time());
	}
	
}
?>
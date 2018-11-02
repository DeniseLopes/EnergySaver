<?php
class GerenciadorModel{
 private $id;
 private $mac;
 private $ip;
 private $desc;
 private $usuarioId;
 private $status;

 public function getId(){
 	return $this->id;
 }
 public function setId($valor){
 	$this->id = $valor;
 }

 public function getMac(){
 	return $this->mac;
 }
 public function setMac($valor){
 	$this->mac = $valor;
 }

 public function getIp(){
 	return $this->ip;
 }
 public function setIp($valor){
 	$this->ip = $valor;
 }
 public function getDesc(){
 	return $this->desc;
 }
 public function setDesc($valor){
 	$this->desc = $valor;
 }
 public function getUsuarioId(){
 	return $this->usuarioId;
 }
 public function setUsuarioId($valor){
 	$this->usuarioId = $valor;
 }
 public function getStatus(){
 	return $this->status;
 }
 public function setStatus($valor){
 	$this->status = $valor;
 }
}
?>
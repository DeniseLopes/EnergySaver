<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioModel
 *
 * @author Diego Magno
 */
class UsuarioModel {

    //put your code here
    private $id;
    private $nome;
    private $sobrenome;
    private $email;
    private $senha;
    private $data_cadastro;
    private $data_nasc;
    private $cpf;
    private $img_perfil;


    public function getImg_perfil(){
        return $this->img_perfil;
    }
    public function setImg_perfil($valor){
        $this->img_perfil = $valor;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getSobrenome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getData_cadastro() {
        return $this->data_cadastro;
    }

    public function getData_nasc() {
        return $this->data_nasc;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setSobrenome($nome) {
        $this->sobrenome = $nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setData_cadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
    }

    public function setData_nasc($data_nasc) {
        $this->data_nasc = $data_nasc;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

}

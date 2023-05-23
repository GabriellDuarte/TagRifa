<?php

class Tag {
  public int     $id;
  public string  $nome;
  public string  $creation_time;
  public string  $modification_time;

  public function __construct($c=0, $id=0, $nome="", $creation_time="", $modification_time="") {
    if($c){
      $this->id = $id;
      $this->nome = $nome;
      $this->creation_time = $creation_time;
      $this->modification_time = $modification_time;
    }
  }



  // Getters e Setters
  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getNome() {
    return $this->nome;
  }

  public function setNome($nome) {
    $this->nome = $nome;
  }

  public function getCreationTime() {
    return $this->creation_time;
  }

  public function setCreationTime($creation_time) {
    $this->creation_time = $creation_time;
  }

  public function getModificationTime() {
    return $this->modification_time;
  }

  public function setModificationTime($modification_time) {
    $this->modification_time = $modification_time;
  }

}
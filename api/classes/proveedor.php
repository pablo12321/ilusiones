<?php
/*
* Modulo: Proveedor
* Version: 0.1
* Dependencias:
* --Database.
*
* Manejador de clientes.
*/
class Proveedor extends Database {
	private $id, $nombre, $telefeno,$email,$web,$extra;
	private $table;
	private $datos = array();
	public function __construct() {
		$this->table = "proveedores";
		if(parent::Create($this->table,
		"id INT UNSIGNED AUTO_INCREMENT,nombre VARCHAR(128),telefono VARCHAR(20),email VARCHAR(128),web VARCHAR(128),extra TEXT,PRIMARY KEY(id)")){
			return true;
		}
		else{
			return false;
		}
	}
	public function getTable(){
		return $this->table;
	}
	public function getAll(){
		return parent::SelectAll("*",$this->table);
	}
	public function getArray(){
		return array(
			'id' => $this->id,
			'nombre' => $this->nombre,
			'telefono' => $this->telefono,
			'email' => $this->email,
			'web' => $this->web,
			'extra' => $this->extra
		);
	}
	public function setId($id){
		$this->id = $id;
		$this->datos = parent::Select("*",$this->table,"id",$id);
		if($this->datos != false){
			$this->nombre = $this->datos[1];
			$this->telefono = $this->datos[2];
			$this->email = $this->datos[3];
			$this->web = $this->datos[4];
			$this->extra = $this->datos[5];
			return true;
		}
		else{
			return false;
		}
	}
	public function getId(){
		if($this->id != null){
			return $this->id;
		}
		else{
			return false;
		}
	}
	public function getNombre(){
		if($this->nombre != null){
			return $this->nombre;
		}
		else{
			return false;
		}
	}
	public function setNombre($value){
		$this->nombre = $value;
	}
	public function getTelefono(){
		if($this->telefono != null){
			return $this->telefono;
		}
		else{
			return false;
		}
	}
	public function setTelefono($value){
		$this->telefono = $value;
	}
	public function getEmail(){
		if($this->email != null){
			return $this->email;
		}
		else{
			return false;
		}
	}
	public function setEmail($value){
		$this->email = $value;
	}
	public function getWeb(){
		if($this->web != null){
			return $this->web;
		}
		else{
			return false;
		}
	}
	public function setWeb($value){
		$this->web = $value;
	}
	public function getExtra(){
		if($this->extra != null){
			return $this->extra;
		}
		else{
			return false;
		}
	}
	public function setExtra($value){
		$this->extra = $value;
	}
	public function Save(){
		return parent::Insert($this->table,array("nombre" => $this->nombre,"telefono" => $this->telefono,"email" => $this->email,"web" => $this->web,"extra" => $this->extra));
	}
	public function Actualizar(){
		if($this->id != null){
			return parent::Update($this->table,array("nombre" =>$this->nombre,"telefono" =>$this->telefono,"email" => $this->email,"web" => $this->web,"extra" =>$this->extra),"id",$this->id);
		}
		else{
			return false;
		}
	}
	public function Eliminar(){
		if($this->id != null){
			return parent::Delete($this->table,"id",$this->id);
		}
		else {
			return flase;
		}
	}
}
?>

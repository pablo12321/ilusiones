<?php
/*
* Modulo: Cliente
* Version: 0.2
* Dependencias:
* --Database.
*
* Manejador de clientes.
*/
class Cliente extends Database {
	private $id, $nombre, $telefeno,$extra,$activo;
	private $table;
	private $datos = array();
	public function __construct() {
		$this->table = "clientes";
		if(parent::Create($this->table,
		"id INT UNSIGNED AUTO_INCREMENT,nombre VARCHAR(128),telefono VARCHAR(20),extra TEXT,activo INT(1),PRIMARY KEY(id)")){
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
			'extra' => $this->extra,
			'activo' => $this->activo
		);
	}
	public function setId($id){
		$this->id = $id;
		$this->datos = parent::Select("*",$this->table,"id",$id);
		if($this->datos != false){
			$this->nombre = $this->datos[1];
			$this->telefono = $this->datos[2];
			$this->extra = $this->datos[3];
			$this->extra = $this->datos[4];
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
	public function getActivo(){
		if($this->extra != null){
			return $this->extra;
		}
		else{
			return false;
		}
	}
	public function setActivo($value){
		$this->extra = $value;
	}
	public function Save(){
		return parent::Insert($this->table,array("nombre" => $this->nombre,"telefono" => $this->telefono,"extra" => $this->extra,"activo" => $this->activo));
	}
	public function Actualizar(){
		if($this->id != null){
			return parent::Update($this->table,array("nombre" =>$this->nombre,"telefono" =>$this->telefono,"extra" =>$this->extra,"activo" => $this->activo),"id",$this->id);
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

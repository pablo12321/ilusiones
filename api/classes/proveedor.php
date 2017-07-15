<?php
/*
* Modulo: Proveedor
* Version: 0.1
* Dependencias:
* --Database.
*
* Manejador de proveedores.
*/
class Proveedor extends Database {
	private $id, $nombre, $telefeno,$email,$web,$extra,$deuda,$estado;
	private $table;
	private $datos = array();
	private $array = array();
	public function __construct() {
		$this->deuda = 0;
		$this->estado = 'n';
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
	public function getQuery($campo,$valor){
		$comp = "=";
		if(substr($valor,0,1) == "$"){
			$comp = "like";
			$valor = "%".substr($valor,1)."%";
		}
		return $this->setDatos(parent::SelectAll("*",$this->table,$campo,$valor,$comp));
	}
	public function setDatos($client,$simple = true){
		require_once 'classes/movimiento.php';
		$obj = new Movimiento();
		if($simple){
			return $obj->getDeuda($client,"0");
		}
		else{
			$nuevo = array();
			if (is_array($client) || is_object($client))
			{
				foreach ($client as $value) {
					$nuevo[$value['id']] = $obj->getDeuda($value,"0");
				}
			}
			return $nuevo;
		}
	}
	public function getAll(){
		return $this->setDatos(parent::SelectAll("*",$this->table),false);
	}
	public function getArray(){
		$this->array = $this->setDatos(array(
			'id' => $this->id,
			'nombre' => $this->nombre,
			'telefono' => $this->telefono,
			'email' => $this->email,
			'web' => $this->web,
			'extra' => $this->extra));
		return $this->array;
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
		return parent::Insert($this->table,array(
			"nombre" => $this->nombre,
			"telefono" => $this->telefono,
			"email" => $this->email,
			"web" => $this->web,
			"extra" => $this->extra
		));
	}
	public function Actualizar(){
		if($this->id != null){
			return parent::Update($this->table,array(
				"nombre" =>$this->nombre,
				"telefono" =>$this->telefono,
				"email" => $this->email,
				"web" => $this->web,
				"extra" =>$this->extra
			),"id",$this->id);
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

<?php
/*
* Modulo: Movimiento
* Version: 0.1
* Dependencias:
* --Database.
*
* Manejador de movimientos.
*/
class Movimiento extends Database {
	private $id, $tipo, $uid,$total,$entregado,$detalle,$creado;
	private $table;
	private $datos = array();
	public function __construct() {
		$this->table = "movimientos";
		if(parent::Create($this->table,
		"id INT UNSIGNED AUTO_INCREMENT,tipo INT(1),uid INT(5),total FLOAT(12,2),entregado FLOAT(12,2), detalle TEXT, creado DATETIME,PRIMARY KEY(id)")){
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
			'tipo' => $this->tipo,
			'uid' => $this->uid,
			'total' => $this->total,
			'entregado' => $this->entregado,
			'detalle' => $this->detalle,
			'creado' => $this->creado
		);
	}
	public function setId($id){
		$this->id = $id;
		$this->datos = parent::Select("*",$this->table,"id",$id);
		if($this->datos != false){
			$this->tipo = $this->datos[1];
			$this->uid = $this->datos[2];
			$this->total = $this->datos[3];
			$this->entregado = $this->datos[4];
			$this->detalle = $this->datos[5];
			$this->creado = $this->datos[6];
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
	public function getTipo(){
		if($this->tipo != null){
			return $this->tipo;
		}
		else{
			return false;
		}
	}
	public function setTipo($value){
		$this->tipo = $value;
	}
	public function getUid(){
		if($this->uid != null){
			return $this->uid;
		}
		else{
			return false;
		}
	}
	public function setUid($value){
		$this->uid = $value;
	}
	public function getTotal(){
		if($this->total != null){
			return $this->total;
		}
		else{
			return false;
		}
	}
	public function setTotal($value){
		$this->total = $value;
	}
	public function getEntregado(){
		if($this->entregado != null){
			return $this->entregado;
		}
		else{
			return false;
		}
	}
	public function setEntregado($value){
		$this->entregado = $value;
	}
	public function getDetalle(){
		if($this->detalle != null){
			return $this->detalle;
		}
		else{
			return false;
		}
	}
	public function setDetalle($value){
		$this->detalle = $value;
	}
	public function getCreado(){
		if($this->creado != null){
			return $this->creado;
		}
		else{
			return false;
		}
	}
	public function setCreado($value){
		$this->creado = $value;
	}
	public function Save(){
		return parent::Insert($this->table,array(
			'tipo' => $this->tipo,
			'uid' => $this->uid,
			'total' => $this->total,
			'entregado' => $this->entregado,
			'detalle' => $this->detalle,
			'creado' => $this->creado
		));
	}
	public function Actualizar(){
		if($this->id != null){
			return parent::Update($this->table,array(
				'tipo' => $this->tipo,
				'uid' => $this->uid,
				'total' => $this->total,
				'entregado' => $this->entregado,
				'detalle' => $this->detalle,
				'creado' => $this->creado
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

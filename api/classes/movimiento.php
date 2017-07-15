<?php
/*
* Modulo: Movimiento
* Version: 0.4
* Dependencias:
* --Database.
* --Cliente.
* --Proveedor.
* Manejador de movimientos.
*/
class Movimiento extends Database {
	private $id, $tipo, $uid,$total,$entregado,$detalle,$creado,$estado,$cliente;//estado y cliente no está en db
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
	public function getDeuda($cliente,$tipo){
		$cliente['deuda'] = 0;
		$movs = $this->getQuery("uid",$cliente['id']);
		if (is_array($movs) || is_object($movs))
		{
			foreach ($movs as $mov) {
				if($mov['tipo'] == $tipo){
					$cliente['deuda'] += (float) $mov['total'] - (float) $mov['entregado'];
				}
			}
		}
		$cliente['deuda'] = $cliente['deuda'].'';
		if($cliente['deuda']>0){
			$cliente['estado'] = 'd';
		}
		elseif ($cliente['deuda']<0) {
			$cliente['estado'] = 'f';
		}
		else{
			$cliente['estado'] = 'n';
		}
		return $cliente;
	}
	public function getQuery($campo,$valor){
		$comp = "=";
		if(substr($valor,0,1) == "$"){
			$comp = "like";
	    $valor = "%".substr($valor,1)."%";
	  }
		return $this->setDatos(parent::SelectAll("*",$this->table,$campo,$valor,$comp));
	}
	public function setDatos($array = null){
		if($array == null){
			if($this->total<$this->entregado){
				$this->estado = 'f';
			}
			elseif ($this->total>$this->entregado) {
				$this->estado = 'd';
			}
			else{
				$this->estado = 'n';
			}
		}
		else{
			$datos = array();
			foreach ($array as $value) {
				if($value['total']<$value['entregado']){
					$value['estado'] = 'f';
				}
				elseif ($value['total']>$value['entregado']) {
					$value['estado'] = 'd';
				}
				else{
					$value['estado'] = 'n';
				}
				if($value['tipo'] == "1"){
					require_once 'classes/cliente.php';
					$obj = new Cliente();
					$obj->setId($value['uid']);
					$value['cliente'] = $obj->getNombre();
					if(!$value['cliente'])
						$value['cliente'] ="Cliente borrado";
				}
				else{
					require_once 'classes/proveedor.php';
					$obj = new Proveedor();
					$obj->setId($value['uid']);
					$value['cliente'] = $obj->getNombre();
					if(!$value['cliente'])
						$value['cliente'] ="Proveedor borrado";
				}

				$datos[(int)$value['id']] = $value;
			}
			return $datos;
		}
	}
	public function getAll(){
		return $this->setDatos(parent::SelectAll("*",$this->table));
	}
	public function getArray(){
		return array(
			'id' => $this->id,
			'tipo' => $this->tipo,
			'uid' => $this->uid,
			'total' => $this->total,
			'entregado' => $this->entregado,
			'detalle' => $this->detalle,
			'creado' => $this->creado,
			'estado' => $this->estado
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
			$this->setDatos();
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
		$this->setDatos();
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
		$this->setDatos();
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

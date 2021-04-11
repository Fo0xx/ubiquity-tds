<?php
namespace models;
/**
 * @table("name"=>"orderdetail")
 */
class Orderdetail{
	/**
	 * @id()
	 * @column("name"=>"idOrder","dbType"=>"int(11)")
	 * @validator("type"=>"id","constraints"=>["autoinc"=>true])
	 */
	private $idOrder;

	/**
	 * @id()
	 * @column("name"=>"idProduct","dbType"=>"int(11)")
	 * @validator("type"=>"id","constraints"=>["autoinc"=>true])
	 */
	private $idProduct;

	/**
	 * @column("name"=>"quantity","dbType"=>"decimal(6,2)")
	 * @validator("type"=>"notNull")
	 */
	private $quantity;

	/**
	 * @column("name"=>"prepared","dbType"=>"tinyint(1)")
	 * @validator("type"=>"isBool","constraints"=>["notNull"=>true])
	 */
	private $prepared;

	/**
	 * @manyToOne()
	 * @joinColumn("className"=>"models\\Order","name"=>"idOrder")
	 */
	private $order;

	/**
	 * @manyToOne()
	 * @joinColumn("className"=>"models\\Product","name"=>"idProduct")
	 */
	private $product;

	public function getIdOrder(){
		return $this->idOrder;
	}

	public function setIdOrder($idOrder){
		$this->idOrder=$idOrder;
	}

	public function getIdProduct(){
		return $this->idProduct;
	}

	public function setIdProduct($idProduct){
		$this->idProduct=$idProduct;
	}

	public function getQuantity(){
		return $this->quantity;
	}

	public function setQuantity($quantity){
		$this->quantity=$quantity;
	}

	public function getPrepared(){
		return $this->prepared;
	}

	public function setPrepared($prepared){
		$this->prepared=$prepared;
	}

	public function getOrder(){
		return $this->order;
	}

	public function setOrder($order){
		$this->order=$order;
	}

	public function getProduct(){
		return $this->product;
	}

	public function setProduct($product){
		$this->product=$product;
	}

	 public function __toString(){
		return ($this->prepared??'no value').'';
	}

}
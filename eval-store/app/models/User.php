<?php
namespace models;
/**
 * @table("name"=>"user")
 */
class User{
	/**
	 * @id()
	 * @column("name"=>"id","dbType"=>"int(11)")
	 * @validator("type"=>"id","constraints"=>["autoinc"=>true])
	 */
	private $id;

	/**
	 * @column("name"=>"name","dbType"=>"varchar(60)")
	 * @validator("type"=>"length","constraints"=>["max"=>60,"notNull"=>true])
	 */
	private $name;

	/**
	 * @column("name"=>"email","dbType"=>"varchar(100)")
	 * @validator("type"=>"email","constraints"=>["notNull"=>true])
	 * @validator("type"=>"length","constraints"=>["max"=>100])
	 */
	private $email;

	/**
	 * @column("name"=>"password","dbType"=>"varchar(100)")
	 * @validator("type"=>"length","constraints"=>["max"=>100,"notNull"=>true])
	 * @transformer("name"=>"password")
	 */
	private $password;

	/**
	 * @oneToMany("mappedBy"=>"user","className"=>"models\\Basket")
	 */
	private $baskets;

	/**
	 * @oneToMany("mappedBy"=>"user","className"=>"models\\Order")
	 */
	private $orders;

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name=$name;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email=$email;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password=$password;
	}

	public function getBaskets(){
		return $this->baskets;
	}

	public function setBaskets($baskets){
		$this->baskets=$baskets;
	}

	 public function addBasket($basket){
		$this->baskets[]=$basket;
	}

	public function getOrders(){
		return $this->orders;
	}

	public function setOrders($orders){
		$this->orders=$orders;
	}

	 public function addOrder($order){
		$this->orders[]=$order;
	}

	 public function __toString(){
		return ($this->email??'no value').'';
	}

}
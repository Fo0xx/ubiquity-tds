<?php
namespace models;
/**
 * @table("name"=>"order")
 */
class Order{
	/**
	 * @id()
	 * @column("name"=>"id","dbType"=>"int(11)")
	 * @validator("type"=>"id","constraints"=>["autoinc"=>true])
	 */
	private $id;

	/**
	 * @column("name"=>"dateCreation","dbType"=>"timestamp")
	 * @validator("type"=>"notNull")
	 */
	private $dateCreation;

	/**
	 * @column("name"=>"status","dbType"=>"enum('created','prepared','delivered','')")
	 * @validator("type"=>"notNull")
	 */
	private $status;

	/**
	 * @column("name"=>"amount","dbType"=>"decimal(6,2)")
	 * @validator("type"=>"notNull")
	 */
	private $amount;

	/**
	 * @column("name"=>"toPay","dbType"=>"decimal(6,2)")
	 * @validator("type"=>"notNull")
	 */
	private $toPay;

	/**
	 * @column("name"=>"itemsNumber","dbType"=>"int(11)")
	 * @validator("type"=>"notNull")
	 */
	private $itemsNumber;

	/**
	 * @column("name"=>"missingNumber","dbType"=>"int(11)")
	 * @validator("type"=>"notNull")
	 */
	private $missingNumber;

	/**
	 * @manyToOne()
	 * @joinColumn("className"=>"models\\Employee","name"=>"idEmployee","nullable"=>true)
	 */
	private $employee;

	/**
	 * @oneToMany("mappedBy"=>"order","className"=>"models\\Orderdetail")
	 */
	private $orderdetails;

	/**
	 * @manyToOne()
	 * @joinColumn("className"=>"models\\Timeslot","name"=>"idTimeslot","nullable"=>true)
	 */
	private $timeslot;

	/**
	 * @manyToOne()
	 * @joinColumn("className"=>"models\\User","name"=>"idUser")
	 */
	private $user;

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function getDateCreation(){
		return $this->dateCreation;
	}

	public function setDateCreation($dateCreation){
		$this->dateCreation=$dateCreation;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status=$status;
	}

	public function getAmount(){
		return $this->amount;
	}

	public function setAmount($amount){
		$this->amount=$amount;
	}

	public function getToPay(){
		return $this->toPay;
	}

	public function setToPay($toPay){
		$this->toPay=$toPay;
	}

	public function getItemsNumber(){
		return $this->itemsNumber;
	}

	public function setItemsNumber($itemsNumber){
		$this->itemsNumber=$itemsNumber;
	}

	public function getMissingNumber(){
		return $this->missingNumber;
	}

	public function setMissingNumber($missingNumber){
		$this->missingNumber=$missingNumber;
	}

	public function getEmployee(){
		return $this->employee;
	}

	public function setEmployee($employee){
		$this->employee=$employee;
	}

	public function getOrderdetails(){
		return $this->orderdetails;
	}

	public function setOrderdetails($orderdetails){
		$this->orderdetails=$orderdetails;
	}

	 public function addOrderdetail($orderdetail){
		$this->orderdetails[]=$orderdetail;
	}

	public function getTimeslot(){
		return $this->timeslot;
	}

	public function setTimeslot($timeslot){
		$this->timeslot=$timeslot;
	}

	public function getUser(){
		return $this->user;
	}

	public function setUser($user){
		$this->user=$user;
	}

	 public function __toString(){
		return ($this->missingNumber??'no value').'';
	}

}
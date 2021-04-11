<?php
namespace models;
/**
 * @table("name"=>"product")
 */
class Product{
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
	 * @column("name"=>"comments","nullable"=>true,"dbType"=>"text")
	 */
	private $comments;

	/**
	 * @column("name"=>"image","nullable"=>true,"dbType"=>"text")
	 */
	private $image;

	/**
	 * @column("name"=>"price","dbType"=>"decimal(6,2)")
	 * @validator("type"=>"notNull")
	 */
	private $price;

	/**
	 * @column("name"=>"promotion","dbType"=>"decimal(6,2)")
	 * @validator("type"=>"notNull")
	 */
	private $promotion;

	/**
	 * @oneToMany("mappedBy"=>"product","className"=>"models\\Basketdetail")
	 */
	private $basketdetails;

	/**
	 * @oneToMany("mappedBy"=>"product","className"=>"models\\Orderdetail")
	 */
	private $orderdetails;

	/**
	 * @manyToOne()
	 * @joinColumn("className"=>"models\\Section","name"=>"idSection")
	 */
	private $section;

	/**
	 * @manyToMany("targetEntity"=>"models\\Product","inversedBy"=>"associatedproducts")
	 * @joinTable("name"=>"associatedproduct","inverseJoinColumns"=>["name"=>"idAssoProduct","referencedColumnName"=>"id"])
	 */
	private $associatedproducts;

	/**
	 * @manyToMany("targetEntity"=>"models\\Product","inversedBy"=>"packs")
	 * @joinTable("name"=>"pack","joinColumns"=>["name"=>"idPack","referencedColumnName"=>"id"])
	 */
	private $packs;

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

	public function getComments(){
		return $this->comments;
	}

	public function setComments($comments){
		$this->comments=$comments;
	}

	public function getImage(){
		return $this->image;
	}

	public function setImage($image){
		$this->image=$image;
	}

	public function getPrice(){
		return $this->price;
	}

	public function setPrice($price){
		$this->price=$price;
	}

	public function getPromotion(){
		return $this->promotion;
	}

	public function setPromotion($promotion){
		$this->promotion=$promotion;
	}

	public function getBasketdetails(){
		return $this->basketdetails;
	}

	public function setBasketdetails($basketdetails){
		$this->basketdetails=$basketdetails;
	}

	 public function addBasketdetail($basketdetail){
		$this->basketdetails[]=$basketdetail;
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

	public function getSection(){
		return $this->section;
	}

	public function setSection($section){
		$this->section=$section;
	}

	public function getAssociatedproducts(){
		return $this->associatedproducts;
	}

	public function setAssociatedproducts($associatedproducts){
		$this->associatedproducts=$associatedproducts;
	}

	 public function addAssociatedproduct($associatedproduct){
		$this->associatedproducts[]=$associatedproduct;
	}

	public function getPacks(){
		return $this->packs;
	}

	public function setPacks($packs){
		$this->packs=$packs;
	}

	 public function addPack($pack){
		$this->packs[]=$pack;
	}

	 public function __toString(){
		return ($this->promotion??'no value').'';
	}

}
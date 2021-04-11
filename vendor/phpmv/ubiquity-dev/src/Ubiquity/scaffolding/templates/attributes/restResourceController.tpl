<?php
%namespace%

use Ubiquity\attributes\items\router\Delete;
use Ubiquity\attributes\items\router\Get;
use Ubiquity\attributes\items\router\Options;
use Ubiquity\attributes\items\router\Post;
use Ubiquity\attributes\items\router\Put;
%uses%

%restAnnot%
%route%
class %controllerName% extends %baseClass% {

	/**
	 * Returns all links for this controller.
	 *
	 * @route("/links","methods"=>["get"],"priority"=>3000)
	*/
	#[Route('/links', priority: 3000)]
	public function index() {
		parent::index ();
	}

	/**
	* Returns a list of objects from the server
	*
	* @param string $condition the sql Where part
	* @param boolean|string $included if true, loads associate members with associations, if string, example : client.*,commands
	* @param boolean $useCache
	* @route("methods"=>["get"])
	*/
	#[Get('{condition}/{included}/{useCache}', priority: -1)]
	public function all($condition = "1=1", $included = false, $useCache = false) {
		$this->_get ( $condition, $included, $useCache );
	}

	/**
	* Get the first object corresponding to the $keyValues
	*
	* @param string $keyValues primary key(s) value(s) or condition
	* @param boolean|string $included if true, loads associate members with associations, if string, example : client.*,commands
	* @param boolean $useCache if true then response is cached
	* @route("methods"=>["get"])
	*/
	#[Get('{keyValues}/{included}/{useCache}', priority: -1)]
	public function one($keyValues, $included = false, $useCache = false) {
		$this->_getOne ( $keyValues, $included, $useCache );
	}

	/**
	* Update an instance of $model selected by the primary key $keyValues
	* Require members values in $_POST array
	* Requires an authorization with access token
	*
	* @param array $keyValues
	* @authorization
	* @route("methods"=>["put"])
	*/
	#[Put('{keyValues}')]
	public function update(...$keyValues) {
		$this->_update ( ...$keyValues );
	}

	/**
	* Insert a new instance of $model
	* Require members values in $_POST array
	* Requires an authorization with access token
	*
	* @authorization
	* @route("methods"=>["post"])
	*/
	#[Post('/')]
	public function add() {
		$this->_add ();
	}

	/**
	* Delete the instance of $model selected by the primary key $keyValues
	* Requires an authorization with access token
	*
	* @param array $keyValues
	* @route("methods"=>["delete"],"priority"=>30)
	* @authorization
	*/
	#[Delete('{keyValues}')]
	public function delete(...$keyValues) {
		$this->_delete ( ...$keyValues );
	}

	/**
	* Route for CORS
	*
	* @route("{resource}","methods"=>["options"],"priority"=>3000)
	*/
	#[Options('{resource}',priority: 3000)]
	public function options(...$resource) {}
}

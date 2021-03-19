<?php
namespace controllers;

use models\Basket;
use models\Order;
use models\Product;
use Ubiquity\attributes\items\di\Autowired;
use services\dao\StoreRepository;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\controllers\auth\AuthController;
use Ubiquity\controllers\auth\WithAuthTrait;
use Ubiquity\orm\DAO;
use Ubiquity\utils\http\USession;

/**
 * Controller MainController
 **/
class MainController extends ControllerBase{

    use WithAuthTrait;

    #[Autowired]
    private StoreRepository $repo;

    /**
     * @route("path"=>"home","name"=>"home","inherited"=>false,"automated"=>false,"requirements"=>[],"priority"=>0)
     */
    #[Route(path: "home", name: "home")]
    public function index() {
        $numOrders = count(DAO::getAll(Order::class, 'idUser=?', false, [USession::get("idUser")]));
        $numBaskets = count(DAO::getAll(Basket::class, 'idUser=?', false, [USession::get("idUser")]));
        $produitsPromo = DAO::getAll(Product::class, 'promotion<?', false, [0]);
        $this->loadDefaultView(['numOrders'=>$numOrders, 'numBaskets'=>$numBaskets, 'produitsPromo'=>$produitsPromo]);
    }

    public function getRepo(): StoreRepository {
        return $this->repo;
    }

    public function setRepo(storeRepository $repo): void {
        $this->repo = $repo;
    }


	/**
    * @route("path"=>"store/order","name"=>"order","inherited"=>false,"automated"=>false,"requirements"=>[],"priority"=>0)
    */
    #[Route(path:"store/order", name:"order")]
    public function order() {
        $this->loadView('MainController/order.html');
    }

    /**
     * @route("path"=>"store/browse","name"=>"browse","inherited"=>false,"automated"=>false,"requirements"=>[],"priority"=>0)
     */
    #[Route(path:"store/browse", name:"browse")]
    public function browse() {
        $this->loadView('MainController/store.html');
    }

    /**
     * @route("path"=>"basket/new","name"=>"basket.new","inherited"=>false,"automated"=>false,"requirements"=>[],"priority"=>0)
     */
    #[Route(path:"basket/new", name:"basket.new")]
    public function newBasket() {
        $this->loadView('MainController/newBasket.html');
    }

    /**
     * @route("path"=>"basket","name"=>"basket","inherited"=>false,"automated"=>false,"requirements"=>[],"priority"=>0)
     */
    #[Route(path:"basket", name:"basket")]
    public function basket() {
        $this->loadView('MainController/basket.html');
    }

    protected function getAuthController(): AuthController {
        return new MyAuth($this);
    }

}

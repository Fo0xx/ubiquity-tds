<?php
namespace controllers;

use models\Basket;
use models\Basketdetail;
use models\Order;
use models\Product;
use models\Section;
use services\ui\StoreUI;
use Ubiquity\attributes\items\di\Autowired;
use services\dao\StoreRepository;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\controllers\auth\AuthController;
use Ubiquity\controllers\auth\WithAuthTrait;
use Ubiquity\orm\DAO;
use Ubiquity\utils\http\UResponse;
use Ubiquity\utils\http\USession;

/**
 * Controller MainController
 **/
class MainController extends ControllerBase{

    use WithAuthTrait;

    public function initialize() {
        parent::initialize();
        $this -> ui = new StoreUI($this);
    }

    #[Autowired]
    private StoreRepository $repo;

    /**
     * @route("path"=>"home","name"=>"home","inherited"=>false,"automated"=>false,"requirements"=>[],"priority"=>0)
     */
    #[Route(path: "home", name: "home")]
    public function index() {
        $recentlyViewedProducts = USession::get('recentlyViewedProducts');
        $numOrders = count(DAO::getAll(Order::class, 'idUser=?', false, [USession::get("idUser")]));
        $numBaskets = count(DAO::getAll(Basket::class, 'idUser=?', false, [USession::get("idUser")]));
        $produitsPromo = DAO::getAll(Product::class, 'promotion<?', false, [0]);
        $this->loadDefaultView(['numOrders'=>$numOrders, 'numBaskets'=>$numBaskets, 'produitsPromo'=>$produitsPromo, 'recentlyViewedProducts'=>$recentlyViewedProducts]);
    }

    public function getRepo(): StoreRepository {
        return $this->repo;
    }

    public function setRepo(StoreRepository $repo): void {
        $this->repo = $repo;
    }


	/**
    * @route("path"=>"store/order","name"=>"order","inherited"=>false,"automated"=>false,"requirements"=>[],"priority"=>0)
    */
    #[Route(path:"store/order", name:"order")]
    public function order() {
        //$this->loadView('MainController/order.html');
        $order = DAO::getAll(Order::class, 'idUser=?', false, [USession::get("idUser")]);
        $this->loadDefaultView(['order'=>$order]);
    }

    /**
     * @route("path"=>"store/browse","name"=>"browse","inherited"=>false,"automated"=>false,"requirements"=>[],"priority"=>0)
     */
    #[Route(path:"store/browse", name:"store")]
    public function store() {
        //$this->loadView('MainController/store.html');
        $recentlyViewedProducts = USession::get("recentlyViewedProducts");
        $section = DAO::getAll(Section::class, false, ['products']);
        $produitsPromo = DAO::getAll(Product::class, 'promotion<?', false, [0]);
        $this->loadDefaultView(['section'=>$section, 'produitsPromo'=>$produitsPromo, 'recentlyViewedProducts'=>$recentlyViewedProducts]);
    }

    /**
     * @route("path"=>"basket/new","name"=>"basket.new","inherited"=>false,"automated"=>false,"requirements"=>[],"priority"=>0)
     */
    #[Route(path:"basket/new", name:"basket.new")]
    public function newBasket() {
        //$this->loadView('MainController/newBasket.html');
        $newBasket = DAO::getAll(Order::class, 'idUser=?', false, [USession::get("idUser")]);
        $this->loadDefaultView(['newBasket'=>$newBasket]);
    }

    /**
     * @route("path"=>"basket","name"=>"basket","inherited"=>false,"automated"=>false,"requirements"=>[],"priority"=>0)
     */
    #[Route(path:"basket", name:"basket")]
    public function basket() {
        //$this->loadView('MainController/basket.html');
        $basket = DAO::getAll(Basket::class, 'idUser=?', false, [USession::get("idUser")]);
        $this->loadDefaultView(['baskets'=>$basket]);
    }

    /**
     * @route("path"=>"store/section/{id}","name"=>"section")
     */
    #[Route(path:"store/section/{id}", name:"section")]
    public function section($id) {
        $sections = DAO::getAll(Section::class, false, ['products']);
        $section = DAO::getById(Section::class, $id, ['products']);
        $this->loadDefaultView(['section'=>$section, 'sections'=>$sections]);
    }

    /**
     * @route("path"=>"store/product/{idSection}/{idProduct}","name"=>"product")
     */
    #[Route(path:"store/product/{idSection}/{idProduct}", name:"product")]
    public function product($idSection, $idProduct){
        $sections = DAO::getAll(Section::class, false, ['products']);
        $section = DAO::getById(Product::class, $idSection);
        $product = DAO::getById(Product::class, $idProduct);

        $products = USession::get("recentlyViewedProducts");
        array_push($products, $product);
        USession::set("recentlyViewedProducts", $products);

        $this->loadDefaultView(['sections'=>$sections, 'product'=>$product, 'section'=>$section]);
    }

    /**
     * @route("path"=>"basket/add/{idProduct}","name"=>"addProduct")
     */
    #[Route(path:"basket/add/{idProduct}", name:"addProduct")]
    public function addProduct($idProduct){
        $basket = DAO::getOne(Basket::class, 'idUser=?', false, [USession::get("idUser")]);

        $details = new Basketdetail();
        $details->setBasket($basket);

        $details->setIdProduct($idProduct); $details->setQuantity(1);

        DAO::save($details);
        UResponse::header('location', '/home');
    }

    /**
     * @route("path"=>"basket/add/{idBasket}/{idProduct}","name"=>"addProductTo")
     */
    #[Route(path:"basket/add/{idBasket}/{idProduct}", name:"addProductTo")]
    public function addProductTo($idBasket, $idProduct){
        $this->loadDefaultView();
    }

    protected function getAuthController(): AuthController {
        return new MyAuth($this);
    }

}

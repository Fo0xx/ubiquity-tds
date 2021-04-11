<?php
namespace controllers;

use classes\MyBasket;
use models\Basket;
use models\Basketdetail;
use models\Order;
use models\Product;
use models\Section;
use models\Timeslot;
use models\User;
use services\ui\StoreUI;
use services\dao\StoreRepository;
use Ubiquity\attributes\items\di\Autowired;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\controllers\Router;
use Ubiquity\controllers\auth\AuthController;
use Ubiquity\controllers\auth\WithAuthTrait;
use Ubiquity\orm\DAO;
use Ubiquity\utils\base\UArrayModels;
use Ubiquity\utils\http\URequest;
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
        $products = USession::get("recentlyViewedProducts");
        $numOrders = count(DAO::getAll(Order::class, 'idUser=?', false, [USession::get("identifiant")]));
        $numBaskets = count(DAO::getAll(Basket::class, 'idUser=?', false, [USession::get("identifiant")]));
        $produitsPromo = DAO::getAll(Product::class, 'promotion<?', false, [0]);
        $this->loadDefaultView(['numOrders'=>$numOrders, 'numBaskets'=>$numBaskets, 'produitsPromo'=>$produitsPromo, 'recentlyViewedProducts'=>$products]);
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
        $order = DAO::getAll(Order::class, 'idUser=?', false, [USession::get("identifiant")]);
        $this->loadDefaultView(['order'=>$order]);
    }

    /**
     * @route("path"=>"store/browse","name"=>"store","inherited"=>false,"automated"=>false,"requirements"=>[],"priority"=>0)
     */
    #[Route(path:"store/browse", name:"store")]
    public function store() {
        $products = USession::get("recentlyViewedProducts");
        $section = DAO::getAll(Section::class, false, false);
        $produitsPromo = DAO::getAll(Product::class, 'promotion<?', false, [0]);
        $this->loadDefaultView(['section'=>$section, 'produitsPromo'=>$produitsPromo, 'recentlyViewedProducts'=>$products]);
    }

    /**
     * @route("path"=>"basket/new","name"=>"basket.new","inherited"=>false,"automated"=>false,"requirements"=>[],"priority"=>0)
     */
    #[Route(path:"basket/new", name:"basket.new")]
    public function newBasket() {
        if (URequest::post("basketName") != null) {
            $id = USession::get("identifiant");
            $user = DAO::getById(User::class, $id);
            $newBasket = new Basket();
            $newBasket->setUser($user);
            $newBasket->setName(URequest::post("basketName"));

            DAO::save($newBasket);

            UResponse::header("location", "/".Router::path("basket.myBaskets"));
        } else {
            $this->loadDefaultView();
        }
    }


    /**
     * @route("path"=>"basket","name"=>"basket","inherited"=>false,"automated"=>false,"requirements"=>[],"priority"=>0)
     */
    #[Route(path:"basket", name:"basket")]
    public function basket() {
        $basket = USession::get("defaultBasket");
        $productsList = $basket->getListProducts();
        $prixTotal = $basket->getCalculTotal();
        $promoTotal = $basket->getTotalPromo();
        $quantity = $basket->getQuantity();
        $this->loadDefaultView(['productsList'=>$productsList, 'prixTotal'=> $prixTotal, 'promo'=>$promoTotal, 'quantity'=>$quantity]);
    }

    /**
     * @route("path"=>"store/section/{id}","name"=>"section")
     */
    #[Route(path:"store/section/{id}", name:"section")]
    public function section($id) {
        $sections = DAO::getAll(Section::class, false, false);
        $section = DAO::getById(Section::class, [$id]);
        $products = DAO::getAll(Product::class, 'idSection=?', false, [$id]);
        $this->loadDefaultView(['products'=>$products, 'section'=>$section, 'sections'=>$sections]);
    }

    /**
     * @route("path"=>"store/product/{idSection}/{idProduct}","name"=>"product")
     */
    #[Route(path:"store/product/{idSection}/{idProduct}", name:"product")]
    public function product($idSection, $idProduct) {
        $sections = DAO::getAll(Section::class, false, false);
        $section = DAO::getById(Product::class, $idSection);
        $product = DAO::getById(Product::class, $idProduct);
        $products = USession::get("recentlyViewedProducts");
        $products[] = $product;
        USession::set("recentlyViewedProducts", $products);
        $this->loadDefaultView(['sections'=>$sections, 'product'=>$product, 'section'=>$section]);
    }

    /**
     * @route("path"=>"basket/add/{idProduct}","name"=>"addProduct")
     */
    #[Route(path:"basket/add/{idProduct}", name:"addProduct")]
    public function addProduct($idProduct) {
        $product = DAO::getById(Product::class, $idProduct, false);
        $basket = USession::get("defaultBasket");
        $basket->addListProduct($product, 1);
        UResponse::header("location", "/home/".Router::path("store"));
    }

    /**
     * @route("path"=>"basket/add/{idBasket}/{idProduct}","name"=>"addProductTo")
     */
    #[Route(path:"basket/add/{idBasket}/{idProduct}", name:"addProductTo")]
    public function addProductTo($idBasket, $idProduct) {
        $product = DAO::getById(Product::class, $idProduct, false);
        $basket = DAO::getById(Basket::class, $idBasket, false);
        $detailsBasket = new Basketdetail();
        $detailsBasket->setProduct($product);
        $detailsBasket->setBasket($basket);
        $detailsBasket->setQuantity(1);
        UResponse::header("location", "/home/".Router::path("store"));
    }

    /**
     * @route("path"=>"basket/delete/{idBasket}","name"=>"basket.delete")
     */
    #[Route(path:"basket/delete/{idBasket}", name:"basket.delete")]
    public function basketDelete($idBasket) {
        DAO::delete(Basket::class, $idBasket);
        UResponse::header("location", "/home/".Router::path("basket.delete"));
    }

    /**
     * @route("path"=>"basket/quantity/{idProduct}","name"=>"basket.quantity")
     */
    #[Route(path: "basket/quantity/{idProduct}", name: "basket.quantity")]
    public function basketQuantity($idProduct){
        $basket = USession::get("defaultBasket");
        $quantity = URequest::post("basketQuantity");
        $basket->setQuantity(DAO::getOne(Product::class, $idProduct,false), $quantity);
        UResponse::header("location", "/".Router::path("basket"));
    }

    /**
     * @route("path"=>"basket/clear/{idProduct}","name"=>"basket.clearOne")
     */
    #[Route(path:"basket/clear/{idProduct}", name:"basket.clearOne")]
    public function clearOne($idProduct) {
        $basketDetails = USession::get("defaultBasket");
        $basketDetails->deleteProduct($idProduct);
        UResponse::header("location", "/home/".Router::path("basket"));
    }

    /**
     * @route("path"=>"basket/clear","name"=>"basket.clear")
     */
    #[Route(path:"basket/clear", name:"basket.clear")]
    public function clear() {
        $basketDetails = USession::get("defaultBasket");
        $basketDetails->deleteListProduct();
        UResponse::header("location", "/home/".Router::path("store"));
    }

    /**
     * @route("path"=>"basket/my-baskets","name"=>"basket.myBaskets")
     */
    #[Route(path: "basket/my-baskets", name: "basket.myBaskets")]
    public function myBaskets() {
        $basket = DAO::getAll(Basket::class, 'idUser=?', false, [USession::get("identifiant")]);
        $this->loadDefaultView(['baskets'=>$basket]);
    }

    /**
     * @route("path"=>"basket/validate","name"=>"basket.validate")
     */
    #[Route(path:"basket/validate", name:"basket.validate")]
    public function basketValidate() {
        $basket = USession::get("defaultBasket");
        $slots = DAO::getAll(Timeslot::class, 'full=?', false, [0]);
        $prixTotal = $basket->getCalculTotal();
        $promoTotal = $basket->getTotalPromo();
        $quantity = $basket->getQuantity();
        $this->loadDefaultView(['prixTotal'=> $prixTotal, 'promo'=>$promoTotal, 'quantity'=>$quantity, 'slots'=>$slots]);
    }

    /**
     * @route("path"=>"basket/command","name"=>"basket.command")
     */
    #[Route(path:"basket/command", name:"basket.command")]
    public function basketCommand() {
        $slot = null;
        $order = new Order();
        $order->setUser(DAO::getById(User::class, USession::get("identifiant")));
        if(URequest::post("withdrawal") != null){
            $slot = URequest::post("withdrawal");
        }
        $order->setTimeslot($slot);
        DAO::beginTransaction();
        DAO::save($order);
        $basket = USession::get("defaultBasket");
        $basket->setOrder($order);
        DAO::commit();
        $this->loadDefaultView();
    }

    protected function getAuthController(): AuthController {
        return new MyAuth($this);
    }

}

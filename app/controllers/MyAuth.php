<?php
namespace controllers;

use classes\MyBasket;
use models\User;
use models\Basket;
use controllers\auth\files\MyAuthFiles;
use Ubiquity\controllers\auth\AuthFiles;
use Ubiquity\controllers\Router;
use Ubiquity\orm\DAO;
use Ubiquity\utils\flash\FlashMessage;
use Ubiquity\utils\http\UResponse;
use Ubiquity\utils\http\USession;
use Ubiquity\utils\http\URequest;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\controllers\auth\AuthController;

 /**
 * Controller MyAuth
 **/

/**
 * @route("path"=>"/login","inherited"=>true,"automated"=>true,"requirements"=>[],"priority"=>0)
 */
#[Route(path: "/login", inherited: true, automated: true)]
class MyAuth extends AuthController {

    protected function onConnect($connected) {
        $urlParts=$this->getOriginalURL();
        USession::set($this->_getUserSessionKey(), $connected);

        if (isset($urlParts)) {
            $this->_forward(implode("/",$urlParts));
        } else {
            USession::set('recentlyViewedProducts', []);
            UResponse::header('location','/home');
        }
    }

    protected function _connect() {
        if (URequest::isPost()){
            $email=URequest::post($this->_getLoginInputName());
            $password=URequest::post($this->_getPasswordInputName());
            if ($email != null) {
                $user=DAO::getOne(User::class, 'email=?', false, [$email]);
                if (isset($user) && $user->getPassword() == $password) {
                    USession::set("identifiant", $user->getId());
                    if (DAO::getOne(Basket::class,'name = ?',false,['_default'])) {
                        $myBasket = new MyBasket(DAO::getOne(Basket::class,'name=?',false, ['_default']));
                        USession::set("defaultBasket", $myBasket);
                        return $user;
                    }else {
                        $basket = new Basket();
                        $basket->setName('_default');
                        $basket->setUser($user);
                        if (DAO::save($basket)) {
                            $myBasket = new MyBasket(DAO::getOne(Basket::class,'name=?',false, ['_default']));
                            USession::set("defaultBasket", $myBasket);
                            return $user;
                        }
                    }
                }
            }
        }
        return null;
    }

    public function _displayInfoAsString() {
        return true;
    }

    protected function finalizeAuth() {
        if(!URequest::isAjax()){
            $this->loadView('@activeTheme/main/vFooter.html');
        }
    }

    protected function initializeAuth() {
        if (!URequest::isAjax()){
            $prix = USession::get('prix');
            $quantite = USession::get('quantite');
            $this->loadView('@activeTheme/main/vHeader.html', ['price'=>$prix, 'quantity'=>$quantite]);
        }
    }

    public function _getBodySelector() {
        return '#page-container';
    }

    public function _isValidUser($action=null) {
        return USession::exists($this->_getUserSessionKey());
    }

    public function _getBaseRoute() {
        return '/login';
    }

    protected function getFiles(): AuthFiles {
        return new MyAuthFiles();
    }

    public function noAccessMessage(FlashMessage $fMessage) {
        $fMessage->setTitle("Access Denied");
        $fMessage->setContent("You aren't authorized to access this page.");
    }

    public function terminateMessage(FlashMessage $fMessage) {
        $fMessage->setTitle('Disconnected');
        $fMessage->setContent("You have been successfully disconnected !");
    }
}
<?php

return array(
  '#namespace' => 'controllers',
  '#uses' => array (
  'MyBasket' => 'classes\\MyBasket',
  'Basket' => 'models\\Basket',
  'Basketdetail' => 'models\\Basketdetail',
  'Order' => 'models\\Order',
  'Product' => 'models\\Product',
  'Section' => 'models\\Section',
  'Timeslot' => 'models\\Timeslot',
  'User' => 'models\\User',
  'StoreUI' => 'services\\ui\\StoreUI',
  'StoreRepository' => 'services\\dao\\StoreRepository',
  'Autowired' => 'Ubiquity\\attributes\\items\\di\\Autowired',
  'Route' => 'Ubiquity\\attributes\\items\\router\\Route',
  'Router' => 'Ubiquity\\controllers\\Router',
  'AuthController' => 'Ubiquity\\controllers\\auth\\AuthController',
  'WithAuthTrait' => 'Ubiquity\\controllers\\auth\\WithAuthTrait',
  'DAO' => 'Ubiquity\\orm\\DAO',
  'UArrayModels' => 'Ubiquity\\utils\\base\\UArrayModels',
  'URequest' => 'Ubiquity\\utils\\http\\URequest',
  'UResponse' => 'Ubiquity\\utils\\http\\UResponse',
  'USession' => 'Ubiquity\\utils\\http\\USession',
),
  '#traitMethodOverrides' => array (
  'controllers\\MainController' => 
  array (
  ),
),
  'controllers\\MainController::index' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\items\\router\\RouteAnnotation', "path"=>"home","name"=>"home","inherited"=>false,"automated"=>false,"requirements"=>[],"priority"=>0)
  ),
  'controllers\\MainController::order' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\items\\router\\RouteAnnotation', "path"=>"store/order","name"=>"order","inherited"=>false,"automated"=>false,"requirements"=>[],"priority"=>0)
  ),
  'controllers\\MainController::store' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\items\\router\\RouteAnnotation', "path"=>"store/browse","name"=>"store","inherited"=>false,"automated"=>false,"requirements"=>[],"priority"=>0)
  ),
  'controllers\\MainController::newBasket' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\items\\router\\RouteAnnotation', "path"=>"basket/new","name"=>"basket.new","inherited"=>false,"automated"=>false,"requirements"=>[],"priority"=>0)
  ),
  'controllers\\MainController::basket' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\items\\router\\RouteAnnotation', "path"=>"basket","name"=>"basket","inherited"=>false,"automated"=>false,"requirements"=>[],"priority"=>0)
  ),
  'controllers\\MainController::section' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\items\\router\\RouteAnnotation', "path"=>"store/section/{id}","name"=>"section")
  ),
  'controllers\\MainController::product' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\items\\router\\RouteAnnotation', "path"=>"store/product/{idSection}/{idProduct}","name"=>"product")
  ),
  'controllers\\MainController::addProduct' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\items\\router\\RouteAnnotation', "path"=>"basket/add/{idProduct}","name"=>"addProduct")
  ),
  'controllers\\MainController::addProductTo' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\items\\router\\RouteAnnotation', "path"=>"basket/add/{idBasket}/{idProduct}","name"=>"addProductTo")
  ),
  'controllers\\MainController::basketDelete' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\items\\router\\RouteAnnotation', "path"=>"basket/delete/{idBasket}","name"=>"basket.delete")
  ),
  'controllers\\MainController::basketQuantity' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\items\\router\\RouteAnnotation', "path"=>"basket/quantity/{idProduct}","name"=>"basket.quantity")
  ),
  'controllers\\MainController::clearOne' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\items\\router\\RouteAnnotation', "path"=>"basket/clear/{idProduct}","name"=>"basket.clearOne")
  ),
  'controllers\\MainController::clear' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\items\\router\\RouteAnnotation', "path"=>"basket/clear","name"=>"basket.clear")
  ),
  'controllers\\MainController::myBaskets' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\items\\router\\RouteAnnotation', "path"=>"basket/my-baskets","name"=>"basket.myBaskets")
  ),
  'controllers\\MainController::basketValidate' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\items\\router\\RouteAnnotation', "path"=>"basket/validate","name"=>"basket.validate")
  ),
  'controllers\\MainController::basketCommand' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\items\\router\\RouteAnnotation', "path"=>"basket/command","name"=>"basket.command")
  ),
);


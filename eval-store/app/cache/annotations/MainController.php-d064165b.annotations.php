<?php

return array(
  '#namespace' => 'controllers',
  '#uses' => array (
  'Basket' => 'models\\Basket',
  'Order' => 'models\\Order',
  'Product' => 'models\\Product',
  'Autowired' => 'Ubiquity\\attributes\\items\\di\\Autowired',
  'StoreRepository' => 'services\\dao\\StoreRepository',
  'Route' => 'Ubiquity\\attributes\\items\\router\\Route',
  'AuthController' => 'Ubiquity\\controllers\\auth\\AuthController',
  'WithAuthTrait' => 'Ubiquity\\controllers\\auth\\WithAuthTrait',
  'DAO' => 'Ubiquity\\orm\\DAO',
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
  'controllers\\MainController::browse' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\items\\router\\RouteAnnotation', "path"=>"store/browse","name"=>"browse","inherited"=>false,"automated"=>false,"requirements"=>[],"priority"=>0)
  ),
  'controllers\\MainController::newBasket' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\items\\router\\RouteAnnotation', "path"=>"basket/new","name"=>"basket.new","inherited"=>false,"automated"=>false,"requirements"=>[],"priority"=>0)
  ),
  'controllers\\MainController::basket' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\items\\router\\RouteAnnotation', "path"=>"basket","name"=>"basket","inherited"=>false,"automated"=>false,"requirements"=>[],"priority"=>0)
  ),
);


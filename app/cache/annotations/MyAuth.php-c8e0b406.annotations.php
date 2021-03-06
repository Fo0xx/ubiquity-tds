<?php

return array(
  '#namespace' => 'controllers',
  '#uses' => array (
  'MyBasket' => 'classes\\MyBasket',
  'User' => 'models\\User',
  'Basket' => 'models\\Basket',
  'MyAuthFiles' => 'controllers\\auth\\files\\MyAuthFiles',
  'AuthFiles' => 'Ubiquity\\controllers\\auth\\AuthFiles',
  'Router' => 'Ubiquity\\controllers\\Router',
  'DAO' => 'Ubiquity\\orm\\DAO',
  'FlashMessage' => 'Ubiquity\\utils\\flash\\FlashMessage',
  'UResponse' => 'Ubiquity\\utils\\http\\UResponse',
  'USession' => 'Ubiquity\\utils\\http\\USession',
  'URequest' => 'Ubiquity\\utils\\http\\URequest',
  'Route' => 'Ubiquity\\attributes\\items\\router\\Route',
  'AuthController' => 'Ubiquity\\controllers\\auth\\AuthController',
),
  '#traitMethodOverrides' => array (
  'controllers\\MyAuth' => 
  array (
  ),
),
  'controllers\\MyAuth' => array(
    array('#name' => 'route', '#type' => 'Ubiquity\\annotations\\items\\router\\RouteAnnotation', "path"=>"/login","inherited"=>true,"automated"=>true,"requirements"=>[],"priority"=>0)
  ),
);


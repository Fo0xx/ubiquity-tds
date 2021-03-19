<?php

return array(
  '#namespace' => 'models',
  '#uses' => array (
),
  '#traitMethodOverrides' => array (
  'models\\Orderdetail' => 
  array (
  ),
),
  'models\\Orderdetail' => array(
    array('#name' => 'table', '#type' => 'Ubiquity\\annotations\\items\\TableAnnotation', "name"=>"orderdetail")
  ),
  'models\\Orderdetail::$idOrder' => array(
    array('#name' => 'id', '#type' => 'Ubiquity\\annotations\\items\\IdAnnotation', ),
    array('#name' => 'column', '#type' => 'Ubiquity\\annotations\\items\\ColumnAnnotation', "name"=>"idOrder","dbType"=>"int(11)"),
    array('#name' => 'validator', '#type' => 'Ubiquity\\annotations\\items\\ValidatorAnnotation', "type"=>"id","constraints"=>["autoinc"=>true])
  ),
  'models\\Orderdetail::$idProduct' => array(
    array('#name' => 'id', '#type' => 'Ubiquity\\annotations\\items\\IdAnnotation', ),
    array('#name' => 'column', '#type' => 'Ubiquity\\annotations\\items\\ColumnAnnotation', "name"=>"idProduct","dbType"=>"int(11)"),
    array('#name' => 'validator', '#type' => 'Ubiquity\\annotations\\items\\ValidatorAnnotation', "type"=>"id","constraints"=>["autoinc"=>true])
  ),
  'models\\Orderdetail::$quantity' => array(
    array('#name' => 'column', '#type' => 'Ubiquity\\annotations\\items\\ColumnAnnotation', "name"=>"quantity","dbType"=>"decimal(6,2)"),
    array('#name' => 'validator', '#type' => 'Ubiquity\\annotations\\items\\ValidatorAnnotation', "type"=>"notNull")
  ),
  'models\\Orderdetail::$prepared' => array(
    array('#name' => 'column', '#type' => 'Ubiquity\\annotations\\items\\ColumnAnnotation', "name"=>"prepared","dbType"=>"tinyint(1)"),
    array('#name' => 'validator', '#type' => 'Ubiquity\\annotations\\items\\ValidatorAnnotation', "type"=>"isBool","constraints"=>["notNull"=>true])
  ),
  'models\\Orderdetail::$order' => array(
    array('#name' => 'manyToOne', '#type' => 'Ubiquity\\annotations\\items\\ManyToOneAnnotation', ),
    array('#name' => 'joinColumn', '#type' => 'Ubiquity\\annotations\\items\\JoinColumnAnnotation', "className"=>"models\\Order","name"=>"idOrder")
  ),
  'models\\Orderdetail::$product' => array(
    array('#name' => 'manyToOne', '#type' => 'Ubiquity\\annotations\\items\\ManyToOneAnnotation', ),
    array('#name' => 'joinColumn', '#type' => 'Ubiquity\\annotations\\items\\JoinColumnAnnotation', "className"=>"models\\Product","name"=>"idProduct")
  ),
);


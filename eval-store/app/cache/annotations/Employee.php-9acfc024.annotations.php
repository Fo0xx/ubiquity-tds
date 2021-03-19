<?php

return array(
  '#namespace' => 'models',
  '#uses' => array (
),
  '#traitMethodOverrides' => array (
  'models\\Employee' => 
  array (
  ),
),
  'models\\Employee' => array(
    array('#name' => 'table', '#type' => 'Ubiquity\\annotations\\items\\TableAnnotation', "name"=>"employee")
  ),
  'models\\Employee::$id' => array(
    array('#name' => 'id', '#type' => 'Ubiquity\\annotations\\items\\IdAnnotation', ),
    array('#name' => 'column', '#type' => 'Ubiquity\\annotations\\items\\ColumnAnnotation', "name"=>"id","dbType"=>"int(11)"),
    array('#name' => 'validator', '#type' => 'Ubiquity\\annotations\\items\\ValidatorAnnotation', "type"=>"id","constraints"=>["autoinc"=>true])
  ),
  'models\\Employee::$name' => array(
    array('#name' => 'column', '#type' => 'Ubiquity\\annotations\\items\\ColumnAnnotation', "name"=>"name","dbType"=>"varchar(60)"),
    array('#name' => 'validator', '#type' => 'Ubiquity\\annotations\\items\\ValidatorAnnotation', "type"=>"length","constraints"=>["max"=>60,"notNull"=>true])
  ),
  'models\\Employee::$email' => array(
    array('#name' => 'column', '#type' => 'Ubiquity\\annotations\\items\\ColumnAnnotation', "name"=>"email","dbType"=>"varchar(100)"),
    array('#name' => 'validator', '#type' => 'Ubiquity\\annotations\\items\\ValidatorAnnotation', "type"=>"email","constraints"=>["notNull"=>true]),
    array('#name' => 'validator', '#type' => 'Ubiquity\\annotations\\items\\ValidatorAnnotation', "type"=>"length","constraints"=>["max"=>100])
  ),
  'models\\Employee::$password' => array(
    array('#name' => 'column', '#type' => 'Ubiquity\\annotations\\items\\ColumnAnnotation', "name"=>"password","dbType"=>"varchar(100)"),
    array('#name' => 'validator', '#type' => 'Ubiquity\\annotations\\items\\ValidatorAnnotation', "type"=>"length","constraints"=>["max"=>100,"notNull"=>true]),
    array('#name' => 'transformer', '#type' => 'Ubiquity\\annotations\\items\\TransformerAnnotation', "name"=>"password")
  ),
  'models\\Employee::$orders' => array(
    array('#name' => 'oneToMany', '#type' => 'Ubiquity\\annotations\\items\\OneToManyAnnotation', "mappedBy"=>"employee","className"=>"models\\Order")
  ),
);


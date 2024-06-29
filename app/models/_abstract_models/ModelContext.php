<?php

namespace testapp\models\_abstract_models;

use blackpostgres\Model;


abstract class ModelContext extends Model
{

    protected ?array $relationShema = array (
  'users' => 
  array (
    'orders' => 
    array (
      'coll' => 'id',
      'referenced' => 'user_id',
    ),
  ),
  'orders' => 
  array (
    'users' => 
    array (
      'coll' => 'user_id',
      'referenced' => 'id',
    ),
    'order_details' => 
    array (
      'coll' => 'id',
      'referenced' => 'order_id',
    ),
  ),
  'order_details' => 
  array (
    'orders' => 
    array (
      'coll' => 'order_id',
      'referenced' => 'id',
    ),
    'products' => 
    array (
      'coll' => 'product_id',
      'referenced' => 'id',
    ),
  ),
  'products' => 
  array (
    'order_details' => 
    array (
      'coll' => 'id',
      'referenced' => 'product_id',
    ),
  ),
);

}
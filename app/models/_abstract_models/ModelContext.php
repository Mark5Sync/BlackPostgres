<?php

namespace testapp\models\_abstract_models;

use blackpostgres\Model;


abstract class ModelContext extends Model
{

    protected ?array $relationShema = array (
  'users' => 
  array (
    'OrdersModel' => 
    array (
      'joinTableName' => 'orders',
      'joinColls' => 
      array (
        'coll' => 'id',
        'referenced' => 'user_id',
      ),
    ),
  ),
  'orders' => 
  array (
    'UsersModel' => 
    array (
      'joinTableName' => 'users',
      'joinColls' => 
      array (
        'coll' => 'user_id',
        'referenced' => 'id',
      ),
    ),
    'OrderDetailsModel' => 
    array (
      'joinTableName' => 'order_details',
      'joinColls' => 
      array (
        'coll' => 'id',
        'referenced' => 'order_id',
      ),
    ),
  ),
  'order_details' => 
  array (
    'OrdersModel' => 
    array (
      'joinTableName' => 'orders',
      'joinColls' => 
      array (
        'coll' => 'order_id',
        'referenced' => 'id',
      ),
    ),
    'ProductsModel' => 
    array (
      'joinTableName' => 'products',
      'joinColls' => 
      array (
        'coll' => 'product_id',
        'referenced' => 'id',
      ),
    ),
  ),
  'products' => 
  array (
    'OrderDetailsModel' => 
    array (
      'joinTableName' => 'order_details',
      'joinColls' => 
      array (
        'coll' => 'id',
        'referenced' => 'product_id',
      ),
    ),
  ),
);

}
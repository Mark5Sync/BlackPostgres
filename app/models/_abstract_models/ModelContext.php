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
    'promocode' => 
    array (
      'coll' => 'id',
      'referenced' => 'user_id',
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
  'promocode' => 
  array (
    'users' => 
    array (
      'coll' => 'user_id',
      'referenced' => 'id',
    ),
  ),
);

}
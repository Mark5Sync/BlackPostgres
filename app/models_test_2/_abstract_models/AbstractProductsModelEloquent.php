<?php

namespace testapp\models_test_2\_abstract_models;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use marksync\provider\NotMark;

#[NotMark]
class AbstractProductsModelEloquent extends EloquentModel
{
    protected $table = 'products';
}
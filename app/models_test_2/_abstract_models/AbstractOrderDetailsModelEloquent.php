<?php

namespace testapp\models_test_2\_abstract_models;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use marksync\provider\NotMark;

#[NotMark]
class AbstractOrderDetailsModelEloquent extends EloquentModel
{
    protected $table = 'order_details';
}
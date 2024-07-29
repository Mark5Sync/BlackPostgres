<?php
namespace testapp\_markers;
use marksync\provider\provider;
use testapp\models\PromocodeModel;
use testapp\models\UsersModel;
use testapp\models\ProductsModel;

/**
 * @property-read PromocodeModel $promocodeModel
 * @property-read UsersModel $usersModel
 * @property-read ProductsModel $productsModel

*/
trait models {
    use provider;

   function createPromocodeModel(): PromocodeModel { return new PromocodeModel; }
   function createUsersModel(): UsersModel { return new UsersModel; }
   function createProductsModel(): ProductsModel { return new ProductsModel; }

}
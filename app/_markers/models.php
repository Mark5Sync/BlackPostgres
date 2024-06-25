<?php
namespace testapp\_markers;
use marksync\provider\provider;
use testapp\models\PromocodeModel;
use testapp\models\OrdersModel;
use testapp\models\UsersModel;
use testapp\models\OrderDetailsModel;
use testapp\models\ProductsModel;

/**
 * @property-read PromocodeModel $promocodeModel
 * @property-read OrdersModel $ordersModel
 * @property-read UsersModel $usersModel
 * @property-read OrderDetailsModel $orderDetailsModel
 * @property-read ProductsModel $productsModel

*/
trait models {
    use provider;

   function createPromocodeModel(): PromocodeModel { return new PromocodeModel; }
   function createOrdersModel(): OrdersModel { return new OrdersModel; }
   function createUsersModel(): UsersModel { return new UsersModel; }
   function createOrderDetailsModel(): OrderDetailsModel { return new OrderDetailsModel; }
   function createProductsModel(): ProductsModel { return new ProductsModel; }

}
<?php
namespace testapp\_markers;
use marksync\provider\provider;
use testapp\models\OrderDetailsModel;
use testapp\models\PromocodeModel;
use testapp\models\UsersModel;
use testapp\models\ProductsModel;
use testapp\models\OrdersModel;

/**
 * @property-read OrderDetailsModel $orderDetailsModel
 * @property-read PromocodeModel $promocodeModel
 * @property-read UsersModel $usersModel
 * @property-read ProductsModel $productsModel
 * @property-read OrdersModel $ordersModel

*/
trait models {
    use provider;

   function createOrderDetailsModel(): OrderDetailsModel { return new OrderDetailsModel; }
   function createPromocodeModel(): PromocodeModel { return new PromocodeModel; }
   function createUsersModel(): UsersModel { return new UsersModel; }
   function createProductsModel(): ProductsModel { return new ProductsModel; }
   function createOrdersModel(): OrdersModel { return new OrdersModel; }

}
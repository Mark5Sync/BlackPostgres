<?php
namespace testapp\_markers;
use marksync\provider\provider;
use testapp\models\PromocodeModel;
use testapp\models\UsersModel;
use testapp\models\OrderDetailsModel;
use testapp\models\OrdersModel;
use testapp\models\ProductsModel;

/**
 * @property-read PromocodeModel $promocodeModel
 * @property-read UsersModel $usersModel
 * @property-read OrderDetailsModel $orderDetailsModel
 * @property-read OrdersModel $ordersModel
 * @property-read ProductsModel $productsModel

*/
trait models {
    use provider;

   function createPromocodeModel(): PromocodeModel { return new PromocodeModel; }
   function createUsersModel(): UsersModel { return new UsersModel; }
   function createOrderDetailsModel(): OrderDetailsModel { return new OrderDetailsModel; }
   function createOrdersModel(): OrdersModel { return new OrdersModel; }
   function createProductsModel(): ProductsModel { return new ProductsModel; }

}
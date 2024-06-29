<?php
namespace testapp\_markers;
use marksync\provider\provider;
use testapp\models\OrdersModel;
use testapp\models\OrderDetailsModel;
use testapp\models\UsersModel;
use testapp\models\ProductsModel;

/**
 * @property-read OrdersModel $ordersModel
 * @property-read OrderDetailsModel $orderDetailsModel
 * @property-read UsersModel $usersModel
 * @property-read ProductsModel $productsModel

*/
trait models {
    use provider;

   function createOrdersModel(): OrdersModel { return new OrdersModel; }
   function createOrderDetailsModel(): OrderDetailsModel { return new OrderDetailsModel; }
   function createUsersModel(): UsersModel { return new UsersModel; }
   function createProductsModel(): ProductsModel { return new ProductsModel; }

}
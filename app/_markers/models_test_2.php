<?php
namespace testapp\_markers;
use marksync\provider\provider;
use testapp\models_test_2\UsersModel;
use testapp\models_test_2\OrderDetailsModel;
use testapp\models_test_2\_abstract_models\AbstractProductsModelEloquent;
use testapp\models_test_2\_abstract_models\AbstractOrderDetailsModelEloquent;
use testapp\models_test_2\_abstract_models\AbstractUsersModelEloquent;
use testapp\models_test_2\_abstract_models\AbstractOrdersModelEloquent;
use testapp\models_test_2\OrdersModel;
use testapp\models_test_2\ProductsModel;

/**
 * @property-read UsersModel $usersModel
 * @property-read OrderDetailsModel $orderDetailsModel
 * @property-read AbstractProductsModelEloquent $abstractProductsModelEloquent
 * @property-read AbstractOrderDetailsModelEloquent $abstractOrderDetailsModelEloquent
 * @property-read AbstractUsersModelEloquent $abstractUsersModelEloquent
 * @property-read AbstractOrdersModelEloquent $abstractOrdersModelEloquent
 * @property-read OrdersModel $ordersModel
 * @property-read ProductsModel $productsModel

*/
trait models_test_2 {
    use provider;

   function createUsersModel(): UsersModel { return new UsersModel; }
   function createOrderDetailsModel(): OrderDetailsModel { return new OrderDetailsModel; }
   function createAbstractProductsModelEloquent(): AbstractProductsModelEloquent { return new AbstractProductsModelEloquent; }
   function createAbstractOrderDetailsModelEloquent(): AbstractOrderDetailsModelEloquent { return new AbstractOrderDetailsModelEloquent; }
   function createAbstractUsersModelEloquent(): AbstractUsersModelEloquent { return new AbstractUsersModelEloquent; }
   function createAbstractOrdersModelEloquent(): AbstractOrdersModelEloquent { return new AbstractOrdersModelEloquent; }
   function createOrdersModel(): OrdersModel { return new OrdersModel; }
   function createProductsModel(): ProductsModel { return new ProductsModel; }

}
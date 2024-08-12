<?php
namespace testapp\_markers;
use marksync\provider\provider;
use testapp\models\OrdersModel;
use testapp\models\PromocodeModel;
use testapp\models\_abstract_models\ModelContext;
use testapp\models\OrderDetailsModel;
use testapp\models\UsersModel;
use testapp\models\ProductsModel;

/**
 * @property-read OrdersModel $ordersModel
 * @property-read PromocodeModel $promocodeModel
 * @property-read ModelContext $modelContext
 * @property-read OrderDetailsModel $orderDetailsModel
 * @property-read UsersModel $usersModel
 * @property-read ProductsModel $productsModel

*/
trait models {
    use provider;

   function createOrdersModel(): OrdersModel { return new OrdersModel; }
   function createPromocodeModel(): PromocodeModel { return new PromocodeModel; }
   function createModelContext(): ModelContext { return new ModelContext; }
   function createOrderDetailsModel(): OrderDetailsModel { return new OrderDetailsModel; }
   function createUsersModel(): UsersModel { return new UsersModel; }
   function createProductsModel(): ProductsModel { return new ProductsModel; }

}
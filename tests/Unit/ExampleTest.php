<?php

use testapp\models\OrderDetailsModel;
use testapp\models\OrdersModel;
use testapp\models\ProductsModel;
use testapp\models\UsersModel;

$users = new UsersModel;
$products = new ProductsModel;
$orders = new OrdersModel;
$details = new OrderDetailsModel;




test('выбор всех пользователей', function () use ($users) {
    $sql = $users->toSql();
    expect($sql)->strLow('SELECT * FROM "users"');
});

test('выбор всех продуктов', function () use ($products) {
    $sql = $products->toSql();
    expect($sql)->strLow('SELECT * FROM "products"');
});

test('выбор всех заказов', function () use ($orders) {
    $sql = $orders->toSql(); // Предполагаемая функция ORM
    expect($sql)->strLow('SELECT * FROM "orders"');
});

test('выбор всех деталей заказа', function () use ($details) {
    $sql = $details->toSql(); // Предполагаемая функция ORM
    expect($sql)->strLow('SELECT * FROM "order_details"');
});

test('фильтрация пользователей по email', function () use ($users) {
    $sql = $users->where(email: 'john@example.com')->toSql(); // Предполагаемая функция ORM
    expect($sql)->strLow('SELECT * from "users" where "users"."email" = ?');
});

test('фильтрация продуктов по цене', function () use ($products) {
    $sql = $products->where('>', price: 20)->toSql(); // Предполагаемая функция ORM
    expect($sql)->strLow('SELECT * from "products" where "products"."price" > ?');
});

test('фильтрация заказов по статусу', function () use ($orders) {
    $sql = $orders->where(status: 'Shipped')->toSql(); // Предполагаемая функция ORM
    expect($sql)->strLow('SELECT * from "orders" where "orders"."status" = ?');
});

// test('сортировка пользователей по имени пользователя', function () use($users) {  ??????????
//     $sql = $users->orderByAsc(username: 1)->toSql(); // Предполагаемая функция ORM
//     expect($sql)->strLow('SELECT * FROM users ORDER BY username ASC');
// });

test('сортировка продуктов по убыванию цены', function () use ($products) {
    $sql = $products->orderByDesc(price: 1)->toSql(); // Предполагаемая функция ORM
    expect($sql)->strLow('SELECT * from "products" order by "products"."price" desc');
});

test('ограничение выборки пользователей до 5 записей', function () use ($users) {
    $sql = $users->limit(5)->toSql(); // Предполагаемая функция ORM
    expect($sql)->strLow('SELECT * from "users" limit 5');
});

test('ограничение выборки продуктов до 3 записей', function () use ($products) {
    $sql = $products->limit(3)->toSql(); // Предполагаемая функция ORM
    expect($sql)->strLow('SELECT * from "products" limit 3');
});

// test('подсчет количества пользователей', function () use($users) {
//     $sql = $users->count()->toSql(); // Предполагаемая функция ORM
//     expect($sql)->strLow('SELECT COUNT(*) FROM users');
// });

test('вычисление средней цены продуктов', function () use ($products) {
    $sql = $products->sel('AVG(@price)')->toSql();
    expect($sql)->strLow('SELECT AVG(products.price) from "products"');
});

test('вычисление суммы цен всех продуктов', function () use ($products) {
    $sql = $products->sel('SUM(@price)')->toSql(); // Предполагаемая функция ORM
    expect($sql)->strLow('SELECT SUM(products.price) from "products"');
});

test('выбор максимальной цены продукта', function () use ($products) {
    $sql = $products->sel('MAX(@price)')->toSql(); // Предполагаемая функция ORM
    expect($sql)->strLow('SELECT MAX(products.price) from "products"');
});


// test('подсчет заказов по статусам', function () {
//     $sql = $this->orm->countOrdersByStatus(); // Предполагаемая функция ORM
//     expect($sql)->strLow('SELECT status, COUNT(*) FROM orders GROUP BY status');
// });

// test('вычисление средней цены продуктов по статусам заказа', function () {
//     $sql = $this->orm->averageProductPriceByOrderStatus(); // Предполагаемая функция ORM
//     expect($sql)->strLow('SELECT o.status, AVG(p.price) FROM orders o JOIN order_details od ON o.id = od.order_id JOIN products p ON od.product_id = p.id GROUP BY o.status');
// });

test('соединение таблиц пользователей и заказов', function () use ($users) {
    $sql = $users->sel(username: 1)
        ->leftJoinOrdersModel->sel(id: 1, status: 1)
        ->toSql();

    expect($sql)->strLow('SELECT "users"."username", "orders"."id", "orders"."status" from "users" left join "orders" on "users"."id" = "orders"."user_id"');
});


// test('соединение всех связанных таблиц для заказов', function () {
//     $sql = $this->orm->joinAllForOrders(); // Предполагаемая функция ORM
//     expect($sql)->strLow('SELECT u.username, o.id AS order_id, o.status, p.name AS product_name, od.quantity, od.price FROM users u JOIN orders o ON u.id = o.user_id JOIN order_details od ON o.id = od.order_id JOIN products p ON od.product_id = p.id');
// });


// test('выбор продуктов, которые были заказаны', function () {
//     $sql = $this->orm->getProductsInOrders(); // Предполагаемая функция ORM
//     expect($sql)->strLow('SELECT * FROM products WHERE id IN (SELECT product_id FROM order_details)');
// });

// test('обновление email пользователя', function () {
//     $sql = $this->orm->updateUserEmail(1, 'new_email@example.com'); // Предполагаемая функция ORM
//     expect($sql)->strLow("UPDATE users SET email = 'new_email@example.com' WHERE id = 1");
// });

// test('обновление статуса заказа', function () {
//     $sql = $this->orm->updateOrderStatus(1, 'Completed'); // Предполагаемая функция ORM
//     expect($sql)->strLow("UPDATE orders SET status = 'Completed' WHERE id = 1");
// });

// test('удаление пользователя', function () {
//     $sql = $this->orm->deleteUser(2); // Предполагаемая функция ORM
//     expect($sql)->strLow('DELETE FROM users WHERE id = 2');
// });

// test('удаление продукта', function () {
//     $sql = $this->orm->deleteProduct(1); // Предполагаемая функция ORM
//     expect($sql)->strLow('DELETE FROM products WHERE id = 1');
// });


// test('подсчет заказов по пользователям с условием HAVING', function () {
//     $sql = $this->orm->countOrdersByUserWithHaving(); // Предполагаемая функция ORM
//     expect($sql)->strLow('SELECT user_id, COUNT(*) AS total_orders FROM orders GROUP BY user_id HAVING COUNT(*) > 1');
// });

// test('вычисление средней цены продуктов с условием HAVING', function () {
//     $sql = $this->orm->averageProductPriceWithHaving(); // Предполагаемая функция ORM
//     expect($sql)->strLow('SELECT o.user_id, AVG(p.price) AS average_price FROM orders o JOIN order_details od ON o.id = od.order_id JOIN products p ON od.product_id = p.id GROUP BY o.user_id HAVING AVG(p.price) > 20.00');
// });

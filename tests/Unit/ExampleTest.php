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

test('выбор всех заказов', function () use($orders) {
    $sql = $orders->toSql(); // Предполагаемая функция ORM
    expect($sql)->strLow('SELECT * FROM "orders"');
});

test('выбор всех деталей заказа', function () use($details) {
    $sql = $details->toSql(); // Предполагаемая функция ORM
    expect($sql)->strLow('SELECT * FROM "order_details"');
});

test('фильтрация пользователей по email', function () use($users) {
    $sql = $users->where(email: 'john@example.com')->toSql(); // Предполагаемая функция ORM
    expect($sql)->strLow('SELECT * FROM users WHERE email = "john@example.com"');
});

// test('фильтрация продуктов по цене', function () use($products) {
//     $sql = $products->greathThen(price: 20.00)->toSql(); // Предполагаемая функция ORM
//     expect($sql)->strLow('SELECT * FROM products WHERE price > 20.00');
// });

test('фильтрация заказов по статусу', function () use($orders) {
    $sql = $orders->where(status: 'Shipped')->toSql(); // Предполагаемая функция ORM
    expect($sql)->strLow('SELECT * FROM orders WHERE status = "Shipped"');
});

test('сортировка пользователей по имени пользователя', function () use($users) {
    $sql = $users->orderByAsc(username: 1)->toSql(); // Предполагаемая функция ORM
    expect($sql)->strLow('SELECT * FROM users ORDER BY username ASC');
});

test('сортировка продуктов по убыванию цены', function () use($products) {
    $sql = $products->orderByDesc(price: 1)->toSql(); // Предполагаемая функция ORM
    expect($sql)->strLow('SELECT * FROM products ORDER BY price DESC');
});

test('ограничение выборки пользователей до 5 записей', function () use($users) {
    $sql = $users->limit(5)->toSql(); // Предполагаемая функция ORM
    expect($sql)->strLow('SELECT * FROM users LIMIT 5');
});

test('ограничение выборки продуктов до 3 записей', function () use($products) {
    $sql = $products->limit(3)->toSql(); // Предполагаемая функция ORM
    expect($sql)->strLow('SELECT * FROM products LIMIT 3');
});

test('подсчет количества пользователей', function () use($users) {
    $sql = $users->count()->toSql(); // Предполагаемая функция ORM
    expect($sql)->strLow('SELECT COUNT(*) FROM users');
});

test('вычисление средней цены продуктов', function () use($products){
    $sql = $products->sel('AVG(?)', price: 1)->toSql();
    expect($sql)->strLow('SELECT AVG(price) FROM products');
});

// test('вычисление суммы цен всех продуктов', function () {
//     $sql = $this->orm->sumProductPrices(); // Предполагаемая функция ORM
//     expect($sql)->strLow('SELECT SUM(price) FROM products');
// });

// test('выбор максимальной цены продукта', function () {
//     $sql = $this->orm->maxProductPrice(); // Предполагаемая функция ORM
//     expect($sql)->strLow('SELECT MAX(price) FROM products');
// });

// test('выбор минимальной цены продукта', function () {
//     $sql = $this->orm->minProductPrice(); // Предполагаемая функция ORM
//     expect($sql)->strLow('SELECT MIN(price) FROM products');
// });

// test('подсчет заказов по статусам', function () {
//     $sql = $this->orm->countOrdersByStatus(); // Предполагаемая функция ORM
//     expect($sql)->strLow('SELECT status, COUNT(*) FROM orders GROUP BY status');
// });

// test('вычисление средней цены продуктов по статусам заказа', function () {
//     $sql = $this->orm->averageProductPriceByOrderStatus(); // Предполагаемая функция ORM
//     expect($sql)->strLow('SELECT o.status, AVG(p.price) FROM orders o JOIN order_details od ON o.id = od.order_id JOIN products p ON od.product_id = p.id GROUP BY o.status');
// });

// test('соединение таблиц пользователей и заказов', function () {
//     $sql = $this->orm->joinUsersAndOrders(); // Предполагаемая функция ORM
//     expect($sql)->strLow('SELECT u.username, o.id, o.status FROM users u JOIN orders o ON u.id = o.user_id');
// });

// test('соединение таблиц заказов и деталей заказов', function () {
//     $sql = $this->orm->joinOrdersAndOrderDetails(); // Предполагаемая функция ORM
//     expect($sql)->strLow('SELECT o.id, od.product_id, od.quantity, od.price FROM orders o JOIN order_details od ON o.id = od.order_id');
// });

// test('соединение всех связанных таблиц для заказов', function () {
//     $sql = $this->orm->joinAllForOrders(); // Предполагаемая функция ORM
//     expect($sql)->strLow('SELECT u.username, o.id AS order_id, o.status, p.name AS product_name, od.quantity, od.price FROM users u JOIN orders o ON u.id = o.user_id JOIN order_details od ON o.id = od.order_id JOIN products p ON od.product_id = p.id');
// });

// test('выбор пользователей, у которых есть заказы', function () {
//     $sql = $this->orm->getUsersWithOrders(); // Предполагаемая функция ORM
//     expect($sql)->strLow('SELECT * FROM users WHERE id IN (SELECT user_id FROM orders)');
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

// test('начало транзакции и обновление email пользователя', function () {
//     $sql = $this->orm->transactionUpdateUserAndOrder(1, 'transaction_email@example.com', 'Processing'); // Предполагаемая функция ORM
//     expect($sql)->strLow("BEGIN;\nUPDATE users SET email = 'transaction_email@example.com' WHERE id = 1;\nUPDATE orders SET status = 'Processing' WHERE id = 1;\nCOMMIT;");
// });

// test('начало транзакции и откат изменений', function () {
//     $sql = $this->orm->transactionRollbackUpdateUser(1, 'rollback_email@example.com'); // Предполагаемая функция ORM
//     expect($sql)->strLow("BEGIN;\nUPDATE users SET email = 'rollback_email@example.com' WHERE id = 1;\nROLLBACK;");
// });

// test('подсчет заказов по пользователям с условием HAVING', function () {
//     $sql = $this->orm->countOrdersByUserWithHaving(); // Предполагаемая функция ORM
//     expect($sql)->strLow('SELECT user_id, COUNT(*) AS total_orders FROM orders GROUP BY user_id HAVING COUNT(*) > 1');
// });

// test('вычисление средней цены продуктов с условием HAVING', function () {
//     $sql = $this->orm->averageProductPriceWithHaving(); // Предполагаемая функция ORM
//     expect($sql)->strLow('SELECT o.user_id, AVG(p.price) AS average_price FROM orders o JOIN order_details od ON o.id = od.order_id JOIN products p ON od.product_id = p.id GROUP BY o.user_id HAVING AVG(p.price) > 20.00');
// });

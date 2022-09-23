<?php

namespace Itechart\InternshipProject\Model;

use Itechart\InternshipProject\Model\BasicModel;

class OrderModel extends BasicModel
{
    public function __construct()
    {
        parent::__construct();
    }

    //CREATE
    public function setOrder(string $address, int $user_id):array
    {
        //if (isset($_POST['submit_setreview']))
        $order_adress = (string)$_POST['order_address'];
        $sql = "INSERT INTO order_product (user_id, order_address) VALUES (?, ?) WHERE user_id = ?";
        $query = $this->connection->prepare($sql);
        $query->bind_param('isi', $user_id, $address, $user_id);
        $query->execute();   
        $query->get_result();
        $result = "Success!";
        return $result;
    }

    //READ
    public function getOrders(): array
    {
        $fields = "order_product.order_id AS order_id, shop.user.user_name AS user_name, shop.user.user_surname AS user_surname, shop.user.user_phone AS user_phone, order_product.order_address AS address, order_status.status_name AS status, SUM(cart.amount*product.product_price)AS price";
        $table = "order_product INNER JOIN user ON user.user_id=order_product.user_id INNER JOIN order_status ON order_status.status_id=order_product.status INNER JOIN cart ON cart.order_id=order_product.order_id LEFT JOIN product ON product.product_id=cart.product_id";
        $result = parent::getModel($fields, $table, NULL, NULL, NULL, "order_product.order_id", NULL, NULL);
        return $result;
    }

    public function getOrdersByUserId(int $user_id): array
    {
        if (is_int($user_id)) {
            $fields = "order_product.order_id AS order_id, shop.user.user_name AS user_name, shop.user.user_surname AS user_surname, shop.user.user_phone AS user_phone, order_product.order_address AS address, order_status.status_name AS status, SUM(cart.amount*product.product_price)AS price";
            $table = "order_product INNER JOIN user ON user.user_id=order_product.user_id INNER JOIN order_status ON order_status.status_id=order_product.status INNER JOIN cart ON cart.order_id=order_product.order_id LEFT JOIN product ON product.product_id=cart.product_id";
            $result = parent::getModel($fields, $table, "user_id", $user_id, NULL, "order_product.order_id", NULL, NULL);
            return $result;
        }
    }

    //UPDATE
    public function updateOrderAddress(int $order_id):void
    {
        $new_order_address = trim((string)$_POST['new_order_address']);
        global $conn;
        $sql = "UPDATE `order_product` SET `order_address` = ? WHERE `order_id` = ?";
        $query = $conn->prepare($sql);
        $query->bind_param('si', $new_order_address, $order_id);
        if ($query->execute()) {
            echo "Order address changed";
        } else {
            $conn->error;
        }        
    }

    //Function available only for admin
    public function updateOrderStatus(int $order_id, int $new_order_status):void
    {
        /*$order_id = (int)$_GET['cancel_order'];*/
        //$new_order_status = (int)$_POST['new_order_status'];
        $values = array($new_order_status);
        $result = parent::updateModel("order_status", "order_product", "order_id", $order_id, $values, NULL, "ii");
    }
    
    //DELETE
    public function cancelOrder(int $order_id):void
    {
        $values = array(3);
        $result = parent::updateModel("order_status", "order_product", "order_id", $order_id, $values, NULL, "ii");    
    }

    public function archiveOrder(int $order_id):void
    {
        $values = array(4);
        $result = parent::updateModel("order_status", "order_product", "order_id", $order_id, $values, NULL, "ii");      
    }

    public function deleteOrder(int $order_id):void
    {
        $values = array(4);
        $result = parent::deleteModelItem("order_product", "order_id", $order_id, NULL, "i");      
    }
}
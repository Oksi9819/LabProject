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
        //$order_adress = (string)$_POST['order_address'];
        $created_at = date("Y-m-d h:i:s");
        $values = array($user_id, $address, $created_at);
        $sql = "INSERT INTO order_product (user_id, order_address, created_at) VALUES (?, ?, ?)";
        $query = $this->connection->prepare($sql);
        $query->bind_param('iss', ...$values);
        $query->execute();   
        $query->get_result();
        $result = "Success!";
        return $result;
    }

    //READ
    public function getOrders(): array
    {
        $fields = "order_product.order_id AS order_id, shop.user.user_name AS user_name, shop.user.user_surname AS user_surname, shop.user.user_phone AS user_phone, shop.user.user_email AS user_email, order_product.order_address AS address, order_status.status_name AS status, SUM(cart.amount*product.product_price) AS price";
        $table = "order_product INNER JOIN user ON user.user_id=order_product.user_id INNER JOIN order_status ON order_status.status_id=order_product.status INNER JOIN cart ON cart.order_id=order_product.order_id LEFT JOIN product ON product.product_id=cart.product_id";
        $result = $this->getModel($fields, $table, NULL, NULL, NULL, "order_product.order_id", NULL, NULL);
        return $result;
    }

    public function getOrdersDetails(): array
    {
        $fields = "cart.order_id AS order_id, product.product_id AS product_id, product.product_name AS product_name, product.product_price AS product_price";
        $table = "cart LEFT JOIN product ON product.product_id=cart.product_id";
        $result = $this->getModel($fields, $table, NULL, NULL, NULL, NULL, "order_id, product_id", NULL);
        return $result;
    }

    public function getOrdersByUserId(int $user_id): array
    {
        if (is_int($user_id)) {
            $fields = "order_product.order_id AS order_id, order_product.order_address AS address, order_status.status_name AS status, SUM(cart.amount*product.product_price)AS price";
            $table = "order_product INNER JOIN user ON user.user_id=order_product.user_id INNER JOIN order_status ON order_status.status_id=order_product.status INNER JOIN cart ON cart.order_id=order_product.order_id LEFT JOIN product ON product.product_id=cart.product_id";
            $result = $this->getModel($fields, $table, "shop.user.user_id", $user_id, NULL, "order_product.order_id", NULL, "i");
            return $result;
        }
    }

    public function getOrderDetails(int $user_id): array
    {
        $fields = "c.order_id AS order_id, p.product_id AS product_id, p.product_name AS product_name, p.product_price AS product_price";
        $table = "cart AS c LEFT JOIN product AS p ON p.product_id=c.product_id LEFT JOIN order_product AS op ON op.order_id=c.order_id";
        $result = $this->getModel($fields, $table, "op.user_id", $user_id, NULL, NULL, "order_id, product_id", "i");
        return $result;
    }

    //UPDATE
    public function updateOrderAddress(int $order_id, string $new_order_address):void
    {
        //$new_order_address = trim((string)$_POST['new_order_address']);
        $updated_at = date("Y-m-d h:i:s");
        $values = array($new_order_address, $updated_at);
        $result = $this->updateModel("order_address, updated_at", "order_product", "order_id", $order_id, $values, NULL, "ssi");       
    }

    //Function available only for admin
    public function updateOrderStatus(int $order_id, int $new_order_status):void
    {
        /*$order_id = (int)$_GET['cancel_order'];*/
        //$new_order_status = (int)$_POST['new_order_status'];
        $updated_at = date("Y-m-d h:i:s");
        $values = array($new_order_status, $updated_at);
        $result = $this->updateModel("order_status, updated_at", "order_product", "order_id", $order_id, $values, NULL, "isi");
    }
    
    //DELETE
    public function cancelOrder(int $order_id):void
    {
        $values = array(3);
        $result = $this->updateModel("order_status", "order_product", "order_id", $order_id, $values, NULL, "ii");    
    }

    public function archiveOrder(int $order_id):void
    {
        $values = array(4);
        $result = $this->updateModel("order_status", "order_product", "order_id", $order_id, $values, NULL, "ii");      
    }

    public function deleteOrder(int $order_id):void
    {
        $values = array(4);
        $result = $this->deleteModelItem("order_product", "order_id", $order_id, NULL, "i");      
    }
}
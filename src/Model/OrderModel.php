<?php

namespace Itechart\InternshipProject\Model;

use Exception;
use Itechart\InternshipProject\Model\BasicModel;

class OrderModel extends BasicModel
{
    public function __construct()
    {
        parent::__construct();
    }

    //CREATE
    public function setOrder(string $address, int $user_id, array $order_items) : array
    {
        $created_at = date("Y-m-d h:i:s");
        $values = array($user_id, $address, $created_at);
        $sql = "INSERT INTO order_product (user_id, order_address, created_at) VALUES (?, ?, ?)";
        $query = $this->connection->prepare($sql);
        $query->bind_param('iss', ...$values);
        $query->execute();   
        $query->get_result();
        $order_id = $this->connection->insert_id;
        foreach($order_items as $key => $order_item) {
            $sql = "INSERT INTO cart (order_id, product_id, amount) VALUES (?, ?, ?)";
            $query = $this->connection->prepare($sql);
            $query->bind_param('iii', $order_id, $key, $order_item[2]);
            $query->execute();   
            $query->get_result();
        }
        return $this->getOrderDetails($order_id);
    }

    //READ
    public function getOrders() : array
    {
        $fields = "order_product.order_id AS order_id, 
            shop.user.user_name AS user_name, 
            shop.user.user_surname AS user_surname, 
            shop.user.user_phone AS user_phone, 
            shop.user.user_email AS user_email, 
            order_product.order_address AS address, 
            order_status.status_name AS status, 
            SUM(cart.amount*product.product_price) AS price";
        $table = "order_product 
            INNER JOIN user ON user.user_id=order_product.user_id 
            INNER JOIN order_status ON order_status.status_id=order_product.status 
            INNER JOIN cart ON cart.order_id=order_product.order_id 
            LEFT JOIN product ON product.product_id=cart.product_id";
        return $this->getModel($fields, $table, NULL, NULL, NULL, "order_product.order_id", NULL, NULL);
    }

    public function getOrdersDetailsByAdmin() : array
    {
        $fields = "cart.order_id AS order_id, 
            product.product_id AS product_id, 
            product.product_name AS product_name, 
            product.product_price AS product_price";
        $table = "cart LEFT JOIN product ON product.product_id=cart.product_id";
        $result = $this->getModel($fields, $table, NULL, NULL, NULL, NULL, "order_id, product_id", NULL);
        if (!empty($result)) {
            return $result;
        } else {
            throw new Exception("There are no orders yet :(");
        }
    }

    public function getOrdersByUserId(int $user_id) : array
    {
        if (is_int($user_id)) {
            $fields = "order_product.order_id AS order_id, 
                order_product.order_address AS address, 
                order_status.status_name AS status, 
                SUM(cart.amount*product.product_price)AS price";
            $table = "order_product 
                INNER JOIN user ON user.user_id=order_product.user_id 
                INNER JOIN order_status ON order_status.status_id=order_product.status 
                INNER JOIN cart ON cart.order_id=order_product.order_id 
                LEFT JOIN product ON product.product_id=cart.product_id";
            $result = $this->getModel($fields, $table, "shop.user.user_id", $user_id, NULL, "order_product.order_id", NULL, "i");
            if (!empty($result)) {
                return $result;
            } else {
                throw new Exception("You don't have orders yet.");
            }
        }
    }

    public function getOrdersDetailsByUser(int $user_id) : array
    {
        $fields = "c.order_id AS order_id, 
            p.product_id AS product_id, 
            p.product_name AS product_name, 
            p.product_price AS product_price";
        $table = "cart AS c LEFT JOIN product AS p ON p.product_id=c.product_id LEFT JOIN order_product AS op ON op.order_id=c.order_id";
        return $this->getModel($fields, $table, "op.user_id", $user_id, NULL, NULL, "order_id, product_id", "i");
    }

    public function getOrderDetails(int $order_id) : array
    {
        $fields = "c.order_id AS order_id, 
            p.product_id AS product_id, 
            p.product_name AS product_name, 
            p.product_price AS product_price, 
            c.amount AS amount";
        $table = "cart AS c 
            LEFT JOIN product AS p ON p.product_id=c.product_id 
            LEFT JOIN order_product AS op ON op.order_id=c.order_id";
        return $this->getModel($fields, $table, "c.order_id", $order_id, NULL, NULL, "product_id", "i");
    }

    public function getOrderStatuses() : array
    {
        return $this->getModel("*", "order_status", NULL, NULL, NULL, NULL, "status_id", NULL);
    }

    //UPDATE
    public function updateOrderAddress(int $order_id, string $new_order_address) : void
    {
        $updated_at = date("Y-m-d h:i:s");
        $values = array($new_order_address, $updated_at);
        $this->updateModel("order_address, updated_at", "order_product", "order_id", $order_id, $values, NULL, "ssi");       
    }

    //Function available only for admin
    public function updateOrderStatus(int $order_id, int $new_order_status) : void
    {
        $updated_at = date("Y-m-d h:i:s");
        $values = array($new_order_status, $updated_at);
        $this->updateModel("status, updated_at", "order_product", "order_id", $order_id, $values, NULL, "isi");
    }
    
    //DELETE
    public function cancelOrder(int $order_id) : void
    {
        $updated_at = date("Y-m-d h:i:s");
        $values = array(3, $updated_at);
        $this->updateModel("status, updated_at", "order_product", "order_id", $order_id, $values, NULL, "isi");    
    }

    public function deleteOrder(int $order_id) : void
    {
        $this->deleteModelItem("order_product", "order_id", $order_id, NULL, "i");      
    }
}
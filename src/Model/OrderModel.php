<?php

namespace Itechart\InternshipProject\Model;

class OrderModel
{
    //CREATE
    public function setOrder():array
    {
        $order_adress = (string)$_POST['order_address'];
        $user_id = (int)$_POST['user_id'];
        global $conn;
        if (isset($_POST['submit_setreview'])) {
            $sql = "INSERT INTO `order_product`(`user_id`, `order_address`) VALUES(?,?)";
            $query = $conn->prepare($sql);
            $query->bind_param('is', $user_id, $order_adress);
            $query->execute();   
            $result = $query->get_result();
            $result = $result->fetch_assoc(); 
            return $result;     
        } 
    }

    //READ
    public function getOrders(): array
    {
        global $conn;
        $sql = "SELECT order_product.order_id AS order_id, shop.user.user_name AS user_name, shop.user.user_surname AS user_surname, shop.user.user_phone AS user_phone, order_product.order_address AS address, order_status.status_name AS status, SUM(cart.amount*product.product_price)AS price
        FROM `order_product`
        INNER JOIN `user` ON user.user_id=order_product.user_id
        INNER JOIN `order_status` ON order_status.status_id=order_product.status
        INNER JOIN `cart` ON cart.order_id=order_product.order_id
        LEFT JOIN `product` ON product.product_id=cart.product_id
        GROUP BY order_product.order_id;";
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->get_result();
        $result = $result->fetch_assoc(); 
        return $result;
    }

    public function getOrdersByUserId(int $user_id): array
    {
        if (is_int($user_id)) {
            global $conn;
            $sql = "SELECT order_product.order_id AS order_id, shop.user.user_name AS user_name, shop.user.user_surname AS user_surname, shop.user.user_phone AS user_phone, order_product.order_address AS address, order_status.status_name AS status, SUM(cart.amount*product.product_price)AS price
            FROM `order_product`
            INNER JOIN `user` ON user.user_id=order_product.user_id
            INNER JOIN `order_status` ON order_status.status_id=order_product.status
            INNER JOIN `cart` ON cart.order_id=order_product.order_id
            LEFT JOIN `product` ON product.product_id=cart.product_id
            WHERE user.user_id = ?
            GROUP BY order_product.order_id;";
            $query = $conn->prepare($sql);
            $query->bind_param('i', $user_id);
            $query->execute();
            $result = $query->get_result();
            $result = $result->fetch_assoc(); 
            return $result;
        }
    }

    //UPDATE
    public function updateOrderAddress(int $order_id):void
    {
        /*$order_id = (int)$_GET['cancel_order'];*/
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
    public function updateOrderStatus(int $order_id):void
    {
        /*$order_id = (int)$_GET['cancel_order'];*/
        $new_order_status = (int)$_POST['new_order_status'];
        global $conn;
        $sql = "UPDATE `order_product` SET `status` = ? WHERE `order_id` = ?";
        $query = $conn->prepare($sql);
        $query->bind_param('ii', $new_order_status, $order_id);
        if ($query->execute()) {
            echo "Order status changed.";
        } else {
            $conn->error;
        }        
    }
    
    //DELETE
    public function cancelOrder(int $order_id):void
    {
        /*$order_id = (int)$_GET['cancel_order'];*/
        global $conn;
        $sql = "UPDATE `order_product` SET `status` = 3 WHERE `order_id` = ?";
        $query = $conn->prepare($sql);
        $query->bind_param('i', $order_id);
        if ($query->execute()) {
            echo "Order canceled.";
        } else {
            $conn->error;
        }        
    }

    public function archiveOrder(int $order_id):void
    {
        /*$order_id = (int)$_GET['cancel_order'];*/
        global $conn;
        $sql = "UPDATE `order_product` SET `status` = 4 WHERE `order_id` = ?";
        $query = $conn->prepare($sql);
        $query->bind_param('i', $order_id);
        if ($query->execute()) {
            echo "Order archived.";
        } else {
            $conn->error;
        }      
    }
}
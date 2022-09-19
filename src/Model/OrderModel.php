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
        $sql = "SELECT * FROM `order_product`";
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
            $sql = "SELECT * FROM `order_product` WHERE `user_id` = ?";
            $query = $conn->prepare($sql);
            $query->bind_param('i', $user_id);
            $query->execute();
            $result = $query->get_result();
            $result = $result->fetch_assoc(); 
            return $result;
        }
    }

    //UPDATE
    
    
    //DELETE. Will add fieild "status". Deleted orders will not be deleted in fact, their status will be changed to "canceled" in DB.
    /*public function archiveOrder(int $order_id):void
    {
        if (isset($_POST['delete_submit'])) {
            $review_id = (int)$_GET['cancel_order'];
            global $conn;
            $sql = "DELETE * FROM `user` WHERE `review_id` = ?";
            $query = $conn->prepare($sql);
            $query->bind_param('i', $review_id);
            if ($query->execute()) {
                echo "Review deleted.";
            } else {
                $conn->error;
            }
        }
    }*/
}
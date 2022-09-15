<?php

namespace Itechart\InternshipProject\Model;

class OrderModel
{
    public function getOrders(): array
    {
        $orders=array(
            array(
                "order_id"=>1,
                "order_product_list"=>array("Продукт1", "Продукт2", "Продукт3"),
                "order_sum"=>123,
                "order_address"=>"тут будет адрес для заказа",
                "order_phone"=>"+375 (29) 256-98-88",
                "order_email"=>"sdfuighjkl@gmail.com",),
            array(
                "order_id"=>2,
                "order_product_list"=>array("Продукт1", "Продукт2", "Продукт3"),
                "order_sum"=>123,
                "order_address"=>"тут будет адрес для заказа",
                "order_phone"=>"+375 (29) 256-98-88",
                "order_email"=>"sdfuighjkl@gmail.com",),
            array(
                "order_id"=>3,
                "order_product_list"=>array("Продукт1", "Продукт2", "Продукт3"),
                "order_sum"=>123,
                "order_address"=>"тут будет адрес для заказа",
                "order_phone"=>"+375 (29) 256-98-88",
                "order_email"=>"sdfuighjkl@gmail.com",),
        );
        return $orders;
    }

    public function getOrdersByUserId(int $user_id): array
    {
        $ordersByUserId=array(
            array(
                "order_id"=>1,
                "order_product_list"=>array("Продукт1", "Продукт2", "Продукт3"),
                "order_sum"=>123,
                "order_address"=>"тут будет адрес для заказа",),
            array(
                "order_id"=>3,
                "order_product_list"=>array("Продукт1", "Продукт2", "Продукт3"),
                "order_sum"=>123,
                "order_address"=>"тут будет адрес для заказа",),
        );
        return $ordersByUserId;
    }

    /*public function setOrder(string $userName, string $userSurname, string $email, string $phone, string $reviewText):array
    {
        $setReview=array(
            "review_id"=>1,
            "review_user_surname"=>$userSurname,
            "review_user_name"=>$userName,
            "review_email"=>$email,
            "review_phone"=>$phone,
            "review_text"=>$reviewText,
        );
        return $setReview;
    }*/

    /*public function archiveOrder(int $order_id):void
    {
        if(order_to_archive['order_id']==$review_id)
        {
            unset($order_to_archive);
        }
    }*/
}
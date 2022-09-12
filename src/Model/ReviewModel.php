<?php

namespace Itechart\InternshipProject\Model;

class ReviewModel
{
    public function getReviews():array
    {
        $reviews=array("Робот-пылесос моющий Xiaomi Mi Robot Vacuum Mop 2 Ultra", "Электрический чайник Xiaomi Water Kettle 1.5L", "Увлажнитель воздуха Deerma Air Humidifier DEM F628S", "Мультифункциональный пароочиститель Deerma Steam Cleaner DEM-ZQ610");
        return $reviews;
    }

    public function getReviewsByUserId(int $user_id):array
    {
        $reviewsByUserId=array("Xiaomi Mi Robot Vacuum Mop 2 Ultra очень понравился! Шикарный помощник по дому.", "Очень приятный персонал. Быстро помогли выбрать нужный товар.");
        return reviewsByUserId;
    }

    public function setReview(string $userName, string $userSurname, string $email, string $phone, string $reviewText):array
    {
        $setReview=array(
            "review_id"=>1,
            "review_user_surname"=>$userSurname,
            "review_user_name"=>$userName,
            "review_email"=>$email,
            "review_phone"=>$phone,
            "review_text"=>$reviewText,
        );
        return setReview;
    }

    /*public function deleteReview(int $review_id):void
    {
        if(review_to_delete['review_id']==$review_id)
        {
            unset($review_to_delete);
        }
    }*/
}
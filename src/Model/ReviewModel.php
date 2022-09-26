<?php

namespace Itechart\InternshipProject\Model;

use Itechart\InternshipProject\Model\BasicModel;

class ReviewModel extends BasicModel
{
    public function __construct()
    {
        parent::__construct();
    }

    //CREATE
    public function setReview(array $values): array
    {
        /*if (isset($_POST['submit_setreview'])) {
            $reviewText = (string)$_POST['reviewText'];
            $user_id = (int)$_POST['user_id'];
            if (strlen($reviewText) < 501) {
                $values = array();
                array_push($values, $user_id);
                array_push($values, $reviewText);*/
                $fields = array('user_id', 'review_text');
                $result = parent::setModel("review", $fields, "is", $values);
                return $result;     
            /*}  echo "Review is too long. Length must be less than 500 characters.<br>";
        }*/
    }

    //READ
    public function getReviews(): array
    {
        $result = parent::getModel("r.review_id AS review_id, u.user_name AS user_name, u.user_surname AS user_surname, r.review_text As review_text", "review AS r LEFT JOIN shop.user AS u ON u.user_id=r.user_id", NULL, NULL, NULL, NULL, NULL, NULL);
        return $result;
    }

    public function getReviewsByUserId(int $user_id): array
    {
        $result = parent::getModel("*", "review", "user_id", $user_id, NULL, NULL, NULL, "i");
        return $result;
    }

    //UPDATE
    public function updateReview(int $review_id, array $values): array
    {
        /*
        if (isset($_POST['submit_setreview'])) {
            $reviewText = (string)$_POST['reviewText'];
            if (strlen($reviewText) < 501) {
                $sql = "UPDATE `review` SET `review_text`= ? WHERE `review_id` = ?";*/
                $result = parent::updateModel("review_text", "review", "review_id", $review_id, $values, NULL, "si");
                return $result;     /*        
            } else {
                echo "Review is too long. Length must be less than 500 characters.<br>";
            }
        }*/ 
    }

    //DELETE
    public function deleteReview(int $review_id)
    {
        /*if (isset($_POST['delete_submit'])) {
            $review_id = (int)$_GET['delete_review'];*/
            $result = deleteModelItem("review", "review_id", $review_id, NULL, "s");
        /*}*/
    }
}
<?php

namespace Itechart\InternshipProject\Model;

use Exception;
use Itechart\InternshipProject\Model\BasicModel;

class ReviewModel extends BasicModel
{
    public function __construct()
    {
        parent::__construct();
    }

    //CREATE
    public function setReview(int $user_id, string $review_text)
    {
        if (strlen($review_text) < 501) {
            $fields = array('user_id', 'review_text');
            $values = array();
            array_push($values, $user_id);
            array_push($values, $review_text);
            print_r($values);
            $result = $this->setModel("review", $fields, "is", $values);
        } else {
            throw new Exception("Review is too long. Length must be less than 500 characters.<br>", 1);
        } 
    }

    //READ
    public function getReviews(): array
    {
        $result = $this->getModel("r.review_id AS review_id, u.user_name AS user_name, u.user_surname AS user_surname, r.review_text As review_text", "review AS r LEFT JOIN shop.user AS u ON u.user_id=r.user_id", NULL, NULL, NULL, NULL, NULL, NULL);
        return $result;
    }

    public function getReviewsByUserId(int $user_id): array
    {
        $result = $this->getModel("*", "review", "user_id", $user_id, NULL, NULL, NULL, "i");
        return $result;
    }

    //UPDATE
    public function updateReview(int $review_id, string $review_text)
    {
        if (strlen($review_text) < 501) {
            $values = array($review_text);
            $result = $this->updateModel("review_text", "review", "review_id", $review_id, $values, NULL, "si");      
        } else {
            throw new Exception("Review is too long. Length must be less than 500 characters.<br>", 1);
        }
    }

    //DELETE
    public function deleteReview(int $review_id)
    {
        $result = $this->deleteModelItem("review", "review_id", $review_id, NULL, "s");
    }
}
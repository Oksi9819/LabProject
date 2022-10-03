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
            $fields = array('user_id', 'review_text', 'created_at');
            $values = array();
            $created_at = date("Y-m-d h:i:s");
            array_push($values, $user_id);
            array_push($values, $review_text);
            array_push($values, $created_at);
            print_r($values);
            $result = $this->setModel("review", $fields, "iss", $values);
        } else {
            throw new Exception("Review is too long. Length must be less than 500 characters.<br>");
        } 
    }

    //READ
    public function getReviews(): array
    {
        $result = $this->getModel("r.review_id AS review_id, u.user_name AS user_name, u.user_surname AS user_surname, r.review_text As review_text", "review AS r LEFT JOIN shop.user AS u ON u.user_id=r.user_id", NULL, NULL, NULL, NULL, NULL, NULL);
        if (!empty($result)) {
            return $result;
        }  else {
            throw new Exception("There are no reviews yet :(");
        }
    }

    public function getReviewsByUserId(int $user_id): array
    {
        $result = $this->getModel("*", "review", "user_id", $user_id, NULL, NULL, NULL, "i");
        if (!empty($result)) {
            return $result;
        }  else {
            throw new Exception("You haven't posted any reviews yet :(");
        }
    }

    //UPDATE
    public function updateReview(int $review_id, string $review_text)
    {
        if (strlen($review_text) < 501) {
            $updated_at = date("Y-m-d h:i:s");
            $values = array($review_text, $updated_at);
            $result = $this->updateModel("review_text, updated_at", "review", "review_id", $review_id, $values, NULL, "ssi");      
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
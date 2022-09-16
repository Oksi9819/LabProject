<?php

namespace Itechart\InternshipProject\Model;

class ReviewModel
{
    //CREATE
    public function setReview(int $user_id, string $reviewText): array
    {
        $reviewText = (string)$_POST['reviewText'];
        if (strlen($reviewText) < 501) {
            global $conn;
            $user_id = (int)$_POST['user_id'];
            if (isset($_POST['submit_setreview'])) {
                $sql = "INSERT INTO `review`(`user_id`, `review_text`) VALUES(?,?)";
                $query = $conn->prepare($sql);
                $query->bind_param('is', $user_id, $reviewText);
                $query->execute();   
                $result = $query->get_result();
                $result = $result->fetch_assoc(); 
                return $result;     
            } 
        } else {
            echo "Review is too long. Length must be less than 500 characters.<br>";
        }
    }

    //READ
    public function getReviews(): array
    {
        global $conn;
        $sql = "SELECT * FROM `review`";
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->get_result();
        $result = $result->fetch_assoc(); 
        return $result;
    }

    public function getReviewsByUserId(int $user_id): array
    {
        if (is_int($user_id)) {
            global $conn;
            $sql = "SELECT * FROM `review` WHERE `user_id` = ?";
            $query = $conn->prepare($sql);
            $query->bind_param('i', $user_id);
            $query->execute();
            $result = $query->get_result();
            $result = $result->fetch_assoc(); 
            return $result;
        }
    }

    //UPDATE
    public function updateReview(int $review_id): array
    {
        $reviewText = (string)$_POST['reviewText'];
        global $conn;
        if (strlen($reviewText) < 501) {
            if (is_int($review_id)) {
                global $conn;
                $review_id = (int)$review_id;
                if (isset($_POST['submit_setreview'])) {
                    $sql = "UPDATE `review` SET `review_text`= ? WHERE `review_id` = ?";
                    $query = $conn->prepare($sql);
                    $query->bind_param('si', $reviewText, $user_id);
                    $query->execute();   
                    $result = $query->get_result();
                    $result = $result->fetch_assoc(); 
                    return $result;     
                } 
            }
        } else {
            echo "Review is too long. Length must be less than 500 characters.<br>";
        }
    }

    //DELETE
    public function deleteReview(int $review_id)
    {
        if (isset($_POST['delete_submit'])) {
            $review_id = (int)$_GET['delete_review'];
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
    }
}
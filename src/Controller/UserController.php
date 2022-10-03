<?php
namespace Itechart\InternshipProject\Controller;

session_start();

use Exception;
use Itechart\InternshipProject\View\UserView;
use Itechart\InternshipProject\Model\UserModel;
use Itechart\InternshipProject\Model\OrderModel;
use Itechart\InternshipProject\Model\ReviewModel;
use Itechart\InternshipProject\Controller\BasicController;

class UserController extends BasicController
{
    public $userModel;
    public $userView;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userView = new UserView();
    }

    public function sendUser()
    {
        if(!$_SESSION['user']) {
            return $this->userView->sendUser();
		} else {
            echo "You're already authorized! Log out.";
        }
    }

    public function setUser()
    {
        if(!$_SESSION['user']) {
            if (isset($_POST['submit_reg_user'])) {
                if (preg_match("/^[a-zA-z](?=.*\d)[a-zA-z\d]{8,}$/", $_POST['user_password'])) {
                    if (preg_match("/([a-z0-9]+\.)*[a-z0-9]+@[a-z0-9]+(\.[a-z0-9]+)*\.[a-z]{2,4}$/", trim((string)$_POST['user_email']))) {
                        if (preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/", trim((string)$_POST['user_birthday']))) {
                            $format = 'Y-m-d';
                            $user_birthday = DateTimeImmutable::createFromFormat($format, trim((string)$_POST['user_birthday']));   
                            if ($user_birthday->format($format) === trim((string)$_POST['user_birthday'])) {
                                if (preg_match("/(\+375)[\(](29|33|25|44)[\)](\d{3})-(\d{2})-(\d{2})$/", trim((string)$_POST['user_phone']))) {
                                    $user_surname = trim((string)$_POST['user_surname']);
                                    $user_name = trim((string)$_POST['user_name']);
                                    $user_phone = trim((string)$_POST['user_phone']);
                                    $user_address = trim((string)$_POST['user_address']);
                                    $user_email = trim((string)$_POST['user_email']);
                                    $user_password = hash('md5', (string)$_POST['user_password']);
                                    $result = $this->userModel->setUser($user_surname, $user_name, $user_birthday, $user_phone, $user_address, $user_email, $user_password);
                                    return $this->userView->setUser($result);
                                } else {
                                    echo "Phone number should be in format '+375(29/33/..)111-11-11'.";
                                } 
                            } else {
                                echo "Birthday does not follow the Gregorian calendar.";
                            }
                        } else {
                            echo "Birthday should be in format 'YYYY-MM-DD'.";
                        }
                    } else {
                        echo "Your email looks invalid.";
                    } 
                } else {
                    echo "Password length must be at least 8 characters. It should start with a letter and contain at least 1 number.";
                }   
            } 
		} else {
            echo "You're already authorized! Log out.";
        }
        
    }

    public function authUser()
    {
        if(!$_SESSION['user']) {
            return $this->userView->authUser();
		} else {
            echo "You're already authorized! Log out.";
        }
    }

    public function checkUser()
    {
        if(!$_SESSION['user']) {
            global $BASEPATH;
            $user_login = trim($_POST['user_email']);
            $user_pass = trim($_POST['user_password']);
            $user = $this->userModel->auth($user_login, $user_pass);
            $_SESSION['user'] = array (
                'id'=> $user[0]['user_id'],
                'name'=> $user[0]['user_name'],
            );
            if ($user[0]['user_role'] == 1) {
                $_SESSION['user']['role'] = "User";
            }
            if ($user[0]['user_role'] == 2) {
                $_SESSION['user']['role'] = "Admin";
            }
            return header('Location: '.BASEPATH.'profile/'.$user[0]['user_id']);
		} else {
            echo "You're already authorized! Log out.";
        }
    }

    public function getUserInfo(int $user_id)
    {
        if(!$_SESSION['user']) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            if ($_SESSION['user']['role'] === "Admin") {
                $user = $this->userModel->getUserInfo($_SESSION['user']['id']);
                return $this->userView->renderAdminPage($user);
            } else {
                $user = $this->userModel->getUserInfo($_SESSION['user']['id']);
                return $this->userView->renderUserPage($user);
            }
        } else {
            header("Location: /");
        }
    }

    public function getUserReviews(int $user_id)
    {
        if(!$_SESSION['user']) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            if ($_SESSION['user']['role'] === "Admin") {
                echo "YOU ARE ADMIN";
                $reviews = (new ReviewModel())->getReviews();
                return $this->userView->renderAdminReviewsPage($reviews);
            } else {
                $reviews = (new ReviewModel())->getReviewsByUserId($_SESSION['user']['id']);
                return $this->userView->renderUserReviewsPage($reviews, $_SESSION['user']['id']);
            }    
        } else {
            header("Location: /");
        }
    }

    public function setReview(int $user_id)
    {
        if(!$_SESSION['user']) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            global $BASEPATH;
            if (!empty($_POST['submit_set_review'])) {
                $reviewText = (string)$_POST['reviewText'];
                echo $reviewText."<br>".$_SESSION['user']['id'];
                $new_review = (new ReviewModel())->setReview($_SESSION['user']['id'], $reviewText);
                return header('Location: '.BASEPATH.'profile/'.$_SESSION['user']['id'].'/reviews');
            }
        } else {
            header("Location: /");
        }
    }

    public function editReviewText(int $user_id)
    {
        if(!$_SESSION['user']) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            global $BASEPATH;
            if (!empty($_POST['submit_update_review_text'])) {
                $review_id = (int)$_POST['id_review'];
                $review_text = (string)$_POST['newReviewText'];
                $updated_review = (new ReviewModel())->updateReview($review_id, $review_text);
                return header('Location: '.BASEPATH.'profile/'.$_SESSION['user']['id'].'/reviews');
            }
        } else {
            header("Location: /");
        }
    }

    public function deleteReview(int $user_id)
    {
        if(!$_SESSION['user']) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            global $BASEPATH;
            if (!empty($_POST['submit_delete_review'])) {
                $review_id = (int)$_POST['id_review_delete'];
                $result = (new ReviewModel())->deleteReview($review_id);
                return header('Location: '.BASEPATH.'profile/'.$_SESSION['user']['id'].'/reviews');
            }
        } else {
            header("Location: /");
        }
    }

    public function getUserOrders(int $user_id)
    {
        if(!$_SESSION['user']) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            if ($_SESSION['user']['role'] === "Admin") {
                echo "YOU ARE ADMIN";
                $orders = (new OrderModel())->getOrders();
                $order_details = (new OrderModel())->getOrdersDetails();
                return $this->userView->renderAdminOrdersPage($orders, $order_details);
            } else {
                //echo "YOU ARE NOT ADMIN";
                $orders = (new OrderModel())->getOrdersByUserId($_SESSION['user']['id']);
                $order_details = (new OrderModel())->getOrderDetails($_SESSION['user']['id']);
                return $this->userView->renderUserOrdersPage($orders, $order_details, $_SESSION['user']['id']);
            }
        } else {
            header("Location: /");
        }
    }

    public function addNewAdmin(int $user_id) 
    {
        if(!$_SESSION['user']) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            if ($_SESSION['user']['role'] === "Admin") {
                if (!empty($_POST['submit_reg_admin'])) {
                    if (strlen($_POST['admin_password']) < 9) {
                        $user_surname = (string)$_POST['admin_surname'];
                        $user_name = (string)$_POST['admin_name'];
                        $user_birthday = (string)$_POST['admin_birthday'];
                        $user_phone = (string)$_POST['admin_phone'];
                        $user_address = (string)$_POST['admin_address'];
                        $user_email = (string)$_POST['admin_email'];
                        $user_password = hash('md5', (string)$_POST['user_password']);
                        $values = array ($user_surname, $user_name, $user_birthday, $user_phone, $user_address, $user_email, $user_password, "2");
                        $result = $this->userModel->setAdmin($values);
                        return header('Location: '.BASEPATH.'profile/'.$_SESSION['user']['id']);
                    } else {
                        echo "Password length should be not less than 9 characters.";
                    }   
                }
            } else {
                header("Location: /");
            }
        } else {
            header("Location: /");
        } 
    }  
        
    public function updateUser(int $user_id) 
    {
        if(!$_SESSION['user']) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            global $BASEPATH;
            $field = array();
            $value = array();
            $types = "";
            if (!empty($_POST['submit_update_user'])) {
                if (!empty($_POST['new_surname'])) {
                    $new_surname = (string)$_POST['new_surname'];
                    array_push($field, "user_surname");
                    array_push($value, $new_surname);
                    $types.="s";
                }
                if (!empty($_POST['new_name'])) {
                    $new_name = (string)$_POST['new_name'];
                    array_push($field, "user_name");
                    array_push($value, $new_name);
                    $types.="s";
                }
                if (!empty($_POST['new_birthday'])) {
                    $new_birthday = (string)$_POST['new_birthday'];
                    array_push($field, "user_birthday");
                    array_push($value, $new_birthday);
                    $types.="s";
                }
                if (!empty($_POST['new_phone'])) {
                    $new_phone = (string)$_POST['new_phone'];
                    array_push($field, "user_phone");
                    array_push($value, $new_phone);
                    $types.="s";
                }
                if (!empty($_POST['new_address'])) {
                    $new_address = (string)$_POST['new_address'];
                    array_push($field, "user_address");
                    array_push($value, $new_address);
                    $types.="s";
                }
                if (!empty($_POST['new_email'])) {
                    $new_email = (string)$_POST['new_email'];
                    array_push($field, "user_email");
                    array_push($value, $new_email);
                    $types.="s";
                }
                if (!empty($value)) {
                    $user = $this->userModel->updateUser($field, $_SESSION['user']['id'], $value, $types);
                    return header('Location: '.BASEPATH.'profile/'.$_SESSION['user']['id']);
                }     
            }
        } else {
            header("Location: /");
        }   
    }
        
    public function updateUserPass(int $user_id) 
    {
        if(!$_SESSION['user']) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            global $BASEPATH;
            $field = array();
            $value = array();
            $types = "";
            if (!empty($_POST['submit_update_pass'])) {
                $user_password = (string)$_POST['user_pass'];
                $user_checkpass = (string)$_POST['user_pass_check'];
                if ($user_password === $user_checkpass) {
                    array_push($field, "user_password");
                    $user_password = hash('md5', $user_password);
                    array_push($value, $user_password);
                    $types.="s";
                    if (!empty($value)) {
                        $user = $this->userModel->updateUser($field, $_SESSION['user']['id'], $value, $types);
                        return header('Location: '.BASEPATH.'profile/'.$_SESSION['user']['id']);
                    }  
                } else {
                    echo "Passwords don't match";
                }
            }
        }  else {
            header("Location: /");
        } 
    }
    
    public function deleteUser(int $user_id)
    {
        if(!$_SESSION['user']) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            if (!empty($_POST['submit_delete_user'])) {
                $result=$this->userModel->deleteUser($_SESSION['user']['id']);
                session_destroy();
                return $this->userView->renderUserDeletedPage($result, $user_id);
            }
        } else {
            header("Location: /");
        } 
    }
}
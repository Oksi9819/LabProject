<?php
namespace Itechart\InternshipProject\Controller;

use Exception;
use Itechart\InternshipProject\View\UserView;
use Itechart\InternshipProject\Model\UserModel;
use Itechart\InternshipProject\Model\OrderModel;
use Itechart\InternshipProject\Model\ReviewModel;
use Itechart\InternshipProject\Controller\BasicController;
use DateTimeImmutable;
use Itechart\InternshipProject\Model\CategoryModel;

class UserController extends BasicController
{
    public $userModel;
    public $userView;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $categories = (new CategoryModel())->getCategories();
    }

    public function sendUser()
    {
        if(!isset($_SESSION['user'])) {
            return $this->userView->sendUser();
		} else {
            return $this->userView->errorView("You're already authorized! Log out.");
        }
    }

    public function setUser()
    {
        if(!isset($_SESSION['user'])) {
            if (!empty($_POST['submit_reg_user'])) {
                if (preg_match("/^[a-zA-z]{1}(?=.*\d)[a-zA-z\d]{7,}$/", trim((string)$_POST['user_password']))) {
                    $user_surname = trim((string)$_POST['user_surname']);
                    $user_name = trim((string)$_POST['user_name']);
                    $user_phone = trim((string)$_POST['user_phone']);
                    $user_birthday = trim((string)$_POST['user_birthday']);
                    $user_address = trim((string)$_POST['user_address']);
                    $user_email = trim((string)$_POST['user_email']);
                    $user_password = hash('md5', (string)$_POST['user_password']);
                    try {
                        $setUser = $this->userModel->setUser($user_surname, $user_name, $user_birthday, $user_phone, $user_address, $user_email, $user_password);
                        $user = $this->userModel->getUserInfoByEmail($user_email);
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
                    } catch (Exception $e) {
                        return $this->userView->errorView($e->getMessage());
                    }  
                }else {
                    return $this->userView->errorView("Password length must be at least 8 characters. It should start with a letter and contain at least 1 number.");
                }
            } 
		} else {
            return $this->userView->errorView("You're already authorized! Log out.");
        }
    }

    public function authUser()
    {
        if(!isset($_SESSION['user'])) {
            return $this->userView->authUser();
		} else {
            return $this->userView->errorView("You're already authorized! Log out.");
        }
    }

    public function checkUser()
    {
        if(!isset($_SESSION['user'])) {
            global $BASEPATH;
            $user_login = trim($_POST['user_email']);
            $user_pass = trim($_POST['user_password']);
            try {
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
            } catch (Exception $e) {
                return $this->userView->errorView($e->getMessage());
            }
		} else {
            return $this->userView->errorView("You're already authorized! Log out.");
        }
    }

    public function getUserInfo(int $user_id)
    {
        if(!isset($_SESSION['user'])) {
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
        if(!isset($_SESSION['user'])) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            if ($_SESSION['user']['role'] === "Admin") {
                echo "YOU ARE ADMIN";
                try {
                    $reviews = (new ReviewModel())->getReviews();
                    return $this->userView->renderAdminReviewsPage($reviews);
                } catch (Exception $e) {
                    return $this->userView->errorView($e->getMessage());
                }
            } else {
                try {
                    $reviews = (new ReviewModel())->getReviewsByUserId($_SESSION['user']['id']);
                    return $this->userView->renderUserReviewsPage($reviews);
                } catch (Exception $e) {
                    return $this->userView->errorView($e->getMessage());
                }
            }    
        } else {
            header("Location: /");
        }
    }

    public function setReview(int $user_id)
    {
        if(!isset($_SESSION['user'])) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            global $BASEPATH;
            if (!empty($_POST['submit_set_review'])) {
                $reviewText = (string)$_POST['reviewText'];
                try {
                    $new_review = (new ReviewModel())->setReview($_SESSION['user']['id'], $reviewText);
                    return header('Location: '.BASEPATH.'profile/'.$_SESSION['user']['id'].'/reviews');
                } catch (Exception $e) {
                    return $this->userView->errorView($e->getMessage());
                }   
            }
        } else {
            header("Location: /");
        }
    }

    public function editReviewText(int $user_id)
    {
        if(!isset($_SESSION['user'])) {
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
        if(!isset($_SESSION['user'])) {
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
        if(!isset($_SESSION['user'])) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            if ($_SESSION['user']['role'] === "Admin") {
                echo "YOU ARE ADMIN";
                try {  
                    $orders = (new OrderModel())->getOrders();
                    $order_details = (new OrderModel())->getOrdersDetails();
                    return $this->userView->renderAdminOrdersPage($orders, $order_details);
                } catch (Exception $e) {
                    return $this->userView->errorView($e->getMessage());
                }
            } else {
                echo "YOU ARE NOT ADMIN";
                try {
                    $orders = (new OrderModel())->getOrdersByUserId($_SESSION['user']['id']);
                    $order_details = (new OrderModel())->getOrderDetails($_SESSION['user']['id']);
                    return $this->userView->renderUserOrdersPage($orders, $order_details, $_SESSION['user']['id']);
                } catch (Exception $e) {
                    return $this->userView->errorView($e->getMessage());
                }
            }
        } else {
            header("Location: /");
        }
    }

    public function getUsers(int $user_id)
    {
        if(!isset($_SESSION['user'])) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            if ($_SESSION['user']['role'] === "Admin") {
                echo "YOU ARE ADMIN";
                try {  
                    $fields = "u.user_id, u.user_name, u.user_surname, u.user_birthday, u.user_phone, u.user_address, u.user_email, u.created_at, u.updated_at";
                    $ifvalue = "User";
                    $users = $this->userModel->getUsers($fields, $ifvalue);
                    return $this->userView->renderAdminUsersPage($users);
                } catch (Exception $e) {
                    return $this->userView->errorView($e->getMessage());
                }
            } else {
                header("Location: /");
            }
        } else {
            header("Location: /");
        }
    }

    public function getAdmins(int $user_id)
    {
        if(!isset($_SESSION['user'])) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            if ($_SESSION['user']['role'] === "Admin") {
                echo "YOU ARE ADMIN";
                try {  
                    $fields = "u.user_id, u.user_name, u.user_surname, u.user_birthday, u.user_phone, u.user_address, u.user_email, u.created_at, u.updated_at";
                    $ifvalue = "Admin";
                    $admins = $this->userModel->getUsers($fields, $ifvalue);
                    return $this->userView->renderAdminUsersPage($admins);
                } catch (Exception $e) {
                    return $this->userView->errorView($e->getMessage());
                }
            } else {
                header("Location: /");
            }
        } else {
            header("Location: /");
        }
    }

    public function addNewAdmin(int $user_id) 
    {
        if(!isset($_SESSION['user'])) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            if ($_SESSION['user']['role'] == "Admin") {
                if (!empty($_POST['submit_reg_admin'])) {
                    echo "OKAY";
                    if (preg_match("/^[a-zA-z](?=.*\d)[a-zA-z\d]{8,}$/", (string)$_POST['admin_password']) < 9) {
                        $user_surname = (string)$_POST['admin_surname'];
                        $user_name = (string)$_POST['admin_name'];
                        $user_birthday = (string)$_POST['admin_birthday'];
                        $user_phone = (string)$_POST['admin_phone'];
                        $user_address = (string)$_POST['admin_address'];
                        $user_email = (string)$_POST['admin_email'];
                        $user_password = hash('md5', (string)$_POST['admin_password']);
                        try {
                            $result = $this->userModel->setAdmin($user_surname, $user_name, $user_birthday, $user_phone, $user_address, $user_email, $user_password);
                            return header('Location: '.BASEPATH.'profile/'.$_SESSION['user']['id']); 
                        } catch (Exception $e) {
                            return $this->userView->errorView($e->getMessage());
                        }
                    } else {
                        return $this->userView->errorView("Password length must be at least 8 characters. It should start with a letter and contain at least 1 number.");
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
        if(!isset($_SESSION['user'])) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            global $BASEPATH;
            $field = array();
            $value = array();
            $types = "";
            if (!empty($_POST['submit_update_user'])) {
                if (!empty($_POST['new_surname'])) {
                    $new_surname = trim((string)$_POST['new_surname']);
                    array_push($field, "user_surname");
                    array_push($value, $new_surname);
                    $types.="s";
                }
                if (!empty($_POST['new_name'])) {
                    $new_name = trim((string)$_POST['new_name']);
                    array_push($field, "user_name");
                    array_push($value, $new_name);
                    $types.="s";
                }
                if (!empty($_POST['new_birthday'])) {
                    $new_birthday = trim((string)$_POST['new_birthday']);
                    if (preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/", $new_birthday)) {
                        $format = 'Y-m-d';
                        $user_bday = DateTimeImmutable::createFromFormat($format, $new_birthday);   
                        if ($user_bday->format($format) === $new_birthday) {
                            array_push($field, "user_birthday");
                            array_push($value, $new_birthday);
                            $types.="s";
                        } else {
                            return $this->userView->errorView("Birthday does not follow the Gregorian calendar.");
                        }
                    } else {
                        return $this->userView->errorView("Birthday should be in format 'YYYY-MM-DD'.");
                    }
                }
                if (!empty($_POST['new_phone'])) {
                    $new_phone = trim((string)$_POST['new_phone']);
                    if (preg_match("/(\+375)[\(](29|33|25|44)[\)](\d{3})-(\d{2})-(\d{2})$/", $new_phone)) {
                        array_push($field, "user_phone");
                        array_push($value, $new_phone);
                        $types.="s";
                    } else {
                        return $this->userView->errorView("Phone number should be in format '+375(29/33/..)111-11-11'.");
                    }
                }
                if (!empty($_POST['new_address'])) {
                    $new_address = trim((string)$_POST['new_address']);
                    array_push($field, "user_address");
                    array_push($value, $new_address);
                    $types.="s";
                }
                if (!empty($_POST['new_email'])) {
                    $new_email = trim((string)$_POST['new_email']);
                    if (preg_match("/([a-z0-9]+\.)*[a-z0-9]+@[a-z0-9]+(\.[a-z0-9]+)*\.[a-z]{2,4}$/", $user_email)) {
                        array_push($field, "user_email");
                        array_push($value, $new_email);
                        $types.="s";
                    } else {
                        return $this->userView->errorView("Your email looks invalid.");
                    }
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
        if(!isset($_SESSION['user'])) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            global $BASEPATH;
            $field = array();
            $value = array();
            $types = "";
            if (!empty($_POST['submit_update_pass'])) {
                if (preg_match("/^[a-zA-z](?=.*\d)[a-zA-z\d]{8,}$/", (string)$_POST['user_pass']) && preg_match("/^[a-zA-z](?=.*\d)[a-zA-z\d]{8,}$/", (string)$_POST['user_pass_check'])) {
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
                        return $this->userView->errorView("Passwords don't match.");
                    }
                } else {
                    return $this->userView->errorView("Password length must be at least 8 characters. It should start with a letter and contain at least 1 number.");
                }
            }
        }  else {
            header("Location: /");
        } 
    }
    
    //DELETE
    public function exit(int $user_id)
    {
        if(!isset($_SESSION['user'])) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            session_destroy();
            return header('Location: '.BASEPATH);
        } else {
            header("Location: /");
        }
    }

    public function deleteUser(int $user_id)
    {
        if(!isset($_SESSION['user'])) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            if (!empty($_POST['submit_delete_user'])) {
                $result=$this->userModel->deleteUser($_SESSION['user']['id']);
                session_destroy();
                $_SESSION['response'] = array (
                    'deleted_user'=> $user_id,
                );
                return $this->userView->renderUserDeletedPage($user_id);
            }
        } else {
            header("Location: /");
        } 
    }
}
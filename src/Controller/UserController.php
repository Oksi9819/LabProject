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
        $this->userView = new UserView();
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
                if (preg_match("/^[a-zA-z]{1}(?=.*\d)[a-zA-z\d]{7,}$/", trim((string)$_POST['user_password']))) {
                    $user_surname = trim(htmlspecialchars($_POST['user_surname'], ENT_QUOTES));
                    $user_name = trim(htmlspecialchars($_POST['user_name'], ENT_QUOTES));
                    $user_phone = trim(htmlspecialchars($_POST['user_phone'], ENT_QUOTES));
                    $user_birthday = trim(htmlspecialchars($_POST['user_birthday'], ENT_QUOTES));
                    $user_address = trim(htmlspecialchars($_POST['user_address'], ENT_QUOTES));
                    $user_email = trim(htmlspecialchars($_POST['user_email'], ENT_QUOTES));
                    $user_password = hash('md5', htmlspecialchars($_POST['user_password'], ENT_QUOTES));
                    try {
                        $setUser = $this->userModel->setUser($user_surname, $user_name, $user_birthday, $user_phone, $user_address, $user_email, $user_password);
                        $user = $this->userModel->getUserInfoByEmail($user_email);
                        $_SESSION['user'] = [
                            'id' => $user[0]['user_id'],
                            'name' => $user[0]['user_name'],
                        ];
                        $_SESSION['user']['role'] = $user[0]['user_role'] == 1 ? "User" : "Admin";
                        $new_location = 'profile/' . $user[0]['user_id'];
                        echo json_encode(array('result' => 'Success', 'location' => $new_location));
                        return;
                    } catch (Exception $e) {
                        echo json_encode(array('result' => ($e->getMessage())));
                        return;
                    }  
                }else {
                    echo json_encode(array('result' => 'Password length must be at least 8 characters. It should start with a letter and contain at least 1 number.'));
                    return;
                }
		} else {
            echo json_encode(array('result' => "You're already authorized! Log out."));
            return;
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
            $user_login = trim(htmlspecialchars($_POST['user_email'], ENT_QUOTES));
            $user_pass = trim(htmlspecialchars($_POST['user_password'], ENT_QUOTES));
            // var_dump(1);
            try {
                $user = $this->userModel->auth($user_login, $user_pass);
                $_SESSION['user'] = [
                    'id' => $user[0]['user_id'],
                    'name' => $user[0]['user_name'],
                ];
                $_SESSION['user']['role'] = $user[0]['user_role'] == 1 ? "User" : "Admin";
                $new_location = 'profile/' . $user[0]['user_id'];
                echo json_encode(array(
                    'result' => 'Success', 
                    'location' => $new_location,
                ));
                return;
            } catch (Exception $e) {
                echo json_encode(array('result' => ($e->getMessage())));
                return;
            }
		} else {
            echo json_encode(array('result' => 'You\'re already authorized! Log out.'));
            return;
        }
    }

    public function getUserInfo(int $user_id)
    {
        if(!isset($_SESSION['user'])) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            $user = $this->userModel->getUserInfo($_SESSION['user']['id']);
            if ($_SESSION['user']['role'] == "Admin") {
                return $this->userView->renderAdminPage($user);
            } else {
                return $this->userView->renderUserPage($user);
            }
        } else {
            header("Location: /");
        }
    }

    //Reviews
    public function getUserReviews(int $user_id)
    {
        if(!isset($_SESSION['user'])) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            if ($_SESSION['user']['role'] === "Admin") {
                try {
                    return $this->userView->renderAdminReviewsPage((new ReviewModel())->getReviews());
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
            if (!empty($_POST['submit_set_review'])) {
                $reviewText = htmlspecialchars($_POST['reviewText'], ENT_QUOTES);
                try {
                    (new ReviewModel())->setReview($_SESSION['user']['id'], $reviewText);
                    return header('Location: ' . BASEPATH . 'profile/' . $_SESSION['user']['id'] . '/reviews');
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
            if (!empty($_POST['submit_update_review_text'])) {
                $review_id = (int)(htmlspecialchars($_POST['id_review'], ENT_QUOTES));
                $review_text = htmlspecialchars($_POST['newReviewText'], ENT_QUOTES);
                (new ReviewModel())->updateReview($review_id, $review_text);
                return header('Location: ' . BASEPATH . 'profile/' . $_SESSION['user']['id'] . '/reviews');
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
            if (!empty($_POST['submit_delete_review'])) {
                $review_id = (int)(htmlspecialchars($_POST['id_review_delete'], ENT_QUOTES));
                (new ReviewModel())->deleteReview($review_id);
                return header('Location: ' . BASEPATH . 'profile/' . $_SESSION['user']['id'] . '/reviews');
            }
        } else {
            header("Location: /");
        }
    }

    //Orders
    public function getUserOrders(int $user_id)
    {
        if(!isset($_SESSION['user'])) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            if ($_SESSION['user']['role'] === "Admin") {
                try {  
                    $orders = (new OrderModel())->getOrders();
                    $statuses = (new OrderModel())->getOrderStatuses();
                    $order_details = (new OrderModel())->getOrdersDetailsByAdmin();
                    return $this->userView->renderAdminOrdersPage($orders, $order_details, $statuses);
                } catch (Exception $e) {
                    return $this->userView->errorView($e->getMessage());
                }
            } else {
                try {
                    $orders = (new OrderModel())->getOrdersByUserId($_SESSION['user']['id']);
                    $order_details = (new OrderModel())->getOrdersDetailsByUser($_SESSION['user']['id']);
                    return $this->userView->renderUserOrdersPage($orders, $order_details, $_SESSION['user']['id']);
                } catch (Exception $e) {
                    return $this->userView->errorView($e->getMessage());
                }
            }
        } else {
            header("Location: /");
        }
    }

    public function setOrder(int $user_id)
    {
        if(!isset($_SESSION['user'])) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            if (!empty($_POST['submit_set_order']) && !empty($_POST['order_address'])) {
                $order_adress = trim(htmlspecialchars($_POST['order_address'], ENT_QUOTES));
                $new_order = (new OrderModel())->setOrder($order_adress, $_SESSION['user']['id']);
                if (isset($_SESSION['response'])) {
                    unset ($_SESSION['response']);
                } 
                $_SESSION['response']['new_order'] = $new_order;
                return header('Location: ' . BASEPATH . 'profile/' . $_SESSION['user']['id'] . '/orders');   
            }
        } else {
            header("Location: /");
        }
    }

    public function editOrderAddress(int $user_id, int $order_id)
    {
        if(!isset($_SESSION['user'])) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            if (!empty($_POST['submit_new_order_address']) && (int)$order_id) {
                $new_address = htmlspecialchars($_POST['new_order_address'], ENT_QUOTES);
                (new OrderModel())->updateOrderAddress($order_id, $new_address);
                if (isset($_SESSION['response'])) {
                    unset ($_SESSION['response']);
                } 
                $_SESSION['response']['new_order_address'] = [
                    ['order_id'] => $order_id,
                    ['new_address'] => $new_address
                ];
                return header('Location: ' . BASEPATH . 'profile/' . $_SESSION['user']['id'] . '/orders');
            }
        } else {
            header("Location: /");
        }
    }

    public function editOrderStatus(int $user_id, int $order_id)
    {
        if(!isset($_SESSION['user'])) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            if($_SESSION['user']['role'] === "Admin") {
                if (!empty($_POST['submit_new_order_status'])) {
                    $new_status = (int)(htmlspecialchars($_POST['new_order_status'], ENT_QUOTES));
                    (new OrderModel())->updateOrderStatus((int)$order_id, $new_status);
                    if (isset($_SESSION['response'])) {
                        unset ($_SESSION['response']);
                    } 
                    $_SESSION['response']['new_status']['order_id'] = $order_id;
                    return header('Location: ' . BASEPATH . 'profile/' . $_SESSION['user']['id'] . '/orders');
                }
            } else {
                header("Location: /");
            }
        } else {
            header("Location: /");
        }
    }

    public function cancelOrder(int $user_id, int $order_id)
    {
        if(!isset($_SESSION['user'])) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            if (!empty($_POST['submit_cancel_order'])) {
                (new OrderModel())->cancelOrder($order_id);
                if (isset($_SESSION['response'])) {
                    unset ($_SESSION['response']);
                } 
                $_SESSION['response']['canceled_order'] = $order_id;
                return header('Location: ' . BASEPATH . 'profile/' . $_SESSION['user']['id'] . '/orders');
            }
        } else {
            header("Location: /");
        }
    }

    //Admin get users
    public function getUsers(int $user_id)
    {
        if(!isset($_SESSION['user'])) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            if ($_SESSION['user']['role'] === "Admin") {
                try {  
                    $fields = "u.user_id, u.user_name, u.user_surname, u.user_birthday, u.user_phone, u.user_address, u.user_email, u.created_at, u.updated_at";
                    $ifvalue = "User";
                    return $this->userView->renderAdminUsersPage($this->userModel->getUsers($fields, $ifvalue));
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
                try {  
                    $fields = "u.user_id, u.user_name, u.user_surname, u.user_birthday, u.user_phone, u.user_address, u.user_email, u.created_at, u.updated_at";
                    $ifvalue = "Admin";
                    return $this->userView->renderAdminUsersPage($this->userModel->getUsers($fields, $ifvalue));
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
                    if (preg_match("/^[a-zA-z](?=.*\d)[a-zA-z\d]{8,}$/", (string)$_POST['admin_password']) < 9) {
                        $user_surname = htmlspecialchars($_POST['admin_surname'], ENT_QUOTES);
                        $user_name = htmlspecialchars($_POST['admin_name'], ENT_QUOTES);
                        $user_birthday = htmlspecialchars($_POST['admin_birthday'], ENT_QUOTES);
                        $user_phone = htmlspecialchars($_POST['admin_phone'], ENT_QUOTES);
                        $user_address = htmlspecialchars($_POST['admin_address'], ENT_QUOTES);
                        $user_email = htmlspecialchars($_POST['admin_email'], ENT_QUOTES);
                        $user_password = hash('md5', htmlspecialchars($_POST['admin_password'], ENT_QUOTES));
                        try {
                            $this->userModel->setAdmin($user_surname, $user_name, $user_birthday, $user_phone, $user_address, $user_email, $user_password);
                            return header('Location: ' . BASEPATH . 'profile/' . $_SESSION['user']['id']); 
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
        // var_dump(1);
        if(!isset($_SESSION['user'])) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            // var_dump(2);
            $field = array();
            $value = array();
            $updated = [0, 0, 0, 0, 0, 0];
            $types = "";
                if (!empty($_POST['new_surname'])) {
                    $new_surname = trim(htmlspecialchars($_POST['new_surname'], ENT_QUOTES));
                    array_push($field, "user_surname");
                    array_push($value, $new_surname);
                    $types .= "s";
                    $updated[0] = 1;
                }
                if (!empty($_POST['new_name'])) {
                    $new_name = trim(htmlspecialchars($_POST['new_name'], ENT_QUOTES));
                    array_push($field, "user_name");
                    array_push($value, $new_name);
                    $types .= "s";
                    $updated[1] = 1;
                }
                if (!empty($_POST['new_birthday'])) {
                    $new_birthday = trim(htmlspecialchars($_POST['new_birthday'], ENT_QUOTES));
                    if (preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/", $new_birthday)) {
                        $format = 'Y-m-d';
                        $user_bday = DateTimeImmutable::createFromFormat($format, $new_birthday);   
                        if ($user_bday->format($format) === $new_birthday) {
                            array_push($field, "user_birthday");
                            array_push($value, $new_birthday);
                            $types .= "s";
                            $updated[2] = 1;
                        } else {
                            echo json_encode(array('result' => 'Birthday does not follow the Gregorian calendar.'));
                            return;
                        }
                    } else {
                        echo json_encode(array('result' => 'Birthday should be in format \'YYYY-MM-DD\'.'));
                        return;
                    }
                }
                if (!empty($_POST['new_phone'])) {
                    // var_dump(3);
                    $new_phone = trim(htmlspecialchars($_POST['new_phone'], ENT_QUOTES));
                    // var_dump($new_phone);
                    if (preg_match("/(\+375)[\(](29|33|25|44)[\)](\d{3})-(\d{2})-(\d{2})$/", $new_phone)) {
                        array_push($field, "user_phone");
                        array_push($value, $new_phone);
                        $types .= "s";
                        $updated[3] = 1;
                    } else {
                        echo json_encode(array('result' => 'Phone number should be in format \'+375(29/33/..)111-11-11\'.'));
                        return;
                    }
                }
                if (!empty($_POST['new_address'])) {
                    $new_address = trim(htmlspecialchars($_POST['new_address'], ENT_QUOTES));
                    array_push($field, "user_address");
                    array_push($value, $new_address);
                    $types .= "s";
                    $updated[4] = 1;
                }
                if (!empty($_POST['new_email'])) {
                    $new_email = trim(htmlspecialchars($_POST['new_email'], ENT_QUOTES));
                    if (preg_match("/([a-z0-9]+\.)*[a-z0-9]+@[a-z0-9]+(\.[a-z0-9]+)*\.[a-z]{2,4}$/", $user_email)) {
                        array_push($field, "user_email");
                        array_push($value, $new_email);
                        $types .= "s";
                        $updated[5] = 1;
                    } else {
                        echo json_encode(array('result' => 'Your email looks invalid.'));
                        return;
                    }
                }
                if (!empty($value)) {
                    if (!($this->userModel->updateUser($field, $_SESSION['user']['id'], $value, $types))) {
                        echo json_encode(array(
                            'result' => 'Fail',
                            'msg' => 'Failed to update information. Please, try again.',
                        ));
                        return;
                    } else {
                        $output = array();
                        for ($i=0; $i < count($updated); $i++) {
                            if ($updated[$i] === 1) {
                                array_push($output, $i);
                            }
                        }
                        $new_location = '/profile/' . $_SESSION['user']['id'];
                        echo json_encode(array(
                            'result' => 'Success',
                            'values' => $value,
                            'fields' => $output,
                        ));
                        return;
                    }
                }  
        } else {
            echo json_encode(array(
                'result' => 'Fail',
                'location' => '/',
            ));
            return;
        }   
    }
        
    public function updateUserPass(int $user_id) 
    {
        if(!isset($_SESSION['user'])) {
			header("Location: /");
		} elseif ($_SESSION['user']['id'] == $user_id) {
            $field = array();
            $value = array();
            $types = "";
                if (preg_match("/^[a-zA-z]{1}(?=.*\d)[a-zA-z\d]{7,}$/", (string)$_POST['user_pass']) 
                    && preg_match("/^[a-zA-z]{1}(?=.*\d)[a-zA-z\d]{7,}$/", (string)$_POST['user_pass_check'])) {
                    $user_password = htmlspecialchars($_POST['user_pass'], ENT_QUOTES);
                    $user_checkpass = htmlspecialchars($_POST['user_pass_check'], ENT_QUOTES);
                    if ($user_password === $user_checkpass) {
                        array_push($field, "user_password");
                        $user_password = hash('md5', $user_password);
                        array_push($value, $user_password);
                        $types .= "s";
                        if (!empty($value)) {
                            $this->userModel->updateUser($field, $_SESSION['user']['id'], $value, $types);
                            echo json_encode(array('result' => 'Success'));
                            return;
                        }  
                    } else {
                        echo json_encode(array('result' => 'Passwords don\'t match.'));
                        return;
                    }
                } else {
                    echo json_encode(array('result' => 'Password length must be at least 8 characters. It should start with a letter and contain at least 1 number.'));
                    return;
                }
        }  else {
            header("Location: /");
        } 
    }
    
    //DELETE
    public function exit(int $user_id)
    {
        if(isset($_SESSION['user'])) {
			if ($_SESSION['user']['id'] == $user_id) {
                session_destroy();
                return header('Location: ' . BASEPATH);
            } else {
                header("Location: /");
            }
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
                $this->userModel->deleteUser($_SESSION['user']['id']);
                session_destroy();
                $_SESSION['response']['deleted_user'] = $user_id;
                return $this->userView->renderUserDeletedPage($user_id);
            }
        } else {
            header("Location: /");
        } 
    }
}
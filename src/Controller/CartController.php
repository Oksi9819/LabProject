<?php

namespace Itechart\InternshipProject\Controller;

use Itechart\InternshipProject\View\CartView;
use Itechart\InternshipProject\Model\OrderModel;
use Itechart\InternshipProject\Controller\BasicController;

class CartController extends BasicController
{
    public $cartView;

    public function __construct()
    {
        $this->cartView = new CartView();
    }

    public function show()
    {
        return $this->cartView->getCartPage();
    }

    public function order()
    {
        if(!isset($_SESSION['user'])) {
            echo json_encode(array(
                'result' => 'Error',
                'msg' => 'You should authorize first.'
            ));
            return;
		} else {
            $user_id = $_SESSION['user']['id'];
            $cartData = $_POST['itemsArr'];
            $address = htmlspecialchars($_POST['orderAddress'], ENT_QUOTES);
            if (!is_null($cartData)) {
                if ($address === NULL) {
                    echo json_encode(array(
                        'result' => 'Error',
                        'msg' => 'Address does not isset.'
                    ));
                    return;  
                } else {
                    (new OrderModel())->setOrder($address, $user_id, $cartData);
                    echo json_encode(array('result' => 'Success'));
                    return;
                    echo json_encode(array(
                        'result' => 'Success',
                        'msg' => 'Order was successfully sent.'
                    ));
                    return; 
                }
            } else {
                echo json_encode(array(
                    'result' => 'Error',
                    'msg' => 'Cartdata does not isset.'
                ));
                return;
            }
        }
    }
}
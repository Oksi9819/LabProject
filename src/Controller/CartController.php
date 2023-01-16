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
		}
        $cartData = $_POST['itemsArr'];
        if (is_null($cartData)) {
            echo json_encode(array(
                'result' => 'Error',
                'msg' => 'Cartdata does not isset.'
            ));
            return;
        }
        $address = htmlspecialchars($_POST['orderAddress'], ENT_QUOTES);
        if ($address === NULL) {
            echo json_encode(array(
                'result' => 'Error',
                'msg' => 'Address does not isset.'
            ));
            return;  
        }
        $user_id = $_SESSION['user']['id'];
        (new OrderModel())->setOrder($address, $user_id, $cartData);
        echo json_encode(array(
            'result' => 'Success',
            'msg' => 'Order was successfully sent.'
        ));
        return;
    }
}
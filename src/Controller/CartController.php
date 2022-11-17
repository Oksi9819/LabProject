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
        var_dump(3);
        if(!isset($_SESSION['user'])) {
            echo json_encode(array('result' => 'You should authorize first.'));
            return;
		} else {
            $user_id = $_SESSION['user']['id'];
            $cartData = $_POST['itemsArr'];
            $address = $_POST['orderAddress'];
            if (!is_null($cartData)) {
                if (!is_null($address)) {
                    (new OrderModel())->set_order($address, $user_id, $cartData);
                    echo json_encode(array('result' => 'Success'));
                    return;
                } else {
                    echo json_encode(array('result' => 'address does not isset'));
                    return;
                }
            } else {
                echo json_encode(array('result' => 'cartdata does not isset'));
                return;
            }
        }
    }
}
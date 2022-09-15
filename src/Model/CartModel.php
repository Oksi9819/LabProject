<?php

namespace Itechart\InternshipProject\Model;

class CartModel
{
    public function showCart(int $user_id): array
    {
        if ($user_id==2256665) {
            $cartProducts[$user_id]=array("Увлажнитель воздуха Deerma Air Humidifier DEM F628S", "Мультифункциональный пароочиститель Deerma Steam Cleaner DEM-ZQ610", "Умная настольная лампа Yeelight Led Table Lamp", "Умный пульт ДУ Яндекс");
            return $cartProducts[$user_id];
        } else return false;
    }
}


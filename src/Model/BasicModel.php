<?php

namespace Itechart\InternshipProject\Model;

class BasicModel
{
    public function getMainInfo():array
    {
        $info['topic']="ГЛАВНАЯ";
        $info['desc']="ЭТО ГЛАВНАЯ СТРАНИЦА! Заполним ее позже:)";
        return $info;
    }

    public function getDeliveryInfo():array
    {
        $info['topic']="ДОСТАВКА";
        $info['desc']="Осуществляем доставку по всей Беларуси. Бесплатная доставка в пределах МКАД. Стоимость доставки в регионы от 25 BYN*.";
        return $info;
    }

    public function getContactsInfo():array
    {
        $info['topic']="КОНТАКТЫ";
        $info['phone_1']="+375 (29) 111-11-11";
        $info['phone_2']="+375 (29) 222-22-22";
        $info['addres']="г. Минск, пр-т Независимости, 4; 220030, Республика Беларусь.";
        return $info;
    }
}
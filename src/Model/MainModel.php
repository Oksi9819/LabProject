<?php

namespace Itechart\InternshipProject\Model;

use Itechart\InternshipProject\Model\BasicModel;

class MainModel extends BasicModel
{
    public function __construct()
    {
        parent::__construct();
    }

    //CREATE
    public function setContact(string $contact_name, string $contact_email, string $contact_text) : bool
    {
        $to = "oksanaostapuk@gmail.com";
        $subject = "Форма для связи с сайта";
        $msg = "Имя:" . $contact_name . ".\n Текст: " . $contact_text;
        $msg = wordwrap($msg,70);
        $headers = 'From: '.$contact_email."\r\n";
        $headers .= 'Reply-To: '.$contact_email."\r\n";
        if (mail($to, $subject, $msg, $headers)) {
            return true;
        } else {
            return false;
        }
    }

    //READ
    public function getMainInfo() : array
    {
        return $this->getModel("*", "page_info", "page_name", "main", NULL, NULL, NULL, "s");;
    }

    public function getDeliveryInfo(): array
    {
        return $this->getModel("*", "page_info", "page_name", "delivery", NULL, NULL, NULL, "s");
    }

    public function getContactsInfo(): array
    {
        return $this->getModel("*", "page_info", "page_name", "contacts", NULL, NULL, NULL, "s");
    }

    //UPDATE
    public function updatePageInfo(array $fields, string $page_name, array $values, string $types)
    {
        $updated_at = date("Y-m-d h:i:s");
        array_push($fields, 'updated_at');
        array_push($values, $updated_at);
        $types .= "ss";
        $field = implode(", ", $fields);
        return $this->updateModel($field, "page_info", "page_name", $page_name, $values, NULL, $types);     
    }

    //DELETE
    public function deletePage(int $page_id) : string
    {   
        return $this->deleteModelItem("page_info", "page_id", $page_id, NULL, "i");
    }
}
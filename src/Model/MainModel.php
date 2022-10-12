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
    public function setContact(string $contact_name, string $contact_email, string $contact_text) : array
    {
        return [
            'contact_name' => $contact_name,
            'contact_email' => $contact_email,
            'contact_text' => $contact_text
        ];
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
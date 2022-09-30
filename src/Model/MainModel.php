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
    public function setContact(string $contact_name, string $contact_email, string $contact_text): array
    {
        $result = array(
            'contact_name'=>$contact_name,
            'contact_email'=>$contact_email,
            'contact_text'=>$contact_text,
        );
        return $result;
    }

    //READ
    public function getMainInfo(): array
    {
        $result = $this->getModel("*", "page_info", "page_name", "main", NULL, NULL, NULL, "s");
        return $result;
    }

    public function getDeliveryInfo(): array
    {
        $result = $this->getModel("*", "page_info", "page_name", "delivery", NULL, NULL, NULL, "s");
        return $result;
    }

    public function getContactsInfo(): array
    {
        $result = $this->getModel("*", "page_info", "page_name", "contacts", NULL, NULL, NULL, "s");
        return $result;
    }

    //UPDATE
    public function updatePageInfo(array $fields, string $page_name, array $values, string $types)
    {
        $updated_at = date("Y-m-d h:i:s");
        array_push($fields, 'updated_at');
        array_push($value, $updated_at);
        $types.="ss";
        $field = implode(", ", $fields);
        $result = $this->updateModel($field, "page_info", "page_name", $page_name, $values, NULL, $types);
        return $result;           
    }

    //DELETE
    public function deletePage(int $page_id): string
    {   
        $result = $this->deleteModelItem("page_info", "page_id", $page_id, NULL, "i");
        return $result;
    }
}
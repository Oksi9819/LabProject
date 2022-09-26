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
    public function setContact(): array
    {
        if(!empty($_POST['contact_name']) && !empty($_POST['contact_email']) && !empty($_POST['contact_text'])) {
            $result = array(
                'contact_name'=>trim($_POST['contact_name']),
                'contact_email'=>trim($_POST['contact_email']),
                'contact_text'=>trim($_POST['contact_text']),
            );
            return $result;
        }
    }

    //READ
    public function getMainInfo(): array
    {
        $result = parent::getModel("*", "page_info", "page_name", "main", NULL, NULL, NULL, "s");
        return $result;
    }

    public function getDeliveryInfo(): array
    {
        $result = parent::getModel("*", "page_info", "page_name", "delivery", NULL, NULL, NULL, "s");
        return $result;
    }

    public function getContactsInfo(): array
    {
        $result = parent::getModel("*", "page_info", "page_name", "contacts", NULL, NULL, NULL, "s");
        return $result;
    }

    //UPDATE
    public function updatePageInfo(string $fields, string $page_name, array $values, string $types)
    {
        $result = parent::updateModel($fields, "page_info", "page_name", $page_name, $values, NULL, $types);
        return $result;           
    }

    //DELETE
    public function deletePage(int $page_id): string
    {   
        $result = parent::deleteModelItem("page_info", "page_id", $page_id, NULL, "i");
        return $result;
    }
}
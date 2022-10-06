<?php

namespace Itechart\InternshipProject\Controller;

use Itechart\InternshipProject\View\MainView;
use Itechart\InternshipProject\Model\MainModel;
use Itechart\InternshipProject\Model\CategoryModel;
use Itechart\InternshipProject\Controller\BasicController;

class MainController extends BasicController
{
    public $mainModel;
    public $mainView;

    public function __construct()
    {
        $this->mainModel = new MainModel();
        $this->mainView = new MainView();
    }
    
    public function executeMainPage()
    {
        return $this->mainView->getMainPage($this->mainModel->getMainInfo());
    }

    public function executeContactsPage()
    {
        $categories = (new CategoryModel())->getCategories();
        return $this->mainView->getContactsPage($this->mainModel->getContactsInfo(), $categories);
    }

    public function executeDeliveryPage()
    {
        $categories = (new CategoryModel())->getCategories();
        return $this->mainView->getDeliveryPage($this->mainModel->getDeliveryInfo(), $categories);
    }
    
    public function sendContactForm()
    {
        $categories = (new CategoryModel())->getCategories();
        return $this->mainView->sendContactForm($categories);   
    }

    public function showContactForm()
    {
        if(!empty($_POST['contact_name']) && !empty($_POST['contact_email']) && !empty($_POST['contact_text'])) {
            $categories = (new CategoryModel())->getCategories();
            $contact_name = trim($_POST['contact_name']);
            $contact_email = trim($_POST['contact_email']);
            $contact_text = trim($_POST['contact_text']);
            return $this->mainView->showContactForm($this->mainModel->setContact($contact_name, $contact_email, $contact_text), $categories);
        }
    }

    public function editPageInfo()
    {
        $field = array();
        $value = array();
        $types = "";
        if (!empty($_POST['submit_update_page_info'])) {
            $page_name = trim($_POST['page_to_edit']);
            if (!empty($_POST['page_name'])) {
                $page_name = (string)$_POST['page_name'];
                array_push($field, "page_name");
                array_push($value, $page_name);
                $types.="s";
            }
            if (!empty($_POST['topic'])) {
                $topic = (string)$_POST['topic'];
                array_push($field, "topic");
                array_push($value, $topic);
                $types.="s";
            }
            if (!empty($_POST['desc'])) {
                $desc = (float)$_POST['desc'];
                array_push($field, "desc");
                array_push($value, $desc);
                $types.="s";
            }
            if (!empty($_POST['phone_1'])) {
                $phone_1 = (float)$_POST['phone_1'];
                array_push($field, "phone_1");
                array_push($value, $phone_1);
                $types.="s";
            }
            if (!empty($_POST['phone_2'])) {
                $phone_2 = (float)$_POST['phone_2'];
                array_push($field, "phone_2");
                array_push($value, $phone_2);
                $types.="s";
            }
            if (!empty($value)) {
                $categories = (new CategoryModel())->getCategories();
                $new_info = $this->mainModel->updatePageInfo($fields, $page_name, $values, $types);
                return $this->mainView->showContactForm($categories);
            } 
        }
    }

    public function deletePage()
    {
        $categories = (new CategoryModel())->getCategories();
        return $this->mainView->showContactForm($this->mainModel->deletePage($page_id), $categories);
    }
}
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
        return $this->mainView->getContactsPage($this->mainModel->getContactsInfo());
    }

    public function executeDeliveryPage()
    {
        return $this->mainView->getDeliveryPage($this->mainModel->getDeliveryInfo());
    }
    
    public function sendContactForm()
    {
        return $this->mainView->sendContactForm();   
    }

    public function showContactForm()
    {
        // $info = $this->mainModel->getContactsInfo();
        if(empty($_POST['contact_name']) || empty($_POST['contact_email']) || empty($_POST['contact_text'])) {
            echo json_encode(array(
                'result' => 'All fields should be fullfilled'
            ));
            return; 
        }
        $contact_name = htmlspecialchars(trim($_POST['contact_name']), ENT_QUOTES);
        $contact_email = htmlspecialchars(trim($_POST['contact_email']), ENT_QUOTES);
        $contact_text = htmlspecialchars(trim($_POST['contact_text']), ENT_QUOTES);
        try {
            if ($this->mainModel->setContact($contact_name, $contact_email, $contact_text)) {
                echo json_encode(array(
                    'result' => 'Success',
                    'msg' => 'Email was successfully sent:',
                    'name' => $contact_name,
                    'mail' => $contact_email,
                    'text' => $contact_text,
                ));
            } else {
                echo json_encode(array(
                    'result' => 'Failed to send contact form. Please, try again.'
                ));
            }
        } catch (Exception $e) {
            echo json_encode(array(
                'result' => 'Error',
                'msg' => ($e->getMessage()),
            ));
        }
        return;
    }

    public function editPageInfo()
    {
        $field = array();
        $value = array();
        $types = "";
        $page_name = trim($_POST['page_to_edit']);
        if (!empty($_POST['page_name'])) {
            $page_name = (string)$_POST['page_name'];
            array_push($field, "page_name");
            array_push($value, $page_name);
            $types .= "s";
        }
        if (!empty($_POST['topic'])) {
            $topic = (string)$_POST['topic'];
            array_push($field, "topic");
            array_push($value, $topic);
            $types .= "s";
        }
        if (!empty($_POST['desc'])) {
            $desc = (float)$_POST['desc'];
            array_push($field, "desc");
            array_push($value, $desc);
            $types .= "s";
        }
        if (!empty($_POST['phone_1'])) {
            $phone_1 = (float)$_POST['phone_1'];
            array_push($field, "phone_1");
            array_push($value, $phone_1);
            $types .= "s";
        }
        if (!empty($_POST['phone_2'])) {
            $phone_2 = (float)$_POST['phone_2'];
            array_push($field, "phone_2");
            array_push($value, $phone_2);
            $types .= "s";
        }
        if (!empty($value)) {
            $this->mainModel->updatePageInfo($fields, $page_name, $values, $types);
            return header("Location: /");
        }
    }

    public function deletePage()
    {
        return $this->mainView->showContactForm($this->mainModel->deletePage($page_id));
    }
}
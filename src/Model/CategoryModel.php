<?php

namespace Itechart\InternshipProject\Model;

use Exception;
use Itechart\InternshipProject\Model\BasicModel;

class CategoryModel extends BasicModel
{
    public function __construct()
    {
        parent::__construct();
    }

    //CREATE
    public function setCategory(string $new_category,string $new_category_eng)
    {
        $values = array();
        if (strlen($new_category) < 31 && strlen($new_category_eng) < 31) {
            if (!($a = $this->getCategoryByName($new_category_eng))) {
                if ($a['category_name'] !== $new_category) {
                    $created_at = date("Y-m-d h:i:s");
                    array_push($values, $new_category, $new_category_eng, $created_at);
                    return $this->setModel("category", ['category_name', 'name_eng', 'created_at'], "sss", $values);
                } else {
                    throw new Exception("Such category already exists.");
                }
            } else {
                throw new Exception("Such category already exists.");
            } 
        } else {
            throw new Exception("Length of category names should be shorter than 31 characters.");
        }  
    }

    //READ
    public function getCategories() : array
    {
        return $this->getModel("*", "category", NULL, NULL, NULL, NULL, "category_id", NULL);
    }

    public function getCategoryById(int $category_id) : array
    {
        return $this->getModel("*", "category", "category_id", $category_id, NULL, NULL, NULL, "i");
    }

    public function getCategoryByName(string $category_name) : array
    {
        return $this->getModel("*", "category", "name_eng", $category_name, NULL, NULL, NULL, "s");
    }

    //UPDATE
    public function updateCategory(int $category_id, string $new_category, string $new_category_eng) : array
    {
        $values = array();
        if (strlen($new_category) < 31 && strlen($new_category_eng) < 31) {
            if (!($a = $this->getCategoryByName($new_category_eng))) {
                if ($a['category_name'] !== $new_category) {
                    array_push($values, $new_category, $new_category_eng);
                    $created_at = date("Y-m-d h:i:s");
                    array_push($values, $new_category, $new_category_eng, $created_at);
                    return $this->updateModel("category_name, name_eng", "category", "category_id", $category_id, $values, NULL, "ssi");
                } else {
                    throw new Exception("Such category already exists.");
                }
            } else {
                throw new Exception("Such category already exists.");
            }    
        } else {
            throw new Exception("Length of category names should be shorter than 31 characters.");
        }        
    }

    //DELETE
    public function deleteCategory($category_id)
    {   
        return $this->deleteModelItem("category", "category_id", $category_id, NULL, "i");
    }
}
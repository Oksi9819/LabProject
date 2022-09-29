<?php

namespace Itechart\InternshipProject\Model;

use Itechart\InternshipProject\Model\BasicModel;

class CategoryModel extends BasicModel
{
    public function __construct()
    {
        parent::__construct();
    }

    //CREATE
    public function setCategory(string $new_category,string $new_category_eng): array
    {
        $values = array();
        if (strlen($new_category) < 31 && strlen($new_category_eng) < 31) {
            array_push($values, $new_category, $new_category_eng);
            $result = $this->setModel("category", ['category_name', 'name_eng'], "ss", $values);
            return $result;
        } else {
            throw new Exception("Length of category names should be shorter than 31 characters.");
        }  
    }

    //READ
    public function getCategories(): array
    {
        $result = $this->getModel("*", "category", NULL, NULL, NULL, NULL, "category_id", NULL);
        return $result;
    }

    public function getCategoryById(int $category_id): array
    {
        $result = $this->getModel("*", "category", "category_id", $category_id, NULL, NULL, NULL, "i");
        return $result;
    }

    public function getCategoryByName(string $category_name): array
    {
        $result = $this->getModel("*", "category", "name_eng", $category_name, NULL, NULL, NULL, "s");
        return $result;
    }

    //UPDATE
    public function updateCategory(int $category_id, string $new_category, string $new_category_eng): array
    {
        $values = array();
        if (strlen($new_category) < 31 && strlen($new_category_eng) < 31) {
            array_push($values, $new_category, $new_category_eng);
            $result = $this->updateModel("category_name, name_eng", "category", "category_id", $category_id, $values, NULL, "ssi");
            return $result;   
        } else {
            throw new Exception("Length of category names should be shorter than 31 characters.");
        }        
    }

    //DELETE
    public function deleteCategory($category_id)
    {   
        $result = $this->deleteModelItem("category", "category_id", $category_id, NULL, "i");
    }
}
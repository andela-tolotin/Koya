<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 01/02/2016
 * Time: 13:27
 */

namespace Koya\Repositories;


use Koya\Category;

class CategoryRepository
{
    public function __construct(Category $category)
    {
        $this->category = $category;
    }


    public function getAllCategories()
    {
        return $this->category->all();
    }

    public function getCategoryById($category_id)
    {
        return $this->category->find($category_id);
    }

    public function save($data)
    {
        return $this->category->create($data);
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 01/02/2016
 * Time: 13:27.
 */
namespace Koya\Repositories;

use Koya\Category;

class CategoryRepository
{
    /**
     * Loads all dependencies via DI container
     * CategoryRepository constructor.
     *
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Returns all videos categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllCategories()
    {
        return $this->category->all();
    }

    /**
     * Gets a category based on the ID.
     *
     * @param $category_id
     *
     * @return mixed
     */
    public function getCategoryById($category_id)
    {
        return $this->category->find($category_id);
    }

    /**
     * Saves a new category.
     *
     * @param $data
     *
     * @return static
     */
    public function save($data)
    {
        return $this->category->create($data);
    }
}

<?php namespace Visiosoft\CategoriesModule\Category\Command;

use Visiosoft\CategoriesModule\Category\Contract\CategoryRepositoryInterface;

class GetParents
{
    protected $category;

    public function __construct($category)
    {
        $this->category = $category;
    }

    public function handle(CategoryRepositoryInterface $categories)
    {
        $parents = [
            0 => $this->category,
        ];
        $counter = 1;
        $category = $this->category;

        for ($i = 1; $i <= $counter; $i++) {
            if ($category->parent_category_id) {
                $category = $categories->find($category->parent_category_id);
                $parents[$i] = $category;
                $counter++;
            }
        }

        return $parents;
    }
}

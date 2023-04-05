<?php namespace Visiosoft\CategoriesModule\Category\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface CategoryRepositoryInterface extends EntryRepositoryInterface
{
    public function mainCategories();

    public function findBySlug($slug);

    public function getSubCategoriesByID($id);
}

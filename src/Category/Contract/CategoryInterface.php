<?php namespace Visiosoft\CategoriesModule\Category\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

interface CategoryInterface extends EntryInterface
{
    public function getParents();

    public function getSubCategories();
}

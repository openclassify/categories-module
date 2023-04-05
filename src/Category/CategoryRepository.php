<?php namespace Visiosoft\CategoriesModule\Category;

use Visiosoft\CategoriesModule\Category\Contract\CategoryRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class CategoryRepository extends EntryRepository implements CategoryRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var CategoryModel
     */
    protected $model;

    /**
     * Create a new CategoryRepository instance.
     *
     * @param CategoryModel $model
     */
    public function __construct(CategoryModel $model)
    {
        $this->model = $model;
    }

    public function mainCategories()
    {
        return $this->newQuery()->whereNull('parent_category_id')->get();
    }

    public function findBySlug($slug)
    {
        return $this->newQuery()->where('slug', $slug)
            ->first();
    }

    public function getSubCategoriesByID($id)
    {
        return $this->newQuery()
            ->where('parent_category_id',$id)
            ->get();
    }
}

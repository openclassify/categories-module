<?php namespace Visiosoft\CategoryFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Stream\Command\GetStream;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Visiosoft\CategoriesModule\Category\Contract\CategoryRepositoryInterface;

class CategoryFieldType extends FieldType
{

    use DispatchesJobs;

    /**
     * The underlying database column type
     *
     * @var string
     */
    protected $columnType = 'integer';

    /**
     * The input view.
     *
     * @var null|string
     */
    protected $inputView = 'visiosoft.field_type.category::input';

    /**
     * The field type config.
     *
     * @var array
     */
    protected $config = [
        'level' => 5,
    ];

    public function handle(FormBuilder $builder,CategoryRepositoryInterface $repository)
    {
        $entry = $builder->getFormEntry();

        $category = $repository->find($builder->getPostValue('category'));

        $category_values = array_reverse($category->getParents());

        for ($i = 1; $i <= 5; $i++) {
            $value = null;
            if (array_key_exists($i - 1, $category_values)) {
                $value = $category_values[$i - 1]->id;
            }
            $entry->{'category_' . $i} = $value;
        }

        $entry->save();
    }

    public function getParent()
    {
        $category_keys = array_filter($this->getEntry()->getAttributes(), function ($key) {
            return str_contains($key, 'category_');
        }, ARRAY_FILTER_USE_KEY);

        if (count($category_keys)) {
            $category_repository = app(CategoryRepositoryInterface::class);
            return $category_repository->find(max(array_values($category_keys)))->getParents();
        }
        return null;
    }

    public function getValue()
    {
        $category_keys = array_filter($this->getEntry()->getAttributes(), function ($key) {
            return str_contains($key, 'category_');
        }, ARRAY_FILTER_USE_KEY);

        if (count($category_keys)) {
            return max(array_values($category_keys));
        }

        return null;
    }
}

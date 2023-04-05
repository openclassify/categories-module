<?php namespace Visiosoft\CategoriesModule\Http\Controller\Admin;

use Visiosoft\CategoriesModule\Category\Form\CategoryFormBuilder;
use Visiosoft\CategoriesModule\Category\Table\CategoryTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\CategoriesModule\Category\Command\CalculateLevel;
use Visiosoft\CategoriesModule\Category\Contract\CategoryRepositoryInterface;

class CategoryController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param CategoryTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(CategoryTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param CategoryFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(CategoryFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param CategoryFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(CategoryFormBuilder $form, $id)
    {
        return $form->render($id);
    }

    public function choose(CategoryRepositoryInterface $categories)
    {
        return $this->view->make('module::admin/category/choose', ['categories' => $categories->mainCategories()]);
    }

    public function calculate()
    {
        try {
            $this->dispatch(new CalculateLevel());

            $this->messages->success([trans('streams::message.edit_success', ['name' => 'Category Level'])]);;
        } catch (\Exception $exception) {
            $this->messages->error([trans('streams::errors.500.name')]);
        }

        return $this->redirect->to('/admin/categories/category');
    }
}

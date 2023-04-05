<?php namespace Visiosoft\CategoriesModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\CategoriesModule\Category\Contract\CategoryRepositoryInterface;

class ApiController extends AdminController
{
    public function getCategories(CategoryRepositoryInterface $categories)
    {
        try {
            $entries = $categories->newQuery();

            if ($this->request->has('id')) {
                $entry = $entries->find($this->request->get('id'));

                return $this->response->json([
                    'success' => true,
                    'data' => [
                        'entry' => $entry,
                        'parents' => $entry->getParents()
                    ]
                ]);
            }

            if ($this->request->has('parent')) {
                $entries = $entries->where('parent_category_id', $this->request->get('parent'));
            } else {
                $entries = $entries->whereNull('parent_category_id');
            }

            $entries = $entries->get()->pluck('name', 'id')->all();

            return $this->response->json([
                'success' => true,
                'data' => $entries,
            ]);
        } catch (\Exception $exception) {
            return $this->response->json([
                'success' => false
            ]);
        }
    }
}

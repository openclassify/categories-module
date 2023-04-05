<?php namespace Visiosoft\CategoriesModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

class CategoriesModule extends Module
{

    /**
     * The navigation display flag.
     *
     * @var bool
     */
    protected $navigation = true;

    /**
     * The addon icon.
     *
     * @var string
     */
    protected $icon = 'fa fa-puzzle-piece';

    public function getSections()
    {
        return [
            'category' => [
                'buttons' => [
                    'new_category' => [
                        'href' => function () {
                            $suffix = "";
                            if (request('parent')) {
                                $suffix = '?parent=' . request('parent');
                            }
                            return '/admin/categories/category/create' . $suffix;
                        }
                    ],
                    'calculate_level' => [
                        'href' => '/admin/categories/calculate-category',
                        'type' => 'success',
                        'icon' => 'refresh'
                    ],
                ],
            ],
        ];
    }

}

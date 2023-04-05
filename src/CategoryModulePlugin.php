<?php namespace Visiosoft\CategoriesModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Twig_Environment;
use Visiosoft\CategoriesModule\Category\Contract\CategoryRepositoryInterface;

class CategoryModulePlugin extends Plugin
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'categories',
                function () {
                    return app(CategoryRepositoryInterface::class);
                }
            ),
        ];
    }
}

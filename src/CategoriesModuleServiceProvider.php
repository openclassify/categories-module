<?php namespace Visiosoft\CategoriesModule;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\AddonIntegrator;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Visiosoft\CategoriesModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CategoriesModule\Category\CategoryRepository;
use Anomaly\Streams\Platform\Model\Categories\CategoriesCategoryEntryModel;
use Visiosoft\CategoriesModule\Category\CategoryModel;
use Illuminate\Routing\Router;

class CategoriesModuleServiceProvider extends AddonServiceProvider
{

    /**
     * Additional addon plugins.
     *
     * @type array|null
     */
    protected $plugins = [
        CategoryModulePlugin::class,
    ];

    /**
     * The addon Artisan commands.
     *
     * @type array|null
     */
    protected $commands = [];

    /**
     * The addon's scheduled commands.
     *
     * @type array|null
     */
    protected $schedules = [];

    /**
     * The addon API routes.
     *
     * @type array|null
     */
    protected $api = [];

    /**
     * The addon routes.
     *
     * @type array|null
     */
    protected $routes = [
        'admin/categories' => 'Visiosoft\CategoriesModule\Http\Controller\Admin\CategoryController@index',
        'admin/categories/create' => 'Visiosoft\CategoriesModule\Http\Controller\Admin\CategoryController@create',
        'admin/categories/edit/{id}' => 'Visiosoft\CategoriesModule\Http\Controller\Admin\CategoryController@edit',
        'admin/categories/calculate-category' => 'Visiosoft\CategoriesModule\Http\Controller\Admin\CategoryController@calculate',

        // Handler & API Routes
        'entry/handle/select-category' => 'Visiosoft\CategoriesModule\Http\Controller\Admin\CategoryController@choose',
        'api/categories/get-categories' => 'Visiosoft\CategoriesModule\Http\Controller\Admin\ApiController@getCategories',
    ];

    /**
     * The addon middleware.
     *
     * @type array|null
     */
    protected $middleware = [
        //Visiosoft\CategoriesModule\Http\Middleware\ExampleMiddleware::class
    ];

    /**
     * Addon group middleware.
     *
     * @var array
     */
    protected $groupMiddleware = [
        //'web' => [
        //    Visiosoft\CategoriesModule\Http\Middleware\ExampleMiddleware::class,
        //],
    ];

    /**
     * Addon route middleware.
     *
     * @type array|null
     */
    protected $routeMiddleware = [];

    /**
     * The addon event listeners.
     *
     * @type array|null
     */
    protected $listeners = [
        //Visiosoft\CategoriesModule\Event\ExampleEvent::class => [
        //    Visiosoft\CategoriesModule\Listener\ExampleListener::class,
        //],
    ];

    /**
     * The addon alias bindings.
     *
     * @type array|null
     */
    protected $aliases = [
        //'Example' => Visiosoft\CategoriesModule\Example::class
    ];

    /**
     * The addon class bindings.
     *
     * @type array|null
     */
    protected $bindings = [
        CategoriesCategoryEntryModel::class => CategoryModel::class,
    ];

    /**
     * The addon singleton bindings.
     *
     * @type array|null
     */
    protected $singletons = [
        CategoryRepositoryInterface::class => CategoryRepository::class,
    ];

    /**
     * Additional service providers.
     *
     * @type array|null
     */
    protected $providers = [
        //\ExamplePackage\Provider\ExampleProvider::class
    ];

    /**
     * The addon view overrides.
     *
     * @type array|null
     */
    protected $overrides = [
        //'streams::errors/404' => 'module::errors/404',
        //'streams::errors/500' => 'module::errors/500',
    ];

    /**
     * The addon mobile-only view overrides.
     *
     * @type array|null
     */
    protected $mobile = [
        //'streams::errors/404' => 'module::mobile/errors/404',
        //'streams::errors/500' => 'module::mobile/errors/500',
    ];

    public function register(
        AddonIntegrator $integrator,
        AddonCollection $addons
    )
    {
        $addon = $integrator->register(
            realpath(__DIR__ . '/../addons/visiosoft/category-field_type/'),
            'visiosoft.field_type.category',
            true,
            true
        );

        $addons->push($addon);
    }

    /**
     * Boot the addon.
     */
    public function boot()
    {
        // Run extra post-boot registration logic here.
        // Use method injection or commands to bring in services.
    }

    /**
     * Map additional addon routes.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        // Register dynamic routes here for example.
        // Use method injection or commands to bring in services.
    }

}

<?php namespace ClarkNguyen\BlogBreadCrumbs;

use Backend;
use System\Classes\PluginBase;

/**
 * BlogBreadCrumbs Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'clarknguyen.blogbreadcrumbs::lang.plugin.name',
            'description' => 'clarknguyen.blogbreadcrumbs::lang.plugin.description',
            'author'      => 'ClarkNguyen',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'ClarkNguyen\BlogBreadCrumbs\Components\CategoryBreadCrumbs' => 'CategoryBreadCrumbs',
            'ClarkNguyen\BlogBreadCrumbs\Components\PostBreadCrumbs' => 'PostBreadCrumbs',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'clarknguyen.blogbreadcrumbs.some_permission' => [
                'tab' => 'BlogBreadCrumbs',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'blogbreadcrumbs' => [
                'label'       => 'BlogBreadCrumbs',
                'url'         => Backend::url('clarknguyen/blogbreadcrumbs/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['clarknguyen.blogbreadcrumbs.*'],
                'order'       => 500,
            ],
        ];
    }

    public function boot() {
    }
}

<?php namespace ClarkNguyen\BlogBreadCrumbs\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use RainLab\Blog\Models\Post as BlogPost;
use RainLab\Blog\Models\Category as BlogCategory;

class CategoryBreadCrumbs extends ComponentBase
{
    protected $categoryPage;
    protected $categorySlug;

    public function componentDetails()
    {
        return [
            'name'        => 'clarknguyen.blogbreadcrumbs::lang.plugin.category_name',
            'description' => 'clarknguyen.blogbreadcrumbs::lang.plugin.category_description'
        ];
    }

    public function defineProperties()
    {
        return [
            'categoryPage' => [
                'title'       => 'rainlab.blog::lang.settings.post_category',
                'description' => 'rainlab.blog::lang.settings.post_category_description',
                'type'        => 'dropdown',
                'default'     => 'blog/category',
            ],
            'categorySlug' => [
                'title'       => 'rainlab.blog::lang.settings.category_slug',
                'description' => 'rainlab.blog::lang.settings.category_slug_description',
                'default'     => '{{ :slug }}',
                'type'        => 'string'
            ],
        ];
    }

    public function getCategoryPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {
        $this->categoryPage = $this->page['categoryPage'] = $this->property('categoryPage');
        $this->categorySlug = $this->page['categorySlug'] = $this->property('categorySlug');
        $currentCategory = $this->loadCategory();
        $controller = $this->controller;
        $parent_id = null;
        $categoryPath = [];
        if ( $currentCategory ) {
            $parent_id = $currentCategory->parent_id;
            $currentCategory->nolink = true;
            $categoryPath []= $currentCategory;
        }
        
        $this->getLastestParent($parent_id, $categoryPath);
        $categoryPath = array_reverse($categoryPath);
        $breadCrumbs = [];
        //echo "<pre>"; var_dump($categoryPath);echo "</pre>";
        if ( $categoryPath ) {
            $breadCrumbs []= [
                'link' => url('/'),
                'name' => 'Home',
                'separator' => null
            ];
            foreach ( $categoryPath as $category ) {
                $params = [
                    'id' => $category->id, 
                    'slug' => $category->slug, 
                ];
                if ( $breadCrumbs ) $breadCrumbs []= [
                    'separator' => '>',
                    'name' => null,
                    'link' => null
                ];

                if ( $category->nolink )
                {
                    $breadCrumbs []= [
                        'link' => '#',
                        'name' => $category->name,
                        'separator' => null
                    ];    
                }
                else 
                {
                    $breadCrumbs []= [
                        'link' => $controller->pageUrl($this->categoryPage, $params),
                        'name' => $category->name,
                        'separator' => null
                    ];   
                }
            }    
        }      
        //echo "<pre>"; var_dump($breadCrumbs); die;
        $this->breadCrumbs = $this->page['breadCrumbs'] = $breadCrumbs;
    }

    protected function loadCategory()
    {
        if (!$categoryId = $this->property('categorySlug'))
            return null;

        if (!$category = BlogCategory::whereSlug($categoryId)->first())
            return null;

        return $category;
    }

    public function getLastestParent($parent_id, &$categoryPath = [])
    {
        if ( !$parent_id ) {
            return null;
        }
        //echo $parent_id,"<hr/>";
        $category = BlogCategory::where('id', intval($parent_id))->first();
        if ( is_object($category) && $category->id ) {
            $categoryPath []= $category;
            if ( intval($category->parent_id) ) $this->getLastestParent($category->parent_id, $categoryPath);
            return $categoryPath;
        }
        return null;
    }
}
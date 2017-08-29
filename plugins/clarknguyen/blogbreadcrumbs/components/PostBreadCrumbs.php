<?php namespace ClarkNguyen\BlogBreadCrumbs\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use RainLab\Blog\Models\Post as BlogPost;
use RainLab\Blog\Models\Category as BlogCategory;
use Db;
use Input;

class PostBreadCrumbs extends ComponentBase
{
    protected $postSlug;
    protected $categoryPage;
    
    public function componentDetails()
    {
        return [
            'name'        => 'clarknguyen.blogbreadcrumbs::lang.plugin.post_name',
            'description' => 'clarknguyen.blogbreadcrumbs::lang.plugin.post_description'
        ];
    }

    public function defineProperties()
    {
        return [
            'categoryPage' => [
                'title'       => 'clarknguyen.blogbreadcrumbs::lang.settings.post_category',
                'description' => 'clarknguyen.blogbreadcrumbs::lang.settings.post_category_description',
                'type'        => 'dropdown',
                'default'     => 'blog/category',
            ],
            'postSlug' => [
                'title'       => 'clarknguyen.blogbreadcrumbs::lang.settings.post_slug',
                'description' => 'clarknguyen.blogbreadcrumbs::lang.settings.post_slug_description',
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
        $this->postSlug = $this->page['postSlug'] = $this->property('postSlug');
        $currentCategory = $this->loadCategory();
        $controller = $this->controller;
        $parent_id = null;
        $categoryPath = [];
        if ( $currentCategory ) {
            $parent_id = $currentCategory->parent_id;
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

                $breadCrumbs []= [
                    'link' => $controller->pageUrl($this->categoryPage, $params),
                    'name' => $category->name,
                    'separator' => null
                ];  
            }    
        }

        if ( $breadCrumbs && $this->postSlug ) {
            $post = BlogPost::where('slug', $this->postSlug)->first();
            if ( $post ) {
                $breadCrumbs []= [
                    'separator' => '>',
                    'name' => null,
                    'link' => null
                ];
                $breadCrumbs []= [
                    'link' => '#',
                    'name' => $post->title,
                    'separator' => null
                ];  
            }
        }  
        //echo "<pre>"; var_dump($breadCrumbs); die;
        $this->breadCrumbs = $this->page['breadCrumbs'] = $breadCrumbs;
    }

    protected function loadCategory()
    {
        if (!$postSlug = $this->property('postSlug'))
            return null;
        //find parent
        //echo $postSlug, "<br/>";
        //echo "<pre>"; var_dump($firstCategory);die;
        if ( Input::get('cslug', false) ) {
            $categoryId = Input::get('cslug', false);
            if (!$category = BlogCategory::whereSlug($categoryId)->first()) return null;
        }
        else {
            $firstCategory = Db::table('rainlab_blog_posts')
            ->join('rainlab_blog_posts_categories', 'rainlab_blog_posts_categories.post_id', '=', 'rainlab_blog_posts.id')
            ->join('rainlab_blog_categories', 'rainlab_blog_categories.id', '=', 'rainlab_blog_posts_categories.category_id')
            ->select('rainlab_blog_categories.id')
            ->where('rainlab_blog_posts.slug', $postSlug)
            ->first();

            $categoryId = 0;
            if ( $firstCategory ) {
                $categoryId = $firstCategory->id;
            }     

            if (!$category = BlogCategory::find($categoryId)) return null;
            //echo "<pre>"; var_dump($category->name); die;
        }

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
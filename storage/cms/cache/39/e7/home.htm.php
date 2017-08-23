<?php 
class Cms599c3c22d9482835445075_e9bfb27ff2da06b9a8c5aa9a314dbf21Class extends \Cms\Classes\PageCode
{
public function onPagePosts()
{
    $this->blogPosts->setProperty('pageNumber', post('page'));
    $this->pageCycle();
}
}

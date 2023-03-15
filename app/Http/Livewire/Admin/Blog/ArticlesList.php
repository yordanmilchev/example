<?php

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Blog\BlogArticle;
use Livewire\Component;
use Livewire\WithPagination;

class ArticlesList extends Component
{
    use WithPagination;
    public $title;
    public $sortField = 'blog_date';
    public $sortDirection = 'desc';

    protected $listeners = ['filtersCleared'];

    public function filtersCleared()
    {
        $this->resetExcept();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function render()
    {
        $blogArticlesQb = BlogArticle::whereTranslationLike('title', '%'.$this->title.'%' );

        if (in_array($this->sortField, ['title', 'excerpt', 'is_enabled'])){
            $blogArticlesQb->select('*', 'blog_article_translations.*')->join('blog_article_translations', function ($join) {
                $join->on('blog_articles.id', '=', 'blog_article_translations.blog_article_id')
                    ->where('blog_article_translations.locale', '=', locale());
            });
            $blogArticles = $blogArticlesQb->orderBy('blog_article_translations.'.$this->sortField, $this->sortDirection)
                ->paginate(15);
        } else {
            $blogArticles = $blogArticlesQb->orderBy($this->sortField, $this->sortDirection)
                ->paginate(15);
        }


        return view('livewire.admin.blog.articles-list', [
            'articles' => $blogArticles,
        ]);
    }
}

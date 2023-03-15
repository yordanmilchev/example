<?php

namespace App\Http\Controllers;

use App\Components\BreadcrumbComponent;
use App\Models\Blog\BlogArticle;
use App\Models\Blog\BlogArticleCategory;
use App\Repositories\BlogRepository;
use App\UrlMeta;
use Illuminate\Http\Request;

class BlogArticleController extends Controller
{
    public function index(Request $request) {
        $allBlogCategories = BlogRepository::getBlogCategories();
        $latestArticles = BlogRepository::getLatestArticles();
        $years = BlogRepository::getArchiveYears();

        $blogCategory = BlogRepository::getBlogCategoryBySlug($request->categorySlug)?:abort(404);
        $blogArticles = BlogArticle::with('translations')
            ->whereHas('translations', function ($query) {
                $query->where('locale', '=', locale());
                $query->where('is_enabled', 1);
            })
            ->with('categories')
            ->whereHas('categories', function ($query) use ($blogCategory) {
                $query->where('blog_article_category_id', $blogCategory->id); //get articles from specific category
            })
            ->orderBy('created_at', 'desc')
            ->orderBy('blog_date', 'desc')
            ->paginate(8);

        BreadcrumbComponent::addItem(trans('Блог'), route('blog.all_articles'));
        BreadcrumbComponent::addItem($blogCategory->title, route('blog.articles_list', $blogCategory->slug));

        return view('front.blog.articles_list', [
            'blogArticles' => $blogArticles,
            'latestArticles' => $latestArticles,
            'categories' => $allBlogCategories,
            'years' => $years
        ]);
    }

    public function listAllArticles()
    {
        $latestArticles = BlogRepository::getLatestArticles();
        $blogArticles = BlogRepository::getArticlesList();
        $categories = BlogRepository::getBlogCategories();
        $years = BlogRepository::getArchiveYears();

        BreadcrumbComponent::addItem(trans('Блог'), route('blog.all_articles'));

        return view('front.blog.articles_list', [
            'blogArticles' => $blogArticles,
            'latestArticles' => $latestArticles,
            'categories' => $categories,
            'years' => $years
        ]);
    }

    public function show($slug)
    {
        $article = BlogRepository::getBySlug($slug);
        $latestArticles = BlogRepository::getLatestArticles($slug);

        $articleTranslation = $article->translate(locale());

        BreadcrumbComponent::addItem(trans('Блог'), route('blog.all_articles'));
        BreadcrumbComponent::addItem($articleTranslation->title, route('blog.article', $slug));

        return view('front.blog.article', [
            'article' => $article,
            'articleTranslation' => $articleTranslation,
            'latestArticles' => $latestArticles
        ]);
    }

    public function showByDate($date)
    {
        $blogArticle = BlogArticle::where('blog_date', $date)
            ->with('translations')
            ->get()
            ->first();

        $slug = $blogArticle->translate(locale())->slug;

        return redirect()->route('blog.article', $slug);
    }
}

<?php


namespace App\Repositories;


use App\Models\Blog\BlogArticle;
use App\Models\Blog\BlogArticleCategory;
use Illuminate\Support\Facades\DB;

class BlogRepository
{
    public static function getBySlug($slug)
    {
        return BlogArticle::with('translations')
            ->whereTranslation('slug', $slug)
            ->whereTranslation('is_enabled', 1)
            ->firstOrFail();
    }

    public static function getBlogCategoryBySlug($slug)
    {
        return BlogArticleCategory::with('translations')
            ->whereTranslation('slug', $slug)
            ->whereTranslation('is_enabled', 1)
            ->firstOrFail();
    }

    public static function getArticlesList()
    {
        return BlogArticle::select('*', 'blog_article_translations.*', DB::raw('blog_articles.id as id'))
            ->join('blog_article_translations', function ($join) {
                $join->on('blog_articles.id', '=', 'blog_article_translations.blog_article_id')
                    ->where('blog_article_translations.locale', '=', locale());
                $join->where('blog_article_translations.is_enabled', '=', 1);
            })
            ->orderBy('blog_articles.created_at', 'desc')
            ->orderBy('blog_date', 'desc')
            ->paginate(8);
    }

    public static function getLatestArticles($slug = null)
    {
        return BlogArticle::select('*', 'blog_article_translations.*', DB::raw('blog_articles.id as id'))
            ->join('blog_article_translations', function ($join) use ($slug) {
                $join->on('blog_articles.id', '=', 'blog_article_translations.blog_article_id')
                    ->where('blog_article_translations.locale', '=', locale());
                $join->where('blog_article_translations.is_enabled', '=', 1)
                    ->where('blog_article_translations.slug', '!=', $slug);
            })
            ->orderBy('blog_articles.created_at', 'desc')
            ->limit(4)
            ->get();
    }

    public static function getArchiveYears()
    {
        return BlogArticle::with('translations')
            ->whereHas('translations', function ($query) {
                $query->where('locale', '=', locale())
                    ->where('is_enabled', 1);
            })
            ->select('blog_date')
            ->orderBy('blog_date', 'ASC')
            ->groupBy('blog_date')
            ->limit(5)
            ->get()
            ->pluck('blog_date')
            ->sortDesc()
            ->toArray();
    }

    public static function getBlogCategories()
    {
        return BlogArticleCategory::select('*', 'blog_article_category_translations.*', DB::raw('blog_article_categories.id as id'))
            ->join('blog_article_category_translations', function ($join) {
                $join->on('blog_article_categories.id', '=', 'blog_article_category_translations.blog_article_category_id')
                    ->where('blog_article_category_translations.locale', '=', locale());
                $join->where('blog_article_category_translations.is_enabled', '=', 1);
            })->get();
    }
}

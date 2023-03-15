<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogArticle;
use App\Models\Blog\BlogArticleCategory;
use App\Models\Blog\BlogArticleEditLog;
use App\Models\Blog\BlogArticleTranslation;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BlogArticleController extends Controller
{
    public function index()
    {
        return view('admin.blog.articles_list');
    }

    public function edit(Request $request)
    {
        if ($request->get('id')) {
            $article = BlogArticle::find($request->get('id'));
        } else {
            $article = new BlogArticle();
        }

        $allBlogCategories = BlogArticleCategory::orderBy('created_at', 'asc')->get()->keyBy('id');

        if ($request->method() == 'POST') {
            $rules = [
                '%title%' => 'required_with:%body%,%is_enabled%|string',
                'title:bg' => 'required',
                '%body%' => 'nullable|string',
                '%is_enabled' => 'nullable|boolean'
            ];

            $rules = RuleFactory::make($rules);
            $validator = \Validator::make(array_filter($request->all()), $rules);
            if ($validator->fails()) {
                $request->session()->flash('error', 'Записът не може да бъде осъществен !');
                return back()->withErrors($validator)->withInput($request->all());
            } else {
                $cleanData = $request->except([
                    'image', 'categories'
                ]);

                $article->fill($cleanData);
                if (empty($request->input('blog_date'))){
                    $article->blog_date = DB::raw('now()');
                }
                $article->save();

                $imageFile = $request->file('image');
                if ($imageFile) {
                    $fileName = $imageFile->getClientOriginalName();
                    $destinationPath = public_path() . '/uploads/live/blog/';
                    $imageFile->move($destinationPath, $fileName);

                    $article->image = $fileName;
                    $article->save();
                }

                $selectedBlogCategoriesArr = $request->input('categories');
                if ($selectedBlogCategoriesArr) {
                    $blogArticleCategories = []; // categories associated with the blog article

                    foreach ($selectedBlogCategoriesArr as $selectedBlogCategoryId) {
                        array_push($blogArticleCategories, $selectedBlogCategoryId);
                    }

                    $article->categories()->sync($blogArticleCategories);
                    $article->save();
                }

                $blogArticleEditLog = new BlogArticleEditLog($article);
                $blogArticleEditLog->save();

                $request->session()->flash('success', 'Записът беше осъществен успешно !');

                return redirect()->route('admin.blog.article.edit', [
                    'id' => $article->id,
                ]);
            }
        }

        return view('admin.blog.article_edit', [
            'article' => $article,
            'allBlogCategories' => $allBlogCategories
        ]);
    }
}

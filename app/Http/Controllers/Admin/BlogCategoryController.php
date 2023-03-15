<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogArticleCategory;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index(Request $request)
    {
        $blogCategories = BlogArticleCategory::with('translations')
            ->orderBy('created_at', 'desc')
            ->paginate(40);

        $request->flash();

        return view('admin.blog.blog_categories_list', [
            'blogCategories' => $blogCategories
        ]);
    }

    public function edit(Request $request)
    {
        if ($request->get('id')) {
            $blogCategory = BlogArticleCategory::find($request->get('id'));
        } else {
            $blogCategory = new BlogArticleCategory();
        }

        if ($request->method() == 'POST') {
            $rules = [
                '%title%' => 'required_with:%body%,%is_enabled%|string',
                '%is_enabled' => 'nullable|boolean',
            ];

            $rules = RuleFactory::make($rules);
            $validator = \Validator::make(array_filter($request->all()), $rules);
            if ($validator->fails()) {
                $request->session()->flash('error', 'Записът не може да бъде осъществен !');
                return back()->withErrors($validator)->withInput($request->all());
            } else {
                $cleanData = $request->except([

                ]);

                $blogCategory->fill($cleanData);
                $blogCategory->save();

                $request->session()->flash('success', 'Записът беше осъществен успешно !');

                return redirect()->route('admin.blog.categories.edit', [
                    'id' => $blogCategory->id,
                ]);
            }
        }

        return view('admin.blog.blog_category_edit', [
            'blogCategory' => $blogCategory,
        ]);
    }
}

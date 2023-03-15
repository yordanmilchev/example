<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UrlMeta;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use function back;
use function redirect;
use function view;

class UrlMetaController extends Controller
{
    public function index(Request $request)
    {
        $allUrlsQb = UrlMeta::query();

        if(!empty($request->get('url_name'))) {
            $allUrlsQb->where('url_name', 'like', '%' . $request->get('url_name') . '%');
        }

        if(!empty($request->get('locale'))) {
            $allUrlsQb->where('url_name', 'like', '%.' . $request->get('locale') . '%');
        }

        $allUrls = $allUrlsQb->paginate(15);

        $request->flash();

        return view('admin.seo.url_meta_list', [
           'allUrls' => $allUrls
        ]);
    }

    public function edit(Request $request)
    {
        if ($request->get('id')) {
            $url = UrlMeta::find($request->get('id'));
        } else {
            $url = new UrlMeta();
        }

        if ($request->method() == 'POST') {
            $rules = [
                'url_name' => 'required',
            ];

            $rules = RuleFactory::make($rules);
            $validator = \Validator::make(array_filter($request->all()), $rules);
            if ($validator->fails()) {
                $request->session()->flash('error', 'Записът не може да бъде осъществен !');
                return back()->withErrors($validator)->withInput($request->all());
            } else {
                $url->url_name = $request->url_name;
                $url->meta_title = $request->meta_title;
                $url->meta_description = $request->meta_description;
                $url->save();

                $request->session()->flash('success', 'Записът беше осъществен успешно !');

                return redirect()->route('admin.url_metas.edit', [
                    'id' => $url->id,
                ]);
            }
        }

        return view('admin.seo.url_meta_edit', [
            'url' => $url,
        ]);
    }

    public function destroy($id)
    {
        $meta = UrlMeta::findOrFail($id);
        $metaTitle = $meta->meta_title;
        $meta->delete();

        $infoMsg='Записът за "'.$metaTitle.'" беше изтрит.';

        return redirect()->back()->with('info', $infoMsg);
    }
}

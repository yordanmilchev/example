<?php

namespace App\Http\Controllers\Admin;

use App\Constant\CacheTagConstant;
use App\Http\Controllers\Controller;
use App\Models\Page\Page;
use App\Models\Page\RouteKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::with('translations')
            ->paginate(30);

        return view('admin.pages.pages_index', [
            'pages' => $pages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $routeKeys = RouteKey::all();

        return view('admin.pages.page_create', [
            'routeKeys' => $routeKeys,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new Page;
        $page->title = $request->title;
        $page->route_key = $request->route_key;
        $page->template = $request->template;
        $page->save();

        Cache::tags(CacheTagConstant::PAGES)->flush();

        return redirect()->route('admin.pages.index')->with('info', 'Страница "'.$request->title.'" беше създадена успешно.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::with('translations')
            ->findOrFail($id);
        $routeKeys = RouteKey::all();

        return view('admin.pages.page_edit', [
            'page'=>$page,
            'routeKeys' => $routeKeys,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $page->route_key = $request->route_key;
        $page->template = $request->template;
        $page->is_enabled = $request->is_enabled=="on" ? 1 : 0;

        $inputData = $request->input();

        foreach (locales() as $locale) {
            if($inputData["title:{$locale}"] != null || $inputData["content:{$locale}"] != null) {
                $page->translateOrNew($locale)->title = $inputData["title:{$locale}"];
                $page->translateOrNew($locale)->content = $inputData["content:{$locale}"];
            } else {
                $translation = $page->translate($locale);
                if(!empty($translation)) {
                    $translation->delete();
                }
            }
        }

        $page->save();

        Cache::tags(CacheTagConstant::PAGES)->flush();

        $infoMsg = 'Страницата "'.$page->translate('bg')->title.'" беше редактирана.';

        if($page->is_enabled == 1) {
            $infoMsg.=' Страницата е АКТИВНА (публикувана)!';
        }

        return redirect()->route('admin.pages.index')->with('info', $infoMsg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $pageTitle = $page->title;
        $page->delete();

        $infoMsg='Страница "'.$pageTitle.'" беше изтрита.';

        return redirect()->back()->with('info', $infoMsg);
    }
}

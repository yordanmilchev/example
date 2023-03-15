<?php

namespace App\Http\Controllers\Admin;

use App\Constant\CacheTagConstant;
use App\Http\Controllers\Controller;
use App\Models\LayoutBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LayoutBlockController extends Controller
{
    /**
     * Display a listing of the Layout Blocks.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.layout_blocks.blocks_index');
    }

    /**
     * Show the form for creating a new layout block.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.layout_blocks.block_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $layoutBlock = new LayoutBlock;
        $layoutBlock->name = $request->name;
        $layoutBlock->weight = 9;
        $layoutBlock->save();

        return redirect()->route('admin.layout-blocks.index')->with('info', 'Блок с име "'.$request->name.'" беше създаден успешно.');
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
        $block = LayoutBlock::find($id);

        return view('admin.layout_blocks.block_edit', [
           'block' => $block
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
        $block = LayoutBlock::find($id);

        $block->name = $request->name;
        $block->region_name = $request->region_name;
        $block->static_content = $request->static_content;
        $block->dynamic_content = $request->dynamic_content;
        $block->weight = $request->weight;
        $block->locale = $request->location;
        $block->url_filter_operator = $request->url_filter_operator;
        $block->url_filter_values = $request->url_filter_values;
        $block->is_enabled = $request->is_enabled=="on" ? 1 : 0;
        $block->save();

        Cache::tags(CacheTagConstant::LAYOUT_REGIONS)->flush();


        $infoMsg='Блок с име "'.$request->name.'" беше редактиран.';
        if($block->is_enabled==1) {
            $infoMsg.=' Блокът е активен и се показва!';
        }

        if($request->ajax()){
            return response()->json(['message' => $infoMsg], 200, [], JSON_UNESCAPED_UNICODE);
        }

        return redirect()->route('admin.layout-blocks.index')->with('info', $infoMsg);
    }
}

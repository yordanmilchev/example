<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $typeCriteria = $request->get('setting_type');
        if ($typeCriteria) {
            $settings = Setting::where('setting_type', '=', $typeCriteria )->paginate(30);
        } else {
            $settings = Setting::paginate(30);
        }

        $request->flash();

        return view('admin.settings.settings_list',[
            'settings' => $settings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        $settingsToBeEditted = [];

        // if the setting has group, the whole group will be editted
        if (!empty($setting->group)) {
            $settingsByGroup = Setting::where('group', '=', $setting->group)->get();
            foreach ($settingsByGroup as $settingByGroup) {
                $settingsToBeEditted[] = $settingByGroup;
            }
        } else {
            $settingsToBeEditted[] = $setting;
        }

        return view('admin.settings.settings_edit', [
            'settingsToBeEditted' => $settingsToBeEditted,
            'mainSetting' => $setting
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalog\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $settingsToBeUpdated = [];
        // if the setting has group, the whole group will be editted
        if (!empty($setting->group)) {
            $settingsByGroup = Setting::where('group', '=', $setting->group)->get();
            foreach ($settingsByGroup as $settingByGroup) {
                $settingsToBeUpdated[] = $settingByGroup;
            }
        } else {
            $settingsToBeUpdated[] = $setting;
        }

        $allLocales = app(Locales::class)->all();
        foreach ($settingsToBeUpdated as $settingToBeUpdated) {
            $prefix = $settingToBeUpdated->setting_type . '_';
            if (!empty($request->get($prefix.'setting_value'))) {
                $settingToBeUpdated->setting_value = $request->get($prefix.'setting_value');
            }
            foreach ($allLocales as $locale) {
                $settingValueIndex = $prefix . 'value_by_locale:' . $locale;
                $settingToBeUpdated->translateOrNew($locale)->value_by_locale = $request->get($settingValueIndex);
            }
            $settingToBeUpdated->save();
        }

        $request->session()->flash('success', 'Записът беше осъществен успешно !');

        return redirect()->route('admin.settings.edit', ['setting' => $setting]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting, Request $request)
    {
        try {
            $setting->delete();

            $request->session()->flash('success', 'Записът беше изтрит успешно !');
        } catch (\Exception $exception) {
            $request->session()->flash('error', 'Записът не може да бъде изтрит поради наличието свързани продукти към него !');
        }

        return redirect()->route('admin.settings.index');
    }
}

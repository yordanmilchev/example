<?php

namespace App\Console\Commands\Settings;

use App\Constant\SettingConstant;
use App\Models\Setting;
use Illuminate\Console\Command;

class SynchronizeSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'synchronize-settings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronizes settings.';

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {
            $this->info('Settings synchronization started.');

            $presentSettings = Setting::all();
            $alreadyCreatedSettings = $presentSettings->keyBy('setting_type');
            $settingsLookupForDeletion = $presentSettings->keyBy('setting_type');


            // this array will define all settings
            $settingsContainer = [
                SettingConstant::TYPE_SHORT_DELIVERY_DAYS => [
                    'default' => null, 'description' => 'Кратък срок на доставка в дни', 'is_system' => 0,
                    'group' => 'Срокове за доставка',
                    'locales' => ['bg' => 3, 'en' => 10],
                ],
                SettingConstant::TYPE_LONG_DELIVERY_DAYS => [
                    'default' => null, 'description' => 'Дълъг срок на доставка в дни', 'is_system' => 0,
                    'group' => 'Срокове за доставка',
                    'locales' => ['bg' => 30, 'en' => 90]
                ],
                SettingConstant::TYPE_CURRENCY_RATE => [
                    'default' => null, 'description' => 'Курс', 'is_system' => 0,
                    'group' => 'Валутни курсове',
                    'locales' => ['bg' => 1, 'en' => 0.43]
                ],
                SettingConstant::TYPE_FREE_DELIVERY_MIN_AMOUNT => [
                    'default' => null, 'description' => 'Минимална стойност за безплатна доставка', 'is_system' => 0,
                    'group' => 'Цена на доставка',
                    'locales' => ['bg' => 50, 'en' => 22]
                ],
                SettingConstant::TYPE_FLAT_DELIVERY_FEE => [
                    'default' => null, 'description' => 'Плоска цена на доставка', 'is_system' => 0,
                    'group' => 'Цена на доставка',
                    'locales' => ['bg' => 5, 'en' => 5]
                ],
                SettingConstant::TYPE_UNLIMITED_SKUS => [
                    'default' => '', 'description' => 'Продукти винаги на кратък срок на доставка.', 'is_system' => 0,
                    'group' => 'Unlimited skus',
                    'data_type'=>SettingConstant::DATA_TYPE_TEXT
                ],
                SettingConstant::TYPE_LOCALE_PRICE_INCREASE_PERCENT => [
                    'default' => '', 'description' => 'Процент на увеличение на цените за различните държави', 'is_system' => 0,
                    'locales' => ['bg' => 0, 'en' => 0],
                    'group' => 'Цени',
                ],
                SettingConstant::TYPE_VAT => [
                    'default' => null, 'description' => 'ДДС за всяка от държавите', 'is_system' => 0,
                    'group' => 'ДДС',
                    'locales' => ['bg' => 20, 'en' => 20]
                ],
                SettingConstant::TYPE_GOOGLE_ANALYTICS_ID => [
                    'default' => '', 'description' => 'Google analytics ids', 'is_system' => 0,
                    'locales' => ['bg' => '', 'en' => ''],
                    'group' => 'Google analytics',
                ],
                SettingConstant::TYPE_FB_ACCESS_TOKEN => [
                    'default' => 'EAAC0aE5uMXMBAPjYW6Mi9LDXBOYCqwgx9bGc8Yg2jMpezZChjR6m0JXW7P4dmd5E2jz3XJcIOaYotlKn23vqu1ZB8gdH19PWZBtEDd2ZC29VH28ihF1dHrmInnnUv1PjVfTMmFsLyIbaOnm8APFEMjAHq9ToC87oMjtfm76Pu3eB3UCZCyGOO', 'description' => 'Access token за Facebook интеграцията с Conversion API (CAPI)', 'is_system' => 0,
                    'group' => 'Фейсбук маркетинг',
                ],
                SettingConstant::TYPE_FB_PIXEL_ID => [
                    'default' => '907303036479881', 'description' => 'Пиксел ID за Facebook', 'is_system' => 0,
                    'group' => 'Фейсбук маркетинг',
                ],
                SettingConstant::TYPE_SITE_LOGO_PRIMARY => [
                    'default' => '/themes/custom/css/images/logo.png', 'description' => 'Лого на сайта', 'is_system' => 0,
                    'group' => 'Лого',
                ],
                SettingConstant::TYPE_SITE_NAME => [
                    'default' => 'Malev', 'description' => 'Име на сайта', 'is_system' => 0,
                    'group' => 'Фирмени данни',
                ],
                SettingConstant::TYPE_FIRM_NAME => [
                    'default' => 'Malev', 'description' => 'Име на фирмата', 'is_system' => 0,
                    'group' => 'Фирмени данни',
                ],
                SettingConstant::TYPE_FIRM_EIK => [
                    'default' => '', 'description' => 'Еик данни на фирмата', 'is_system' => 0,
                    'group' => 'Фирмени данни',
                ],
                SettingConstant::TYPE_FIRM_IBAN => [
                    'default' => '', 'description' => 'IBAN данни на фирмата', 'is_system' => 0,
                    'group' => 'Фирмени данни',
                ],
                SettingConstant::TYPE_FIRM_ADDRESS => [
                    'default' => '', 'description' => 'Адрес на фирмата', 'is_system' => 0,
                    'group' => 'Фирмени данни',
                ],
                SettingConstant::TYPE_FIRM_EMAIL => [
                    'default' => '', 'description' => 'Email на фирмата', 'is_system' => 0,
                    'group' => 'Фирмени данни',
                ],
                SettingConstant::TYPE_FIRM_PHONE => [
                    'default' => '', 'description' => 'Телефон на фирмата', 'is_system' => 0,
                    'group' => 'Фирмени данни',
                ],
                SettingConstant::TYPE_FIRM_BIC => [
                    'default' => '', 'description' => 'BIC на фирмата', 'is_system' => 0,
                    'group' => 'Фирмени данни',
                ],
                SettingConstant::TYPE_FIRM_BANK => [
                    'default' => '', 'description' => 'Банка на фирмата', 'is_system' => 0,
                    'group' => 'Фирмени данни',
                ],
            ];

            foreach ($settingsContainer as $settingType => $settingInitData) {
                if (!isset($alreadyCreatedSettings[$settingType])) {
                    $setting = new Setting();

                    $setting->setting_value = $settingInitData['default'] ?? '';
                    $setting->setting_type = $settingType;
                    $setting->data_type = $settingInitData['data_type'] ?? null;
                    $setting->description = $settingInitData['description'] ?? '';
                    $setting->is_system = $settingInitData['is_system'] ?? false;
                    $setting->group = $settingInitData['group'] ?? '';

                    if (isset($settingInitData['locales'])) {
                        foreach ($settingInitData['locales'] as $locale => $valueByLocale) {
                            $setting->translateOrNew($locale)->value_by_locale = $valueByLocale;
                        }
                    }
                    $setting->save();
                } else {
                    if (!empty($settingInitData)) {
                        $setting = Setting::where(['setting_type' => $settingType])->first();
                        if (isset($settingInitData['locales'])) {
                            foreach ($settingInitData['locales'] as $locale => $valueByLocale) {
                                if (empty($setting->translate($locale)->value_by_locale)) {
                                    $setting->translateOrNew($locale)->value_by_locale = $valueByLocale;
                                    $setting->save();
                                }
                            }
                        }
                    }

                    unset($settingsLookupForDeletion[$settingType]);
                }
            }

            if (count($settingsLookupForDeletion)) {
                foreach ($settingsLookupForDeletion as $settingForDeletion) {
                    $settingForDeletion->delete();
                }
            }

            $this->info("Settings synchronization finished");
    }
}

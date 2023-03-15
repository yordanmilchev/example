// obtain cookieconsent plugin
var cc = initCookieConsent();

// microsoft logo
var logo = '<img src="/images/nav_logo.png" alt="" width="100" class="py-2">';
var cookie = '🍪';

// run plugin with config object
cc.run({
    current_lang : 'en',
    autoclear_cookies : true,                   // default: false
    cookie_name: 'cc_cookie',                   // default: 'cc_cookie'
    cookie_expiration : 365,                    // default: 182
    page_scripts: true,                         // default: false

    // auto_language: null,                     // default: null; could also be 'browser' or 'document'
    // autorun: true,                           // default: true
    // delay: 0,                                // default: 0
    // force_consent: false,
    // hide_from_bots: false,                   // default: false
    // remove_cookie_tables: false              // default: false
    // cookie_domain: location.hostname,        // default: current domain
    // cookie_path: "/",                        // default: root
    // cookie_same_site: "Lax",
    // use_rfc_cookie: false,                   // default: false
    // revision: 0,                             // default: 0

    gui_options: {
        consent_modal: {
            layout: 'box',                      // box,cloud,bar
            position: 'bottom right',           // bottom,middle,top + left,right,center
            transition: 'slide'                 // zoom,slide
        },
        settings_modal: {
            layout: 'box',                      // box,bar
            // position: 'left',                // right,left (available only if bar layout selected)
            transition: 'slide'                 // zoom,slide
        }
    },

    languages: {
        'en': {
            consent_modal: {
                description: 'Ние използваме бисквитки, за да предоставяме по-качествено своите услуги! <button type="button" data-cc="c-settings" class="cc-link">Промени настройките</button>',
                primary_btn: {
                    text: 'Разбирам',
                    role: 'accept_all'              // 'accept_selected' or 'accept_all'
                },
                // secondary_btn: {
                //     text: 'Reject all',
                //     role: 'accept_necessary'        // 'settings' or 'accept_necessary'
                // }
            },
            settings_modal: {
                title: logo,
                save_settings_btn: 'Запиши промените',
                accept_all_btn: 'Приемам всички',
                reject_all_btn: 'Отказвам всички',
                close_btn_label: 'Close',
                cookie_table_headers: [
                    {col1: 'Име'},
                    {col2: 'Домейн'},
                    {col4: 'Описание'}
                ],
                blocks: [
                    {
                        description: 'Ние използваме „бисквитки“ за показване съдържанието на сайта и подобряване на потребителското изживяване. Повече информация за „бисквитките“ и опциите за управлението им може да намерите в раздела <a href="#" class="cc-link">Политика за използване на бисквитки</a>.'
                    }, {
                        title: 'Необходими бисквитки',
                        description: 'Необходими бисквитки',
                        toggle: {
                            value: 'necessary',
                            enabled: true,
                            readonly: true          // cookie categories with readonly=true are all treated as "necessary cookies"
                        }
                    }, {
                        title: 'Бисквитки за анализ',
                        description: 'Тези бисквитки събират анонимна информация, която ни позволява да анализираме взаимодействието ви със сайта и да го подобряваме.',
                        toggle: {
                            value: 'analytics',     // there are no default categories => you specify them
                            enabled: false,
                            readonly: false
                        },
                        cookie_table: [
                            {
                                col1: '^_ga',
                                col2: 'google.com',
                                col4: 'Бисквитка от Google, която служи за проследяване на посетените страници в сайта.',
                                is_regex: true
                            },
                            {
                                col1: '_ga_',
                                col2: 'google.com',
                                col4: 'Бисквитка от Google, която запазва анонимизирана статистика.',
                                is_regex: true
                            },
                            {
                                col1: '_gid',
                                col2: 'google.com',
                                col4: 'Бисквитка от Google, която служи за проследяване на посетените страници в сайта.',
                            },
                        ]
                    }, {
                        title: 'Маркетинг',
                        description: 'Тези бисквитки се създават през сайта ни от рекламните ни партньори. Използват се, за да създадат профил свързан с вашите интереси и да ви покажат най-подходящите за вас реклами на други сайтове.',
                        toggle: {
                            value: 'targeting',
                            enabled: false,
                            readonly: false
                        },
                        cookie_table: [
                            {
                                col1: '_fbp',
                                col2: 'facebook.com',
                                col4: 'Бисквитка от Facebook, която служи за проследяване на потребителите.',
                                is_regex: true
                            },
                        ]
                    },
                    // {
                    //     title: 'More information',
                    //     description: 'For any queries in relation to my policy on cookies and your choices, please <a class="cc-link" href="https://orestbida.com/contact">contact me</a>.',
                    // }
                ]
            }
        }
    }

});

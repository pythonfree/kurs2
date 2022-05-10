<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

if (!CModule::IncludeModule('iblock')) {
    return false; 
}

$arParameters = [
    'PARAMETERS' => [
        'FORM_ID' => [
            'NAME' => GetMessage('GD_RESUME_FORM_ID'),
            'TYPE' => 'STRING',
            'DEFAULT' => '1',
        ]
    ],
    'USER_PARAMETERS' => [
        'LINK' => [
            'NAME' => GetMessage('GD_RESUME_LINK'),
            'TYPE' => 'STRING',
            'DEFAULT' => 'http://kurs2.local/bitrix/admin/form_result_list.php?lang=ru&WEB_FORM_ID=1',
        ],
    ]
];
















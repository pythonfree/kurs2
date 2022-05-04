<?php

function agentCheckActions()
{

    if (!CModule::IncludeModule('iblock')) {
        die('Ошибка загрузки модуля iblock');
    };

//Получаем Активные акции с истекшей датой активности
    $arSelect = ["ID", "NAME", "DATE_ACTIVE_FROM", 'DATE_ACTIVE_TO'];
    $arFilter = [
        'IBLOCK_ID' => ACTIONS_IBLOCK_ID, //Акции
        "!ACTIVE_DATE" => "Y", //магия!  Чтобы выбрать все не активные по датам элементы, используется такой синтаксис
        "ACTIVE" => "Y"
    ];
    $BDRes = CIBlockElement::GetList(false, $arFilter, false, false, $arSelect);
    $arResult['FINISHED_ACTIONS'] = [];
    while ($finishedActionsCount = $BDRes->GetNext()) {
        $arResult['FINISHED_ACTIONS'][$finishedActionsCount['ID']] = $finishedActionsCount;
    }
//Получаем Активные акции с истекшей датой активности


//Изменяем активность для акции с истекшей датой активности
    if (!empty($arResult['FINISHED_ACTIONS'])) {
        foreach ($arResult['FINISHED_ACTIONS'] as $Id => $action) {
            $el = new CIBlockElement;
            if (!($res = $el->Update($Id, ["ACTIVE" => "N"]))) {
                echo $el->LAST_ERROR;
            } else {
                echo 'Акция c ID - ' . $Id . ' деактивирована.<br>';
            }
        }
    }
//Изменяем активность для акции с истекшей датой активности


//Получаем количество акций с истекшей датой активности
    $arSelect = ["ID", "NAME", "DATE_ACTIVE_FROM", 'DATE_ACTIVE_TO'];
    $arFilter = [
        'IBLOCK_ID' => ACTIONS_IBLOCK_ID, //Акции
        "!ACTIVE_DATE" => "Y", //магия!  Чтобы выбрать все не активные по датам элементы, используется такой синтаксис
    ];
    $BDRes = CIBlockElement::GetList(false, $arFilter, false, false, $arSelect);
    $finishedActionsCount = intval($BDRes->SelectedRowsCount());
//Получаем количество акций с истекшей датой активности

    if ($finishedActionsCount > 0) {
        if (!CModule::IncludeModule('main')) {
            die('Ошибка загрузки модуля main');
        };

        //запись в журнал событий
        CEventLog::Add([
            'SEVERITY' => 'INFO',
            'AUDIT_TYPE_ID' => 'CHECK_FINISHED_ACTIONS',
            'MODULE_ID' => 'iblock',
            'ITEM_ID' => '',
            'DESCRIPTION' => 'Проверка акций, в наличии - ' . $finishedActionsCount . ' окончившихся акций.',
        ]);

        //письмо администратору
        $filter = [
            "GROUPS_ID" => [GROUP_ADMIN_ID] //группа администраторов
        ];
        $rsUsers = CUser::GetList(($by = "personal_country"), ($order = "desc"), $filter);
        $arEmail = [];
        while ($arUser = $rsUsers->GetNext()) {
            $arEmail[] = $arUser['EMAIL'];
        }

        if (count($arEmail)) {
            $arEventFields = [
                'TEXT' => $finishedActionsCount,
                'EMAIL' => implode(', ', $arEmail),
            ];
            CEvent::Send("CHECK_ACTIONS", SITE_ID, $arEventFields);
        }
    }
    return "agentCheckActions();";
}
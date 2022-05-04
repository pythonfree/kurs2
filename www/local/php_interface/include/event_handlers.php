<?php

AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", ["CIBLockHandler", "OnBeforeIBlockElementUpdateHandler"]);
AddEventHandler("iblock", "OnBeforeIBlockElementDelete", ["CIBLockHandler", "OnBeforeIBlockElementDeleteHandler"]);


class CIBLockHandler
{

    function OnBeforeIBlockElementDeleteHandler($ID)
    {
        if (CModule::IncludeModule("iblock")) {
            $res = CIBlockElement::GetByID($ID);
            if ($ar_res = $res->GetNext()) {
                //деактивируем element по заданию вместо удаления если товар просмотрели более 1 раза
                if (intval($ar_res["SHOW_COUNTER"]) > 1) { //по заданию более 1 раза, здесь от 1 просмотра

                    $el = new CIBlockElement;
                    $arLoadProductArray = [
                        "ACTIVE" => "N"
                    ];
                    $el->Update($ID, $arLoadProductArray);

                    $GLOBALS['DB']->Commit();//Утверждение транзакции, поскольку return false в Административном разделе отменяет транзакцию

                    global $APPLICATION;
                    $APPLICATION->throwException("Вы удалили популярный товар с ID = {$ID}, его уже просмотрели - " . $ar_res["SHOW_COUNTER"] . ' раз!');
                    return false;
                }
            }
        }
    }

    function OnBeforeIBlockElementUpdateHandler(&$arFields)
    {
        global $APPLICATION;

        if ($arFields['IBLOCK_ID'] == NEWS_IBLOCK_ID) {//ИБ Новости
            if ($arFields['ACTIVE'] === 'N') {//Если новость была деактивирована
                //смотрим на Свежесть новости по заданию
                $date = DateTime::createFromFormat('d.m.Y', $arFields["ACTIVE_FROM"]);
                $now = new DateTime();
                $dayDiff = $date->diff($now)->format('%a');
                if (intval($dayDiff) <= 300) { //по заданию требуется сравнение до 3 дней, здесь до 300 дней
                    $APPLICATION->throwException("Вы деактивировали свежую новость");
                    return false;
                }
            }
        }
    }
}


AddEventHandler('main', 'OnBeforeUserUpdate', ['CMainHandler', 'OnBeforeUserUpdateHandler']);

class CMainHandler
{
    function OnBeforeUserUpdateHandler(&$arParams)
    {
        //Проверка, состоит ли пользователь в группе контент-редакторы до изменения профиля
        if (!in_array(CONTENT_EDITOR_GROUP_ID, CUser::GetUserGroup($arParams['ID']))) {
            //Действия, если пользователь не состоял в группе контент-редакторы до изменения профиля
            foreach ($arParams["GROUP_ID"] as $param) {
                //Проверяем, добавлен ли пользователь в группу контент-редакторы
                if ($param["GROUP_ID"] === CONTENT_EDITOR_GROUP_ID) {
                    //Действия, если пользователь добавлен в группу контент-редакторы

                    //Рассылка писем пользователям, входящим группу контент-редакторы
                    $filter = [
                        "GROUPS_ID" => [CONTENT_EDITOR_GROUP_ID] //группа контент-редакторы
                    ];
                    $rsUsers = CUser::GetList(($by = "personal_country"), ($order = "desc"), $filter);
                    $arEmail = [];
                    while ($arUser = $rsUsers->GetNext()) {
                        $arEmail[] = $arUser['EMAIL'];
                    }

                    if (count($arEmail)) {
                        $arEventFields = [
                            'TEXT' => 'В группу контент-редакторы добавлен новый участник с ID - ' . $arParams['ID'],
                            'EMAIL' => implode(', ', $arEmail),
                        ];
                        CEvent::Send("ADD_NEW_CONTENT_EDITOR", 's1', $arEventFields);
                    }

                    break;
                }
            }
        }
    }
}

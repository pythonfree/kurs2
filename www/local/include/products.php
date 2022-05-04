<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();


Bitrix\Main\Loader::includeModule("iblock");

$arSections = [];
$curPage = $APPLICATION->GetCurPage(false);
preg_match('/\/(\d+)\//', $curPage, $matches);
$arSections = is_null($matches[1]) ? ['!SECTION_ID' => false] : ['SECTION_ID' => $matches[1]];


$arFilter = ['IBLOCK_ID' => IBLOCK_PRODUCTS, 'ACTIVE' => 'Y', $arSections];
$res = CIBlockElement::GetList([], $arFilter, ['PROPERTY_MATERIAL'], false, []);
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    echo '<p>' . $arFields['PROPERTY_MATERIAL_VALUE']  .' - ' . $arFields['CNT'] . '</p>';
}

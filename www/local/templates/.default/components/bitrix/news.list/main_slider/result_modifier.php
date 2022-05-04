<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//dump($arResult['ITEMS'][0]);

$arTempID = [];
foreach ($arResult['ITEMS'] as $elem) {
    $arTempID[] = $elem['PROPERTIES']['LINK']['VALUE'];
}

$arSort = false;
$arFilter = [
    'IBLOCK_ID' => 2, //Продукция
    'ACTIVE' => 'Y',
    'ID' => $arTempID,
];
$arGroupBy = false;
$arNavStartParams = false;
$arSelect = ['ID', 'NAME', 'PROPERTY_PRICE', 'DETAIL_PICTURE', 'DETAIL_PAGE_URL'];
$BDRes = CIBlockElement::GetList(
    $arSort,
    $arFilter,
    $arGroupBy,
    $arNavStartParams,
    $arSelect
);
$arResult['LINK_ELEMENT'] = [];
while($arRes = $BDRes->GetNext()) {
    $arResult['LINK_ELEMENT'][$arRes['ID']] = $arRes;
}

foreach ($arResult['LINK_ELEMENT'] as $ID => $arItems) {
    $arImage = CFile::ResizeImageGet($arItems['DETAIL_PICTURE'],
        [
            'width' => $arParams['LIST_PREV_PICT_W'],
            'height' => $arParams['LIST_PREV_PICT_H'],
        ],
        BX_RESIZE_IMAGE_PROPORTIAL, true);
    $arResult['LINK_ELEMENT'][$ID]['PREVIEW_PICTURE'] = $arImage;
}

//dump($arResult['LINK_ELEMENT']);

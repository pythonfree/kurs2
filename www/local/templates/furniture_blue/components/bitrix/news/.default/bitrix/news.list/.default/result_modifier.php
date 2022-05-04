<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//dump($arResult);

foreach ($arResult['ITEMS'] as $ID => $arItems) {
    $arImage = CFile::ResizeImageGet($arItems['DETAIL_PICTURE'],
        [
        'width' => $arParams['LIST_PREV_PICT_W'],
        'height' => $arParams['LIST_PREV_PICT_H'],
        ],
        BX_RESIZE_IMAGE_PROPORTIAL, true);
    $arResult['ITEMS'][$ID]['PREVIEW_PICTURE'] = $arImage;
}

//echo '<pre>';
//var_dump($arResult['ITEMS'][0]['PREVIEW_PICTURE']);
//echo '</pre>';

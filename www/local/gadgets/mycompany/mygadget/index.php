<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die;

$arGadgetParams['FORM_ID'] = (int)$arGadgetParams['FORM_ID'];
$arGadgetParams['LINK'] = $arGadgetParams['LINK'] ?: 'http://kurs2.local/bitrix/admin/form_result_list.php?lang=ru&WEB_FORM_ID=1';

if (!(CModule::IncludeModule('iblock') && CModule::IncludeModule('form'))) {
    ShowError('Error load modules: iblock, form.');
    return;
}
?>

Всего резюме:
<a href="http://kurs2.local/bitrix/admin/form_result_list.php?lang=ru&WEB_FORM_ID=1&del_filter=Y" target="_blank">
    <?= CFormResult::GetCount($arGadgetParams['FORM_ID']) ?>
</a>

<?php
// Резюме сегодня
$currentDate = ConvertTimeStamp(false, 'SHORT');
$rsResults = CFormResult::GetList(
    $arGadgetParams['FORM_ID'],
    ($by = 's_date_create'),
    ($order = 'desc'),
    [
        'DATE_CREATE_1' => $currentDate,
        'DATE_CREATE_2' => $currentDate,
    ],
    $is_filtered,
    'Y',
    false
);
$result = [];
while ($arResult = $rsResults->Fetch()) {
    $result[$arResult['ID']] = $arResult['ID'];
}
?>

<p>
    Резюме сегодня:
    <a target="_blank"
        href="http://kurs2.local/bitrix/admin/form_result_list.php?PAGEN_1=1&SIZEN_1=20&lang=ru&WEB_FORM_ID=1&set_filter=Y&adm_filter_applied=0&find_date_create_1_FILTER_PERIOD=exact&find_date_create_1_FILTER_DIRECTION=previous&find_date_create_1=<?= $currentDate ?>&find_date_create_2=<?= $currentDate ?>">
        <?= count($result) ?>
    </a>
</p>

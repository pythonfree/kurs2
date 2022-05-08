<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$vacancyRes = CIBlockElement::GetByID($arParams['VACANT_ID']);
$vacancy = $vacancyRes->Fetch();
$arResult['VACANCY_NAME'] = $vacancy['NAME'];
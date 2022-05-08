<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="container mb-1">
    <h3>Наименование должности:</h3> <b><?= $arResult['NAME'] ?></b><br>
    <i>Дополнительная информация:</i>
    <ul>
        <li><?= $arResult['PROPERTIES']['VACANCY']['VALUE'] ?></li>
        <li><?= $arResult['PROPERTIES']['DESCRIPTION']['VALUE'] ?></li>
        <li><?= $arResult['PROPERTIES']['STAG']['VALUE'] ?></li>
        <li><?= $arResult['PROPERTIES']['WORKGRAPH']['VALUE'] ?></li>
        <li><?= $arResult['PROPERTIES']['EDUCATION']['VALUE'] ?></li>
    </ul>
</div>

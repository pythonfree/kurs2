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
use Bitrix\Main\UI\Extension;
Extension::load('ui.bootstrap4');
?>

<?php
    //Группируем вакансии по разделам ИБ Вакансии
    $arSections = [];
    foreach($arResult["ITEMS"] as $arItem) {
        $arSections[$arItem['IBLOCK_SECTION_ID']]['IBLOCK_SECTION_ID'] = $arItem['IBLOCK_SECTION_ID'];
        $arSections[$arItem['IBLOCK_SECTION_ID']]['IBLOCK_SECTION_NAME'] = $arItem['IBLOCK_SECTION_NAME'];

        $arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][$arItem['ID']]['ID'] = $arItem['ID'];
        $arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][$arItem['ID']]['EDIT_LINK'] = $arItem['EDIT_LINK'];
        $arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][$arItem['ID']]['DELETE_LINK'] = $arItem['DELETE_LINK'];
        $arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][$arItem['ID']]['IBLOCK_ID'] = $arItem['IBLOCK_ID'];
        $arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][$arItem['ID']]['DETAIL_PAGE_URL'] = $arItem['DETAIL_PAGE_URL'];
        $arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][$arItem['ID']]['NAME'] = $arItem['NAME'];
        $arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][$arItem['ID']]['VACANCY'] = $arItem['PROPERTY_VACANCY_VALUE'];
        $arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][$arItem['ID']]['DESCRIPTION'] = $arItem['PROPERTY_DESCRIPTION_VALUE'];
        $arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][$arItem['ID']]['STAG'] = $arItem['PROPERTY_STAG_VALUE'];
        $arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][$arItem['ID']]['WORKGRAPH'] = $arItem['PROPERTY_WORKGRAPH_VALUE'];
        $arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][$arItem['ID']]['EDUCATION'] = $arItem['PROPERTY_EDUCATION_VALUE'];
    }
//    echo '<pre>';
//    print_r($arSections);
//    echo '</pre>';
?>

<?php foreach ($arSections as $section): ?>
<div class="container mb-1">
    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#d<?= $section['IBLOCK_SECTION_ID'] ?>">
        <?= $section['IBLOCK_SECTION_NAME'] ?>
    </button>
    <div id="d<?= $section['IBLOCK_SECTION_ID'] ?>" class="collapse">
        <ul>
            <?php foreach ($section['ITEMS'] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
            <li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <h3>Наименование должности:</h3> <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><b><?= $arItem['NAME'] ?></b></a> <br>
                <i>Дополнительная информация:</i>
                <ul>
                    <li><?= $arItem['VACANCY'] ?></li>
                    <li><?= $arItem['DESCRIPTION'] ?></li>
                    <li><?= $arItem['STAG'] ?></li>
                    <li><?= $arItem['WORKGRAPH'] ?></li>
                    <li><?= $arItem['EDUCATION'] ?></li>
                </ul>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php endforeach; ?>
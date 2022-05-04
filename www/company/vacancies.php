<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вакансии");
?>

<?$APPLICATION->IncludeComponent(
	"mycomponents:vacancies.list", 
	"vacancies.list", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "300",
		"CACHE_TYPE" => "N",
		"COMPONENT_TEMPLATE" => "vacancies.list",
		"DETAIL_URL" => "",
		"FIELD_CODE" => array(
			0 => "",
			1 => "PROPERTY_DESCRIPTION",
			2 => "PROPERTY_STAG",
			3 => "PROPERTY_WORKGRAPH",
			4 => "PROPERTY_EDUCATION",
			5 => "PROPERTY_VACANCY",
			6 => "",
		),
		"IBLOCKS" => "4",
		"IBLOCK_TYPE" => "vacancies",
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "IBLOCK_SECTION_ID",
		"SORT_BY2" => "",
		"SORT_ORDER1" => "",
		"SORT_ORDER2" => ""
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
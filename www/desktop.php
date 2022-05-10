<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Рабочий стол");
?><?$APPLICATION->IncludeComponent(
	"bitrix:desktop",
	"",
	Array(
		"CAN_EDIT" => "Y",
		"COLUMNS" => "3",
		"COLUMN_WIDTH_0" => "33%",
		"COLUMN_WIDTH_1" => "33%",
		"COLUMN_WIDTH_2" => "33%",
		"GADGETS" => array("MYGADGET"),
		"GU_FAVORITES_TITLE_STD" => "",
		"GU_HTML_AREA_TITLE_STD" => "",
		"GU_MYGADGET_ELEMENT_COUNT" => "link",
		"GU_MYGADGET_LINK" => "link...",
		"GU_MYGADGET_SHOW_UNACTIVE_ELEMENTS" => "N",
		"GU_MYGADGET_TITLE_STD" => "Резюме",
		"GU_PROBKI_CITY" => "c213",
		"GU_PROBKI_TITLE_STD" => "",
		"GU_PRODUCTS_ELEMENT_COUNT" => "5",
		"GU_PRODUCTS_SHOW_UNACTIVE_ELEMENTS" => "N",
		"GU_PRODUCTS_TITLE_STD" => "",
		"GU_RSSREADER_CNT" => "10",
		"GU_RSSREADER_IS_HTML" => "N",
		"GU_RSSREADER_RSS_URL" => "",
		"GU_RSSREADER_TITLE_STD" => "",
		"GU_WEATHER_CITY" => "",
		"GU_WEATHER_COUNTRY" => "",
		"GU_WEATHER_TITLE_STD" => "",
		"GU_WORKFLOW_TITLE_STD" => "",
		"G_MYGADGET_FORM_ID" => "1",
		"G_MYGADGET_IBLOCK_ID" => "1",
		"G_PROBKI_CACHE_TIME" => "3600",
		"G_PROBKI_SHOW_URL" => "N",
		"G_PRODUCTS_IBLOCK_ID" => "",
		"G_RSSREADER_CACHE_TIME" => "0",
		"G_RSSREADER_PREDEFINED_RSS" => "",
		"G_RSSREADER_SHOW_URL" => "N",
		"G_WEATHER_CACHE_TIME" => "3600",
		"G_WEATHER_SHOW_URL" => "N",
		"ID" => "holder1"
	)
);?>

<?//$APPLICATION->IncludeComponent("bitrix:form.result.list", "desktop", Array(
//	"CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
//		"CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
//		"EDIT_URL" => "result_edit.php",	// Страница редактирования результата
//		"NAME_TEMPLATE" => "",
//		"NEW_URL" => "result_new.php",	// Страница добавления результата
//		"NOT_SHOW_FILTER" => array(	// Коды полей которые нельзя показывать в фильтре
//			0 => "",
//			1 => "",
//			2 => "",
//		),
//		"NOT_SHOW_TABLE" => array(	// Коды полей которые нельзя показывать в таблице
//			0 => "",
//			1 => "",
//			2 => "",
//		),
//		"SEF_FOLDER" => "/",	// Каталог ЧПУ (относительно корня сайта)
//		"SEF_MODE" => "Y",	// Включить поддержку ЧПУ
//		"SHOW_ADDITIONAL" => "N",	// Показать дополнительные поля веб-формы
//		"SHOW_ANSWER_VALUE" => "N",	// Показать значение параметра ANSWER_VALUE
//		"SHOW_STATUS" => "N",	// Показать текущий статус результата
//		"VARIABLE_ALIASES" => array(
//			"view" => "",
//			"edit" => "",
//		),
//		"VIEW_URL" => "result_view.php",	// Страница просмотра результата
//		"WEB_FORM_ID" => "1",	// ID веб-формы
//	),
//	false
//);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
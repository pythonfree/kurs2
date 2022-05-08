<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

// Массив настроек ЧПУ по умолчанию
$arDefaultUrlTemplates404 = array(
	"vacancies" => "",
	"vacancy" => "#VACANT_ID#/",
	"rezume" => "#VACANT_ID#/resume/",
);

$arDefaultVariableAliases404 = [
    'vacancy' => [
        'VACANT_ID' => 'VID'
    ],
    'rezume' => [
        'FORM_ID' => 'FID'
    ],
];

$arDefaultVariableAliases = array();

// Массив переменных по умолчанию
$arComponentVariables = array(
	"FORM_ID",
	"VACANT_ID",
	"ELEMENT_CODE",
);

if($arParams["SEF_MODE"] == "Y")
{
	$arVariables = [];

    // Массив шаблонов URL - адресов
	$arUrlTemplates = CComponentEngine::makeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams["SEF_URL_TEMPLATES"]);

	$arVariableAliases = CComponentEngine::makeComponentVariableAliases($arDefaultVariableAliases404, $arParams["VARIABLE_ALIASES"]);

	$engine = new CComponentEngine($this);
	if (CModule::IncludeModule('iblock'))
	{
		$engine->addGreedyPart("#SECTION_CODE_PATH#");
		$engine->setResolveCallback(array("CIBlockFindTools", "resolveComponentEngine"));
	}
	$componentPage = $engine->guessComponentPath(
		$arParams["SEF_FOLDER"],
		$arUrlTemplates,
		$arVariables
	);

	if(!$componentPage)
	{
		$componentPage = "vacancies"; // Шаблон страницы по умолчанию, если вдруг не удалось определить по шаблонам
	}

	CComponentEngine::initComponentVariables($componentPage, $arComponentVariables, $arVariableAliases, $arVariables);

	$arResult = array(
		"FOLDER" => $arParams["SEF_FOLDER"],
		"URL_TEMPLATES" => $arUrlTemplates,
		"VARIABLES" => $arVariables,
		"ALIASES" => $arVariableAliases,
	);

} else {
    // Массив с адресами страниц для не ЧПУ режима
	$arVariableAliases = CComponentEngine::makeComponentVariableAliases($arDefaultVariableAliases, $arParams["VARIABLE_ALIASES"]);
	CComponentEngine::initComponentVariables(false, $arComponentVariables, $arVariableAliases, $arVariables);

	$componentPage = "";

	if(isset($arVariables["ELEMENT_ID"]) && intval($arVariables["ELEMENT_ID"]) > 0)
		$componentPage = "vacancy";
	elseif(isset($arVariables["ELEMENT_CODE"]) && $arVariables["ELEMENT_CODE"] <> '')
		$componentPage = "vacancy";
	elseif(
        isset($arVariables["REZUME_ID"])
        && intval($arVariables["REZUME_ID"]) > 0
        && ($arVariables["ELEMENT_ID"])
        && intval($arVariables["ELEMENT_ID"]) > 0
    )
        $componentPage = "rezume";
	else
        $componentPage = "vacancies";


	$arResult = array(
		"FOLDER" => "",
		"URL_TEMPLATES" => array(
			"vacancies" => htmlspecialcharsbx($APPLICATION->GetCurPage()),
			"vacancy" => htmlspecialcharsbx($APPLICATION->GetCurPage()."?".$arVariableAliases["ELEMENT_ID"]."=#ELEMENT_ID#"),
			"rezume" => htmlspecialcharsbx($APPLICATION->GetCurPage()."?".$arVariableAliases["FORM_ID"]."=#FORM_ID#"),
		),
		"VARIABLES" => $arVariables,
		"ALIASES" => $arVariableAliases
	);
}

$this->includeComponentTemplate($componentPage); // Передаем название файла шаблона
<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class SelectOperation extends CWizardStep
{
    function InitStep()
    {
        $this->SetStepID('select_operation');

        $this->SetTitle(GetMessage("SO_INIT_TITLE"));
        $this->SetSubTitle(GetMessage("SO_INIT_SUBTITLE"));

        $this->SetNextStep("enter_first_num");
    }

    function ShowStep() {
        $this->content .= "<table class='wizard-data-table'>";
        $this->content .= "<tr><th align = 'right'><span class='wizard-required'>*</span>" . GetMessage('SO_SS_CHOOSE_OPERATOR') . "</th><td>";

        $operations = [
            'sum' => '+',
            'sub' => '-',
            'mult' => '*',
            'div' => '/'
        ];
        $this->content .= WizardTools::ShowSelectField($this, "OPERATOR", array_flip($operations)) . "</td></tr>";


        $this->content .= "</td></tr>";
        $this->content .= "</table>";
        $this->content .= "<br/><div class='wizard-note-box'><span class='wizard-required'>*</span>" . GetMessage('REQ_FIELDS') . "</div>";

    }

    function OnPostForm() {
        $wizard =& $this->GetWizard();
        $operator = $wizard->GetVar("OPERATOR");
        if (empty($operator)) {
            $this->SetError('Выберите тип операции', 'OPERATOR');
        }
    }
}


class EnterFirstNum extends CWizardStep
{
    function InitStep()
    {
        $this->SetStepID('enter_first_num');

        $this->SetTitle(GetMessage("EFN_INIT_TITLE"));
        $this->SetSubTitle(GetMessage("EFN_INIT_SUBTITLE"));

        $this->SetPrevStep("select_operation");
        $this->SetNextStep("enter_second_num");
    }

    function ShowStep()
    {
        $this->content .= "<table class='wizard-data-table'>";
        $this->content .= "<tr><th align='right'><span class='wizard-required'>*</span>" . 'Введите число:' . "</th><td>" . $this->ShowInputField("text", "F_OPERAND", ["size" => 25]) . "</td></tr>";
        $this->content .= "</table>";
        $this->content .= "<br/><div class='wizard-note-box'><span class='wizard-required'>*</span>" . GetMessage('REQ_FIELDS') . "</div>";
    }

    function OnPostForm()
    {
        $wizard =& $this->GetWizard();
        $fOperand = $wizard->GetVar("F_OPERAND");
        if (empty((int)$fOperand)) {
            $this->SetError('Не удалось получить число.', 'F_OPERAND');
        }
    }
}

class EnterSecondNum extends CWizardStep
{
    function InitStep()
    {
        $this->SetStepID('enter_second_num');

        $this->SetTitle(GetMessage("ESN_INIT_TITLE"));
        $this->SetSubTitle(GetMessage("ESN_INIT_SUBTITLE"));

        $this->SetPrevStep("enter_first_num");
        $this->SetNextStep("show_operation");
    }

    function ShowStep()
    {
        $this->content .= "<table class='wizard-data-table'>";
        $this->content .= "<tr><th align='right'><span class='wizard-required'>*</span>" . 'Введите число:' . "</th><td>" . $this->ShowInputField("text", "S_OPERAND", ["size" => 25]) . "</td></tr>";
        $this->content .= "</table>";
        $this->content .= "<br/><div class='wizard-note-box'><span class='wizard-required'>*</span>" . GetMessage('REQ_FIELDS') . "</div>";
    }

    function OnPostForm()
    {
        $wizard =& $this->GetWizard();
        $sOperand = $wizard->GetVar("S_OPERAND");
        if (empty((int)$sOperand)) {
            $this->SetError('Не удалось получить число.', 'S_OPERAND');
        }
    }
}

class ShowOperation extends CWizardStep
{
    function InitStep()
    {
        $this->SetStepID('show_operation');

        $this->SetTitle(GetMessage("SHO_INIT_TITLE"));
        $this->SetSubTitle(GetMessage("SHO_INIT_SUBTITLE"));

        $this->SetPrevStep("enter_second_num");
        $this->SetFinishStep("calc_log_showresult");
        $this->SetFinishCaption(GetMessage("SHO_INIT_FINISH_CAPTION"));
    }

    function ShowStep()
    {
        $wizard =& $this->GetWizard();
        $fOperand = $wizard->GetVar("F_OPERAND");
        $sOperand = $wizard->GetVar("S_OPERAND");
        $operator = $wizard->GetVar("OPERATOR");

        $this->content .= "<table class='wizard-data-table'>";
        $this->content .= "<tr><th align='right'>" . 'Операция:' . "</th><td>" . $fOperand  . ' ' . $operator . ' ' . $sOperand . "</td></tr>";
        $this->content .= "</table>";
    }

    function OnPostForm()
    {
        $wizard =& $this->GetWizard();
        $sOperand = $wizard->GetVar("S_OPERAND");
        if (empty((int)$sOperand)) {
            $this->SetError('Не удалось получить число.', 'S_OPERAND');
        }
    }

}

class CalcLogShowResult extends CWizardStep
{
    function InitStep()
    {
        $this->SetStepID('calc_log_showresult');

        $this->SetTitle(GetMessage("CSLSR_INIT_TITLE"));
        $this->SetSubTitle(GetMessage("CSLSR_INIT_SUBTITLE"));

        $this->SetCancelStep("calc_log_showresult");
        $this->SetCancelCaption(GetMessage("CSLSR_INIT_CANCEL_CAPTION"));
    }
}

// Вспомогательные методы
class WizardTools
{
    public static function ShowSelectField($obj, $name, $arValues = [], $arAttributes = [])
    {
        $wizard = $obj->GetWizard();
        $obj->SetDisplayVars([$name]);

        $varValue = $wizard->GetVar($name);
        $selectedValues = (
        $varValue !== null && $varValue != "" ?
            $varValue :
            (
            $varValue === "" ?
                [] :
                $wizard->GetDefaultVar($name)
            )
        );

        if (!is_array($selectedValues))
            $selectedValues = [$selectedValues];

        $prefixName = $wizard->GetRealName($name);
        $strReturn .= '<select name="'.htmlspecialcharsbx($prefixName).'"'.$obj->_ShowAttributes($arAttributes).'>';

        foreach ($arValues as $optionValue => $optionName)
            $strReturn .= '<option value="'.htmlspecialcharsEx($optionValue).'"'.(in_array($optionValue, $selectedValues) ? " selected=\"selected\"" :"").'>'.htmlspecialcharsEx($optionName).'</option>
        ';

        $strReturn .= '</select>';

        return $strReturn;
    }
}


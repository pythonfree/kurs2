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

    function showStep() {
        $this->content .= "<table class='wizard-data-table'>";
        $this->content .= "<tr><th align = 'right'><span class='wizard-required'>*</span>" . GetMessage('SO_SS_CHOOSE_OPERATOR') . "</th><td>";
        $this->content .= '<select name="operator">';
        $operations = [
            'summ' => '+',
            'sub' => '-',
            'mult' => '*',
            'div' => '/'
        ];
        foreach ($operations as $opKey => $opVal) {
            $this->content .= '<option value="' . $opKey . '">' . $opVal . '</option>';
        }
        $this->content .= '</select>';
        $this->content .= "</td></tr>";
        $this->content .= "</table>";
        $this->content .= "<br/><div class='wizard-note-box'><span class='wizard-required'>*</span>" . GetMessage('SO_SS_REQ_FIELDS') . "</div>";
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
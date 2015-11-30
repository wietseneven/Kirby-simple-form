<?php
class simpleForm {
	public $formName;

	function __construct($formName, $formFields, $submitText) {
		$this->formName     = $formName;
		$this->formFields   = $formFields;
		if ($submitText) {
			$this->submitText = $submitText;
		} else {
			$this->submitText = 'Submit';
		}
	}

	function processFields() {
		$formInputs = array();
		$this->formFields = explode(',', $this->formFields);
		foreach ($this->formFields as $formField):
			$formField = explode(':', $formField);
			$fieldClasses = explode('.', $formField[2]);

			$required = '';
			if (in_array('required', $fieldClasses)) {
				$required = 'required';
			}

			$thisField = array(
				'type'      =>  preg_replace('/\s+/', '', $formField[0]),
				'name'      =>  preg_replace('/\s+/', '', $formField[1]),
				'required'  =>  $required,
				'classes'   =>  join(' ', $fieldClasses)
			);

			array_push($formInputs, $thisField);
		endforeach;

		return $formInputs;
	}

	function renderFields() {
		$formFields = '';
		foreach ($this->processFields() as $formField):
			switch($formField['type']):
				case 'textarea':
					$formFields .= '<textarea
						name="'.$formField['name'].'"
						placeholder="'.$formField['name'].'"
						class="'. $formField['classes'] .'"
						'.$formField['required'].'
						></textarea>';
					break;
				default:
					$formFields .= '<input
						name="'.$formField['name'].'"
						type="'.$formField['type'].'"
						placeholder="'.$formField['name'].'"
						class="'. $formField['classes'] .'"
						'.$formField['required'].'
						>';
					break;
			endswitch;
		endforeach;

		$formFields .= '<input
			type="submit"
			value="'.$this->submitText.'"
			>';
		return $formFields;
	}

	public function createForm(){
		$form = '<form action="#'.$this->formName.'" id="'.$this->formName.'" method="post">';
		$form .= $this->renderFields();
		$form .= '</form>';
		return $form;
	}
}
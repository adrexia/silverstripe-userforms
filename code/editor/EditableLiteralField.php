<?php

/**
 * Editable Literal Field. A literal field is just a blank slate where
 * you can add your own HTML / Images / Flash
 * 
 * @package userforms
 */

class EditableLiteralField extends EditableFormField {
	
	static $singular_name = 'HTML Block';
	
	static $plural_name = 'HTML Blocks';
	
	function getFieldConfiguration() {
		return new FieldSet(
			new TextareaField(
				"Fields[$this->ID][CustomSettings][Content]", 
				"HTML", 4, 20, $this->getSetting('Content')
			),
			new CheckboxField(
				"Fields[$this->ID][CustomSettings][HideFromReports]", 
				_t('EditableLiteralField.HIDEFROMREPORT', 'Hide from reports?'), 
				$this->getSetting('HideFromReports')
			)
		);
	}

	function getFormField() {
		return new LiteralField("LiteralField[$this->ID]", 
			"<div id='$this->Name' class='field text'>
				<label class='left'>$this->Title</label>
				<div class='middleColumn literalFieldArea'>". $this->getSetting('Content') ."</div>".
			"</div>"
		);
	}
	
	function showInReports() {
		if($this->getSetting('HideFromReports')) {
			return false;
		}
		
		return true;
	}
}
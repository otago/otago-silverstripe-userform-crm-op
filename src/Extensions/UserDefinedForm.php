<?php

namespace OP\Extensions;

use OP\Models\CRMKeyValue;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\ORM\DataExtension;

class UserDefinedForm extends DataExtension
{
    private static $many_many = [
        'KeyValues' => CRMKeyValue::class
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab(
            'Root.CRM',
            [
                GridField::create('KeyValues', 'CRM Keys & Values', $this->owner->KeyValues())->setConfig(
                    (GridFieldConfig_RecordEditor::create())
                )
            ]
        );
    }
}

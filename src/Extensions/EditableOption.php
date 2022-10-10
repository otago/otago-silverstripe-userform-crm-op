<?php

namespace OP\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;

class EditableOption extends DataExtension
{
    private static $db = [
        'CRMKey' => 'Varchar(255)'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab(
            'Root.CRM',
            [
                TextField::create('CRMKey')
            ]
        );
    }
}

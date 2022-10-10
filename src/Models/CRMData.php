<?php

namespace OP\Models;

use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\FieldType\DBDatetime;
use SilverStripe\UserForms\Model\Submission\SubmittedForm;

class CRMData extends DataObject
{
    private static $table_name = 'CRMData';

    private static $singular_name = 'CRM Data';
    private static $plural_name = 'CRM Data';

    private static $db = [
        'Status' => 'Int',
        'JSON' => 'Text',
        'Headers' => 'Text',
        'Body' => 'Text',
        'Synced' => DBDatetime::class
    ];

    private static $has_one = [
        'SubmittedForm' => SubmittedForm::class
    ];

    private static $summary_fields = [
        'ID' => 'ID',
        'Status' => 'Status',
        'SubmittedFormID' => 'Submitted Form ID',
        'Created' => 'Created',
        'LastEdited' => 'Last Edited',
        'Synced' => 'Synced'
    ];

    private static $default_sort = 'Created DESC';
}

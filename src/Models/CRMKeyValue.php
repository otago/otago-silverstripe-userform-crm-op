<?php

namespace OP\Models;

use SilverStripe\ORM\DataObject;

class CRMKeyValue extends DataObject
{
    private static $table_name = 'CRMKeyValue';

    private static $singular_name = 'CRM Key & Value';
    private static $plural_name = 'CRM Keys & Values';

    private static $db = [
        'CRMKey' => 'Varchar(255)',
        'CRMValue' => 'Varchar(255)'
    ];

    private static $summary_fields = [
        'CRMKey' => 'Key',
        'CRMValue' => 'Value',
    ];

    public function getTitle()
    {
        return $this->CRMValue;
    }

    private static $default_sort = "CRMKey ASC";
}

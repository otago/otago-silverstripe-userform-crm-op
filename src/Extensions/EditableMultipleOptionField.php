<?php

namespace OP\Extensions;

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;
use Symbiote\GridFieldExtensions\GridFieldEditableColumns;

class EditableMultipleOptionField extends DataExtension
{
    public function updateCMSFields(FieldList $fields)
    {
        $options_field = $fields->fieldByName("Root.Options.Options");
        $editable_columns = $options_field->getConfig()->getComponentByType(GridFieldEditableColumns::class);
        $editable_columns->setDisplayFields([
            'Title' => [
                'title' => _t(EditableMultipleOptionField::class.'.TITLE', 'Title'),
                'callback' => function ($record, $column, $grid) {
                    return TextField::create($column);
                }
            ],
            'Value' => [
                'title' => _t(EditableMultipleOptionField::class.'.VALUE', 'Value'),
                'callback' => function ($record, $column, $grid) {
                    return TextField::create($column);
                }
            ],
            'CRMKey' => [
                'title' => 'CRM Key', 'CRMKey',
                'callback' => function ($record, $column, $grid) {
                    return TextField::create($column);
                }
            ],
            'Default' => [
                'title' => _t(EditableMultipleOptionField::class.'.DEFAULT', 'Selected by default?'),
                'callback' => function ($record, $column, $grid) {
                    return CheckboxField::create($column);
                }
            ],
        ]);
    }
}

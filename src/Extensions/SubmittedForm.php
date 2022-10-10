<?php

namespace OP\Extensions;

use Exception;
use OP\Models\CRMData;
use OP\Services\CRMService;
use SilverStripe\Core\Environment;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\FieldType\DBDatetime;
use SilverStripe\UserForms\Model\EditableFormField\EditableMultipleOptionField;

class SubmittedForm extends DataExtension
{
    public function updateAfterProcess()
    {
        $array = [];
        foreach ($this->owner->Values() as $value) {
            if ($value->getEditableField()->CRMKey) {
                if (array_key_exists(
                    strtolower(EditableMultipleOptionField::class),
                    $value->getEditableField()->getClassAncestry()
                )) {
                    $array[$value->getEditableField()->CRMKey] = array_reduce(
                        $value->getEditableField()->Options()->toArray(),
                        function ($carry, $next) use ($value) {
                            if ($value->Value == $next->Title) {
                                return $next->CRMKey;
                            }
                            return $carry;
                        },
                        null
                    );
                } else {
                    $array[$value->getEditableField()->CRMKey] = $value->Value;
                }
            }
        }
        foreach ($this->owner->Parent()->KeyValues() as $key_value) {
            $array[$key_value->CRMKey] = $key_value->CRMValue;
        }
        $service = new CRMService();
        $result = $service->request(
            Environment::getEnv("CRM_DATA_DESTINATION"),
            "POST",
            $array
        );
        if ($result->getStatus() >= 300) {
            throw new Exception("CRM Sync Failed");
        }
    }
}

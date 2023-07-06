<?php namespace App\Http\Controllers\Modules\Enums;

use App\Helpers\Enum;

class WorkflowEnum extends Enum
    {
        const Create        = 'Create';
        const Delete        = 'Delete';
        const Update        = 'Update';
        const Saved         = 'Saved';
        const FIRST_SAVE            = 'FIRST_SAVE';
        const FIRST_TIME_CONDITION  = 'FIRST_TIME_CONDITION';
        const EVERY_TIME_SAVED      = 'EVERY_TIME_SAVED';
        const EVERY_TIME_MODIFIED   = 'EVERY_TIME_MODIFIED';
        const SCHEDULE              = 'SCHEDULE';
        //For Conditions
        const ANY_CONDITION = 'Any Condition'; 
        const ALL_CONDITION = 'All Condition';

        const IS_EQUAL = 'Is Equal'; 
        const IS_NOT_EQUAL = 'Is Not Equal'; 
        const CONTAIN = 'Contain'; 
        const DOSE_NOT_CONTAIN = 'Does Not Contain'; 
        const START_WITH = 'Starts With'; 
        const END_WITH = 'Ends With'; 
        const IS_EMPTY = 'Is Empty'; 
        const IS_NOT_EMPTY = 'Is Not Empty'; 
    }
?>

<?php

namespace DcodeGroup\Gantt;


class MobileInfo extends DcodeGroupBase
{
    /**
     * @var \DcodeGroup\Gantt\RowSubGroup
     */
    public $subGroup;

    public function defaultTemplate()
    {
        return 'mobileInfo';
    }
}
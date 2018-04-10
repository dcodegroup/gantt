<?php

namespace DcodeGroup\Gantt;


class RowLabel extends DcodeGroupBase
{
    /**
     * @var \DcodeGroup\Gantt\Row
     */
    public $row;

    public function defaultTemplate()
    {
        return 'rowLabel';
    }
}
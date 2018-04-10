<?php

namespace DcodeGroup\Gantt;


class ColumnsHeader extends DcodeGroupBase
{
    /**
     * @var \DcodeGroup\Gantt\Gantt
     */
    public $gantt;

    public function defaultTemplate()
    {
        return 'columnsHeader';
    }
}
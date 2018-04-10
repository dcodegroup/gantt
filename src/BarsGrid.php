<?php

namespace DcodeGroup\Gantt;


class BarsGrid extends DcodeGroupBase
{
    /**
     * @var \DcodeGroup\Gantt\Row|\DcodeGroup\Gantt\RowSubGroup|\DcodeGroup\Gantt\RowGroup
     */
    public $row;

    /**
     * @var \DcodeGroup\Gantt\Gantt
     */
    public $gantt;

    public function __construct($row, Gantt $gantt)
    {
        $this->row = $row;
        $this->gantt = $gantt;
    }

    public function defaultTemplate()
    {
        return 'barsGrid';
    }

    /**
     * @return \DcodeGroup\Gantt\Bar[]
     */
    public function bars()
    {
        return (property_exists($this->row, 'bars'))
            ? $this->row->bars
            : [$this->row->bar];
    }
}
<?php

namespace DcodeGroup\Gantt;


class RowSubGroup extends DcodeGroupBase
{

    /**
     * @var \DcodeGroup\Gantt\Row[]
     */
    public $rows = [];

    /**
     * @var \DcodeGroup\Gantt\RowLabel
     */
    public $rowLabel;

    /**
     * UP ref
     * @var \DcodeGroup\Gantt\RowGroup
     */
    public $rowGroup;

    /**
     * @var \DcodeGroup\Gantt\Column|NULL
     */
    public $startColumn;

    /**
     * @var \DcodeGroup\Gantt\Column|NULL
     */
    public $endColumn;

    /**
     * @var \DcodeGroup\Gantt\Bar
     */
    public $bar;

    /**
     * @var \DcodeGroup\Gantt\MobileInfo
     */
    public $mobileInfo;

    /**
     * @var string
     */
    public $headRowCssClass = '';

    public function defaultTemplate()
    {
        return 'rowSubGroup';
    }

    /**
     * called after all rows set
     */
    public function calculateTotals()
    {
        $this->bar->setPointsFromChildBars($this->rows);
    }

    /**
     * @return BarsGrid
     */
    public function barsGrid()
    {
        if ($this->_barsGrid === null) {
            $this->_barsGrid = new BarsGrid($this, $this->rowGroup->gantt);
        }
        return $this->_barsGrid;
    }
    private $_barsGrid;
}
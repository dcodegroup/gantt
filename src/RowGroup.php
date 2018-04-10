<?php

namespace DcodeGroup\Gantt;


class RowGroup extends DcodeGroupBase
{
    public $icon;
    public $label;
    public $barText;
    public $labelHref;

    /**
     * @var \DcodeGroup\Gantt\RowSubGroup[]
     */
    public $rowSubGroups = [];

    /**
     * index for this instance within $gantt->columnGroups
     * @var int
     */
    public $i;

    /**
     * @var \DcodeGroup\Gantt\Bar
     */
    public $bar;

    /**
     * UP ref
     * @var \DcodeGroup\Gantt\Gantt
     */
    public $gantt;

    /**
     * NB set in $this->calculateTotals() NEVER externally
     * @var int
     */
    public $tasks = 0;

    /**
     * @var \DcodeGroup\Gantt\Column|NULL
     */
    public $startColumn;

    /**
     * @var \DcodeGroup\Gantt\Column|NULL
     */
    public $endColumn;

    public function defaultTemplate()
    {
        return 'rowGroup';
    }

    /**
     * called after all rows set
     */
    public function calculateTotals()
    {
        $this->bar->setPointsFromChildBars($this->rowSubGroups);
    }

    /**
     * @return BarsGrid
     */
    public function barsGrid()
    {
        if ($this->_barsGrid === null) {
            $this->_barsGrid = new BarsGrid($this, $this->gantt);
        }
        return $this->_barsGrid;
    }
    private $_barsGrid;
}
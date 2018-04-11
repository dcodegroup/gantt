<?php

namespace DcodeGroup\Gantt;


class RowGroup extends DcodeGroupBase
{
    /**
     * @var \DcodeGroup\Gantt\RowLabel
     */
    public $rowLabel;

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


    public function tasksText()
    {
        if ($this->_tasksText === null) {
            $total_tasks = $this->bar->tasks;
            if ($total_tasks === null) {
                $this->_tasksText = false;
            } else {
                $this->_tasksText = '(' .$total_tasks . ' ' . str_plural('Task', $total_tasks) .')';
            }
        }
        return $this->_tasksText;
    }
    private $_tasksText;
}
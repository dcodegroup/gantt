<?php

namespace DcodeGroup\Gantt;


class Gantt extends DcodeGroupBase
{
    /**
     * @var array
     */
    public $config = [];

    /**
     * @var \DcodeGroup\Gantt\Column[$dayIso]
     */
    public $columns = [];

    /**
     * @var \DcodeGroup\Gantt\Column
     */
    public $firstCol;

    /**
     * @var \DcodeGroup\Gantt\Column
     */
    public $lastCol;

    /**
     * @var \DcodeGroup\Gantt\ColumnGroup[]
     */
    public $columnGroups = [];

    /**
     * @var \DcodeGroup\Gantt\ColumnsHeader
     */
    public $columnsHeader;

    /**
     * percentage
     * @var float
     */
    public $columnWidth;

    /**
     * @var \DcodeGroup\Gantt\RowGroup[]
     */
    public $rowGroups = [];

    /**
     * @var bool
     */
    public $isMobile = false;

    /**
     * @var null|callable func($bar)
     */
    public $barTextFunction;

    /**
     * @var null|callable func($bar)
     */
    public $barTitleAttrFunction;

    /**
     * @var null|callable func($bar)
     */
    public $barDataTextAttrFunction;



    public $barTitleAttrs = true;
    public $barTextShow = true;

    public function defaultTemplate()
    {
        return ($this->config['isMobile'])? 'mobile-gantt' : 'gantt';
    }

    /**
     * needs to be done after all columns set and before rendering
     */
    public function calculateColumns()
    {
        $n = count($this->columns);
        $i = 0;
        foreach ($this->columns as $col) {
            if ($this->firstCol === null) $this->firstCol = $col;
            $this->lastCol = $col;
            $col->setLeftPos($i, $n);
            $i++;
        }
        foreach ($this->columnGroups as $colGroup) {
            $colGroup->setLeftPos();
        }
        $this->columnWidth = 100 / $n;
    }
}
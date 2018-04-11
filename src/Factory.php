<?php

namespace DcodeGroup\Gantt;


class Factory
{

    public static function newGantt($columnGroupsData, $row_groups_data, $config = [])
    {
        $config = array_merge([
            'isMobile'              => false,
            'labelCol'              => 'Project Name',
            'expandIcon'            => 'fal',
            'expandIconOpen'        => 'fa-plus',
            'expandIconClose'       => 'fa-minus',
            'expandIconMobile'      => 'fal',
            'expandIconOpenMobile'  => 'fa-chevron-down',
            'expandIconCloseMobile' => 'fa-chevron-up',
            'rowIcon'               => 'fal fa-circle',
        ], $config);
        $gantt = new Gantt;
        $gantt->config = $config;
        $gantt->columnsHeader = self::newColumnsHeader($gantt);
        foreach ($columnGroupsData as $columnGroupData) {
            $colGroup = self::newColumnGroup($columnGroupData, $gantt);
            $gantt->columnGroups[] = $colGroup;
        }
        $gantt->calculateColumns();
        foreach ($row_groups_data as $row_group_data) {
            $rowGroup = self::newRowGroup($row_group_data, $gantt);
            $gantt->rowGroups[] = $rowGroup;
            $rowGroup->i = count($gantt->rowGroups) - 1;
        }
        $gantt->headRowLabel = self::newRowLabel([
            'text'              => $config['labelCol'],
            'expandIcon'        => $config['expandIcon'],
            'expandIconOpen'    => $config['expandIconOpen'],
        ]);
        return $gantt;
    }

    public static function newColumnsHeader(Gantt $gantt)
    {
        $columnsHeader = new ColumnsHeader();
        $columnsHeader->gantt = $gantt;
        return $columnsHeader;
    }

    public static function newRowLabel($props)
    {
        $rowLabel = new RowLabel();
        foreach ($props as $pname => $val) {
            $rowLabel->$pname = $val;
        }
        return $rowLabel;
    }

    public static function newMobileInfo(RowSubGroup $subGroup)
    {
        $mobileInfo = new MobileInfo();
        $mobileInfo->subGroup = $subGroup;
        return $mobileInfo;
    }

    public static function newColumnGroup($data, Gantt $gantt)
    {
        $colGroup               = new ColumnGroup;
        $colGroup->label        = $data['label'];
        foreach ($data['days'] as $dayIso) {
            $col = self::newColumn($dayIso);
            $colGroup->columns[] = $col;
            $gantt->columns[$dayIso] = $col;
        }
        return $colGroup;
    }

    protected static function newRowGroup($data, Gantt $gantt)
    {
        $rowGroup = new RowGroup;
        $rowGroup->gantt    = $gantt;
        foreach ($data['subgroups'] as $subgroup_data) {
            $rowSubGroup = self::newRowSubGroup($subgroup_data, $rowGroup);
            $rowGroup->rowSubGroups[] = $rowSubGroup;
        }
        $rowGroup->bar          = self::newBar($gantt, $data);
        $rowGroup->calculateTotals();
        $rowLabelData = [
            'text'              => $data['label'],
            'imgSrc'            => $data['icon'],
            'expandIcon'        => $gantt->config['expandIcon'],
            'expandIconOpen'    => $gantt->config['expandIconOpen'],
            'row'               => $rowGroup,
        ];
        if (isset($data['icon'])) {
            $rowLabelData['icon'] = $data['icon'];
        }
        if (isset($data['imgSrc'])) {
            $rowLabelData['imgSrc'] = $data['imgSrc'];
        }
        if (isset($data['labelHref'])) {
            $rowLabelData['href'] = $data['labelHref'];
        }
        if ($gantt->config['isMobile']) {
            $rowLabelData['mobileExpand'] = [
                'cssClassCommon'    => $gantt->config['expandIconMobile'],
                'cssClassOpen'      => $gantt->config['expandIconOpenMobile'],
                'cssClassClose'     => $gantt->config['expandIconCloseMobile'],
            ];
        }
        $rowGroup->rowLabel = self::newRowLabel($rowLabelData);
        return $rowGroup;
    }

    /**
     * @param \DcodeGroup\Gantt\Gantt $gantt
     * @param array ['start' => ... 'end' => ... ] optional: miscBarData, tasks, cssClass
     * @return Bar
     */
    protected static function newBar(Gantt $gantt, $data)
    {
        $bar = new Bar;
        $bar->gantt = $gantt;
        if (isset($data['start'])) {
            $bar->start_date = $data['start'];
        }
        if (isset($data['end'])) {
            $bar->end_date = $data['end'];
        }
        if (isset($data['showBar'])) {
            $bar->showBar = $data['showBar'];
        }
        if (isset($data['miscBarData'])) {
            $bar->miscData = $data['miscBarData'];
        }
        if (isset($data['tasks'])) {
            $bar->tasks = $data['tasks'];
        }
        if (isset($data['cssClass'])) {
            $bar->cssClasses[] = $data['cssClass'];
        }
        return $bar;
    }

    protected static function newRowSubGroup($data, RowGroup $rowGroup)
    {
        $rowSubGroup            = new RowSubGroup;
        $rowSubGroup->rowGroup  = $rowGroup;
        if (isset($data['headRowCssClass'])) $rowSubGroup->headRowCssClass = $data['headRowCssClass'];
        foreach ($data['rows'] as $row_data) {
            $row = self::newRow($row_data, $rowSubGroup);
            $rowSubGroup->rows[] = $row;
        }
        $noBar                  = self::newBar($rowGroup->gantt, $data);
        $noBar->showBar         = false;
        $rowSubGroup->bar       = $noBar;
        $rowSubGroup->calculateTotals();
        $rowSubGroup->mobileInfo = self::newMobileInfo($rowSubGroup);
        $rowSubGroup->rowLabel = self::newRowLabel([
            'text'              => $data['label'],
            'href'              => (isset($data['labelHref']) ? $data['labelHref'] : null),
        ]);
        return $rowSubGroup;
    }

    protected static function newRow($data, RowSubGroup $rowSubGroup)
    {
        $gantt = $rowSubGroup->rowGroup->gantt;
        $row = new Row;
        $row->subGroup      = $rowSubGroup;
        $row->cssClasses    = explode(' ', $data['cssClass']);
        $bars_data = (isset($data['bars']))
            ? $data['bars']
            : [
                [
                    'tasks' => (isset($data['tasks'])? $data['tasks'] : null),
                    'start' => $data['start'],
                    'end' => $data['end'],
                ],
            ];
        foreach ($bars_data as $bar_data) {
            $bar = self::newBar($gantt, $bar_data);
            $bar->setPointsFromDates($bar_data['start'], $bar_data['end']);
            $row->bars[] = $bar;
        }
        $rowLabelData = [
            'text'              => $data['rowLabel'],
            'expandIcon'        => $gantt->config['expandIcon'],
            'icon'              => $gantt->config['rowIcon'],
            'row'               => $row,
        ];
        if (isset($data['icon'])) {
            $rowLabelData['icon'] = $data['icon'];
        }
        if (isset($data['imgSrc'])) {
            $rowLabelData['imgSrc'] = $data['imgSrc'];
        }
        if (isset($data['labelHref'])) {
            $rowLabelData['href'] = $data['labelHref'];
        }
        $row->rowLabelElement = self::newRowLabel($rowLabelData);
        return $row;
    }

    protected static function newColumn($iso)
    {
        $col = new Column;
        $col->iso = $iso;
        $col->timestamp = strtotime($iso);
        return $col;
    }
}
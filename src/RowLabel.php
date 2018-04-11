<?php

namespace DcodeGroup\Gantt;


class RowLabel extends DcodeGroupBase
{
    /**
     * @var \DcodeGroup\Gantt\Row|null
     */
    public $row;

    /**
     * @var string|NULL Css Class that stays on icon Eg. 'fa'(for font-awesome). You can set as null to completely omit expand button
     */
    public $expandIcon;

    /**
     * @var string|NULL Css Class temporarily on expand button Eg. 'fa-plus'
     */
    public $expandIconOpen;

    public $text;

    public $icon;

    public $imgSrc;

    /**
     * @var null|array Eg. ['cssClassCommon' => 'fa', 'cssClassOpen' => 'fa-angle-down', 'cssClassClose' => 'fa-angle-up', ]
     */
    public $mobileExpand;

    /**
     * @var string|NULL
     */
    public $href;

    public function defaultTemplate()
    {
        return 'rowLabel';
    }
}
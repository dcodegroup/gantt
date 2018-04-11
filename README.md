# gantt
Gantt chart

`composer.json`
```
    "autoload": {
        ...
        "psr-4": {
            ...,
            "DcodeGroup\\": "vendor/dcodegroup/"
        }
    },
```


instantiate
-----------
``` php
$groupedCols = \DcodeGroup\Gantt\DatesHelper::ganttColGroups(
    ($_GET['start'] ?? time()),
    ($_GET['end'] ?? null)
);
$gantt = \DcodeGroup\Gantt\Factory::newGantt($groupedCols, $rows, ['isMobile' => $agent->isMobile()]);

```

Config
------
``` php
# custom bar text
$gantt->barTextFunction = function(\DcodeGroup\Gantt\Bar $bar) {
    return date('j M Y', strtotime($bar->start_date)) . ' - ' . date('j M Y', strtotime($bar->end_date));
};

# disable bar text
$gantt->barTitleAttrs = false;
$gantt->barTextShow = false;

```

if you disable barTitleAttrs, the bar will have a data-text atrribute instead

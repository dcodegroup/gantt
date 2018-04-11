<?php /* @var $this \DcodeGroup\Gantt\RowSubGroup */ ?>
<div class="gg-row-sub-group">
    <?php if ( ! $this->rowGroup->gantt->config['isMobile']): ?>
    <div class="gg-row-outer gg-thinner gg-row-sub-group-head-row gg-pink <?= $this->headRowCssClass ?>">
        <?= $this->rowLabel ?>
        <?= $this->barsGrid() ?>
    </div>
    <?php endif ?>
    <?php foreach($this->rows as $row): ?>
        <?= $row ?>
    <?php endforeach ?>
</div>

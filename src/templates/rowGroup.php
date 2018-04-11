<?php /* @var $this \DcodeGroup\Gantt\RowGroup */ ?>
<div class="gg-row-outer gg-pink gg-group-head" data-groupindex="<?= $this->i ?>">
    <?= $this->rowLabel ?>
    <?php if ( ! $this->gantt->config['isMobile']) echo $this->barsGrid() ?>
</div>
<div class="gg-group-rows" id="gg-group-rows-<?= $this->i ?>">
    <div class="gg-group-rows-inner">
        <div class="columns-header-mobile">
            <?= $this->gantt->columnsHeader ?>
        </div>
        <?php foreach($this->rowSubGroups as $subGroup): ?>
            <?= $subGroup ?>
        <?php endforeach ?>
        <?php if ($this->gantt->config['isMobile']): ?>
        <div class="gg-mobile-info">
            <?php foreach($this->rowSubGroups as $subGroup): ?>
                <?php if (true): ?>
                <?= $subGroup->mobileInfo ?>
                <?php endif ?>
            <?php endforeach ?>
        </div>
        <?php endif ?>
    </div>
</div>

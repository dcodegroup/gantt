<?php /* @var $this \DcodeGroup\Gantt\Gantt */ ?>
<div class="gpor-gantt"
     data-expand-button-open="<?= $this->config['expandIconOpen'] ?>"
     data-expand-button-close="<?= $this->config['expandIconClose'] ?>"
>
    <div class="gg-header">
        <?= $this->headRowLabel ?>
        <?= $this->columnsHeader ?>
    </div>
    <?php foreach($this->rowGroups as $row): ?>
        <?= $row ?>
    <?php endforeach ?>
</div>


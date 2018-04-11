<?php /* @var $this \DcodeGroup\Gantt\RowLabel */ ?>
<div class="gg-row-label">
    <?php if ( ! $this->mobileExpand): ?>
        <div class="col-expand-hide-clickable">
            <?php if (isset($this->expandIcon)): ?>
                <span class="icon <?= $this->expandIcon ?> <?= $this->expandIconOpen ?>"></span>
            <?php endif ?>
        </div>
    <?php endif ?>
    <div class="col-graphic">
        <?php if ($this->icon): ?>
            <i class="icon <?= $this->icon ?>" aria-hidden="true"></i>
        <?php endif ?>
        <?php if ($this->imgSrc): ?>
            <img src="<?= $this->imgSrc ?>" onerror="this.style.display='none';" />
        <?php endif ?>
    </div>
    <p class="col-text">
        <?php if ($this->href): ?>
        <a href="<?= $this->href ?>">
        <?php endif ?>
            <?= $this->text ?>
            <?php if ($this->row && method_exists($this->row, 'tasksText')): ?>
                <?php $tasks_text = $this->row->tasksText() ?>
                <?php if ($tasks_text): ?>
                    <span class="tasks-text"><?= $tasks_text ?></span>
                <?php endif ?>
            <?php endif ?>
        <?php if ($this->href): ?>
        </a>
        <?php endif ?>
    </p>
    <?php if ($this->mobileExpand): ?>
        <div class="col-expand-hide-clickable">
            <span class="<?= $this->mobileExpand['cssClassCommon'] ?> <?= $this->mobileExpand['cssClassOpen'] ?>"
                  data-closedstate="<?= $this->mobileExpand['cssClassOpen'] ?>"
                  data-openstate="<?= $this->mobileExpand['cssClassClose'] ?>"></span>
        </div>
    <?php endif ?>
</div>

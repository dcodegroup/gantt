<?php /* @var $this \DcodeGroup\Gantt\Bar */ ?>
<?php if ($this->showBar): ?>
<div class="gg-bar"
     <?php if ($this->gantt->barTitleAttrs): ?>
     title="<?= $this->titleAttr() ?>"
     <?php else: ?>
     data-text="<?= $this->dataTextAttr() ?>"
     <?php endif ?>
     data-misc="<?= htmlspecialchars(json_encode($this->miscData)) ?>"
     style="<?= $this->style() ?>">
    <div class="gg-bar-color <?= $this->cssClass() ?>">
        <?php if ($this->gantt->barTextShow): ?>
        <p><?= $this->text() ?></p>
        <?php endif ?>
    </div>
</div>
<?php endif ?>

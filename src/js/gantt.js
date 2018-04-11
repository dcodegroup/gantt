function GporGantt($el) {
    this.$ = $el;
    this.rowGroups = [];
    this.$header = $el.find('.gg-header');
    this.$expandAllButton = this.$header.find('.col-expand-hide-clickable');
    this.$expandAllButtonIcon = this.$expandAllButton.find('span');
    this.clickableSpanClosed = this.$expandAllButtonIcon.attr('data-closedstate');
    this.clickableSpanOpen = this.$expandAllButtonIcon.attr('data-openstate');
    this.buttonWillExpand = this.$expandAllButtonIcon.hasClass(this.$expandAllButtonIcon.data('closedstate'));
    var that = this;
    $el.find('.gg-group-head').each(function(){
        that.rowGroups.push(new GanttRowGroup($(this)));
    });
    this.$expandAllButton.click(function(){
        that.allRowGroups(that.buttonWillExpand);
        that.buttonWillExpand = ( ! that.buttonWillExpand);
        if (that.buttonWillExpand) {
            that.$expandAllButtonIcon.removeClass(that.clickableSpanOpen);
            that.$expandAllButtonIcon.addClass(that.clickableSpanClosed);
        } else {
            that.$expandAllButtonIcon.removeClass(that.clickableSpanClosed);
            that.$expandAllButtonIcon.addClass(that.clickableSpanOpen);
        }
    });
}
GporGantt.prototype.allRowGroups = function(toExpand) {
    $.each(this.rowGroups, function(i, rowGroup){
        if (toExpand) {
            rowGroup.expand();
        } else {
            rowGroup.fold();
        }
    });
};
function GanttRowGroup($groupHead) {
    this.$groupHead = $groupHead;
    this.i = $groupHead.attr('data-groupindex');
    this.$clickable = $groupHead.find('.col-expand-hide-clickable');
    this.$clickableSpan = this.$clickable.find('span');
    this.clickableSpanClosed = this.$clickableSpan.attr('data-closedstate');
    this.clickableSpanOpen = this.$clickableSpan.attr('data-openstate');
    this.$columnsOuterContainer = $('#gg-group-rows-'+this.i);
    this.$columnsInnerContainer = this.$columnsOuterContainer.find('.gg-group-rows-inner');
    this.isOpen = false;
    this.rowSubGroups = [];
    var that = this;
    this.$clickable.click(function(){
        that.handleClick();
    });
    this.$columnsOuterContainer.find('.gg-row-sub-group').each(function(){
        that.rowSubGroups.push(new GanttRowSubGroup($(this)));
    });
}
GanttRowGroup.prototype.handleClick = function() {
    if (this.isOpen) {
        this.fold();
        this.isOpen = false;
    } else {
        this.expand();
        this.isOpen = true;
    }
};
GanttRowGroup.prototype.expand = function() {
    this.$columnsOuterContainer.css('height', this.$columnsInnerContainer.css('height'));
    this.$clickableSpan.removeClass(this.clickableSpanClosed);
    this.$clickableSpan.addClass(this.clickableSpanOpen);
    this.isOpen = true;
};
GanttRowGroup.prototype.fold = function() {
    this.$columnsOuterContainer.css('height', '0px');
    this.$clickableSpan.removeClass(this.clickableSpanOpen);
    this.$clickableSpan.addClass(this.clickableSpanClosed);
    this.isOpen = false;
};
function GanttRowSubGroup($el) {
    this.$ = $el;
    this.rows = [];
    var that = this;
    $el.find('.gg-row-outer').each(function(){
        that.rows.push(new GanttRow($(this)));
    })
}
function GanttRow($el) {
    this.$ = $el;
    this.bars = [];
    var that = this;
    $el.find('.gg-bar').each(function(){
        that.bars.push(new GanttBar($(this)));
    });
}
function GanttBar($el) {
    this.$ = $el;
    var that = this;
}
GanttBar.prototype.checkPos = function() {

};
function GanttColumnGroup($el) {
    this.$ = $el;
}
function GanttColumn($el) {
    this.$ = $el;
}

$('.gpor-gantt').each(function(){
    new GporGantt($(this));
});

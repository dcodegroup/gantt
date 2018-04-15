function GporGantt($el) {
    this.$ = $el;
    this.rowGroups = [];
    this.$header = $el.find('.gg-header');
    this.$expandAllButton = this.$header.find('.col-expand-hide-clickable');
    this.$expandAllButtonIcon = this.$expandAllButton.find('span');
    this.expandButtonCssClassOpen = $el.data('expand-button-open');
    this.expandButtonCssClassClose = $el.data('expand-button-close');
    this.buttonWillExpand = this.$expandAllButtonIcon.hasClass(this.expandButtonCssClassOpen);
    var that = this;
    $el.find('.gg-group-head').each(function(){
        that.rowGroups.push(new GanttRowGroup($(this), that));
    });
    this.$expandAllButton.click(function(){
        that.allRowGroups(that.buttonWillExpand);
        that.buttonWillExpand = ( ! that.buttonWillExpand);
        if (that.buttonWillExpand) {
            that.$expandAllButtonIcon.removeClass(that.expandButtonCssClassClose);
            that.$expandAllButtonIcon.addClass(that.expandButtonCssClassOpen);
        } else {
            that.$expandAllButtonIcon.removeClass(that.expandButtonCssClassOpen);
            that.$expandAllButtonIcon.addClass(that.expandButtonCssClassClose);
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
function GanttRowGroup($groupHead, gantt) {
    this.$groupHead = $groupHead;
    this.gantt = gantt;
    this.i = $groupHead.attr('data-groupindex');
    this.$clickable = $groupHead.find('.col-expand-hide-clickable');
    this.$clickableSpan = this.$clickable.find('span');
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
    this.$clickableSpan.removeClass(this.gantt.expandButtonCssClassOpen);
    this.$clickableSpan.addClass(this.gantt.expandButtonCssClassClose);
    this.isOpen = true;
};
GanttRowGroup.prototype.fold = function() {
    this.$columnsOuterContainer.css('height', '0px');
    this.$clickableSpan.removeClass(this.gantt.expandButtonCssClassClose);
    this.$clickableSpan.addClass(this.gantt.expandButtonCssClassOpen);
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

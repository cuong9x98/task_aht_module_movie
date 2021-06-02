define([
    'Magento_Ui/js/grid/columns/column'
], function (Column) {
    'use strict';

    return Column.extend({
        defaults: {
            bodyTmpl: 'ui/grid/cells/html'
        },
        getLabel: function (record) {
            var label = this._super(record);
            label = '<div class="rating-box" style="background: url(http://127.0.0.1/magento10/pub/static/version1622524379/adminhtml/Magento/backend/en_US/images/rating-bg.png) repeat-x 0 0;height: 13px;margin: 4px 0 0;width: 90px;"><div class="rating" style="width:'+(record.rating/5)*100+'%;background: url(http://127.0.0.1/magento10/pub/static/version1622524379/adminhtml/Magento/backend/en_US/images/rating-bg.png) repeat-x 0 -13px;height:13px"></div></div>';
            return label;
        }
    });
});
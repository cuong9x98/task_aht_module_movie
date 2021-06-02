define([
    'Magento_Ui/js/grid/columns/select'
], function (Column) {
    'use strict';

    return Column.extend({
        defaults: {
            bodyTmpl: 'ui/grid/cells/html'
        },
        getLabel: function (record) {
            var label = this._super(record);
                if(record.increment_id%2 == 0) {
                    label = '<span class="grid-severity-notice"><span>' + 'Success' + '</span></span>';
                } else  {
                    label = '<span class="grid-severity-minor"><span>' + 'Error' + '</span></span>';
                }
            return label;
        }
    });
});

/*********************************************************************************
 * The content of this file is subject to the Reports 4 You license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ********************************************************************************/

Vtiger_Widget_Js('Vtiger_Getreports_Widget_Js',{},{

    generateChartData : function() {

        var container = this.getContainer();

        var jData = container.find('.widgetData').val();
        var data = JSON.parse(jData);

        var chartData = [];
        var xLabels = new Array();
        var yMaxValue = 0;
        for(var index in data) {
            var row = data[index];
            row[0] = parseInt(row[0]);
            xLabels.push(app.getDecodedValue(row[1]))
            chartData.push(row[0]);
            if(parseInt(row[0]) > yMaxValue){
                yMaxValue = parseInt(row[0]);
            }
        }
        // yMaxValue Should be 25% more than Maximum Value
        yMaxValue = yMaxValue + 2 + (yMaxValue/100)*25;
        return {'chartData':[chartData], 'yMaxValue':yMaxValue, 'labels':xLabels};
    },

    postLoadWidget: function () {
        this._super();
        var thisInstance = this;

        // ITS4YOU-CR SlOl 10. 3. 2016 9:30:33
        var widgetContainer = thisInstance.getContainer();
        var reportid = widgetContainer.find('#widgetReports4YouId').val();
        var fieldElement = jQuery("#SelectPrimarySearchWidget"+reportid);

        let tabId = null;
        jQuery('.dashboardTab').each(function (e) {
            if (jQuery(this).hasClass('active')) {
                tabId = jQuery(this).data('tabid');
            }
        });

        // headerElement = jQuery("#dashboardWidgetHeader" + reportid);
        // fieldElement.unbind().on('change', function (e) {
        //     var searchElement = jQuery(e.currentTarget);
        //     thisInstance.registerClickOnLink(searchElement, tabId);
        // })
        // ITS4YOU-END
    },

    registerFilterChangeEvent : function() {
        this.getContainer().on('change', '.widgetFilter, .reloadOnChange', function(e) {
            var target = jQuery(e.currentTarget);
            if(target.hasClass('dateRange')) {
                var start = target.find('input[name="start"]').val();
                var end = target.find('input[name="end"]').val();
                if(start == '' || end == '') return false;
            }

            var widgetContainer = target.closest('li');
            //widgetContainer.find('a[name="drefresh"]').trigger('click');
        })
    },

    // ITS4YOU-CR SlOl 10. 3. 2016 9:31:11
    registerClickOnLink: function(searchElement, tabId) {
        var thisInstance = this;
        var element = jQuery(searchElement);
        if(typeof element != 'undefined'){
            var widgetContainer = thisInstance.getContainer();
            var reportid = widgetContainer.find('#widgetReports4YouId').val();

            var primarySearchBy = element.val();

            var params = {
                'module' : 'ITS4YouReports',
                'view' :'ShowWidget',
                'name' : 'GetReports',
                'reportid'  : reportid,
                'record'  : reportid,
                'mode'  : 'widget',
                'tab'  : tabId,
                'primarySearchBy': primarySearchBy
            }

            jQuery('#reports4you_widget_'+tabId+reportid).html('');

            //alert(JSON.stringify(params));
            app.helper.showProgress();
            app.request.get({'data':params}).then(function(error,data){
                app.helper.hideProgress();
                if(data) {
                    jQuery.globalEval(data);
                }
            });
        }

    },
    // ITS4YOU-END

    loadChart : function() {
        $(function () {

        });
    }
});

jQuery(document).ready(function() {
    jQuery('.dashboardWidget').each(function(){
        if('GetReports'===jQuery(this).data('name')) {
            var widgetName = 'Getreports';
            var widgetInstance = Vtiger_Widget_Js.getInstance(jQuery(this), widgetName);
            widgetInstance.postLoadWidget();

        }
    });
});

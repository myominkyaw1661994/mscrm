<?php /* Smarty version Smarty-3.1.19, created on 2020-12-01 21:16:32
         compiled from "C:\xampp\htdocs\maintcrm20i15\customerportal\layouts\default\templates\Project\partials\ProjectMilestoneContent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:298655fc63420a467e1-02090082%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '375effacc18f162090d0620947f7d2b5ad4bba59' => 
    array (
      0 => 'C:\\xampp\\htdocs\\maintcrm20i15\\customerportal\\layouts\\default\\templates\\Project\\partials\\ProjectMilestoneContent.tpl',
      1 => 1520231416,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '298655fc63420a467e1-02090082',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5fc63420a4ac31_11346192',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fc63420a4ac31_11346192')) {function content_5fc63420a4ac31_11346192($_smarty_tpl) {?>


    <div class="cp-table-container" ng-show="projectmilestonerecords">
        <div class="table-responsive">
            <table class="table table-hover table-condensed table-detailed dataTable no-footer">
                <thead>
                    <tr class="listViewHeaders">
                        <th ng-hide="header=='id'" ng-repeat="header in projectmilestoneheaders" nowrap="" class="medium">
                            <a href="javascript:void(0);" class="listViewHeaderValues" data-nextsortorderval="ASC" data-columnname="{{header}}" translate="{{header}}">{{header}}&nbsp;&nbsp;</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="listViewEntries" ng-repeat="record in projectmilestonerecords">
                        <td ng-hide="header=='id'" ng-repeat="header in projectmilestoneheaders" class="listViewEntryValue medium" nowrap="" style='cursor: pointer;' ng-mousedown="ChangeLocation(record, 'ProjectMilestone')">
                <ng-switch on="record[header].type">
                    <a ng-href="index.php?module=ProjectMilestone&view=Detail&id={{record.id}}"></a>
                    <span ng-switch-default>{{record[header]}}</span>
                </ng-switch>
                </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <a href="" ng-if="!milestonesLoaded && !noMilestones" ng-click="loadProjectMilestonePage(projectMilestonePageNo)">{{'more'|translate}}...</a>
    <p ng-if="milestonesLoaded" class="text-muted">{{'No Milestones'|translate}}</p>
    <p ng-if="!milestonesLoaded && noMilestones" class="text-muted">{{'No more Milestones'|translate}}</p>

<?php }} ?>

<?php
    $table_data = array();
    $table_data[] = array('key' => __('ID'), 'value' => $report['EventReport']['id']);
    $table_data[] = array('key' => __('UUID'), 'value' => $report['EventReport']['uuid']);
    $table_data[] = array('key' => __('Name'), 'value' => $report['EventReport']['name']);
    $table_data[] = array(
        'key' => __('Event ID'),
        'html' => sprintf('%s', sprintf(
            '<a href="%s">%s</a>',
            sprintf('%s%s%s', $baseurl, '/events/view/', h($report['EventReport']['event_id'])),
            h($report['EventReport']['event_id'])
        ))
    );
    $table_data[] = array(
        'key' => __('Distribution'),
        'value_class' => ($report['EventReport']['distribution'] == 0) ? 'privateRedText' : '',
        'html' => sprintf('%s',
            ($report['EventReport']['distribution'] == 4) ?
                sprintf('<a href="%s%s">%s</a>', $baseurl . '/sharing_groups/view/', h($report['SharingGroup']['id']), h($report['SharingGroup']['name'])) :
                h($distributionLevels[$report['EventReport']['distribution']])
        )
    );

    $table_data[] = array('key' => __('Timestamp'), 'value' => date('Y-m-d H:i:s', $report['EventReport']['timestamp']));
    $table_data[] = array('key' => __('Deleted'), 'boolean' => $report['EventReport']['deleted'], 'value_class' => $report['EventReport']['deleted'] ? 'red' : 'green');
?>

<div class='<?= !isset($ajax) || !$ajax ? 'view' : '' ?>'>
    <div class="row-fluid">
        <h2><?= h($report['EventReport']['name']) ?></h2>
        <div class="span8" style="margin-bottom: 10px;">
            <?php echo $this->element('genericElements/viewMetaTable', array('table_data' => $table_data)); ?>
        </div>
        <div class="clear">
            <h4>
                <?= __('Event Report content') ?>
            </h4>
            <?php 
                echo $this->element('markdownEditor/markdownEditor', [
                    'canEdit' => $canEdit,
                    'markdown' => $report['EventReport']['content'],
                    'modelName' => 'EventReport',
                    'mardownModelFieldName' => 'content',
                    'lastModified' => $report['EventReport']['timestamp'],
                    'additionalMarkdownElements' => [
                        'path' => 'EventReports/reportEditor',
                        'variables' => [
                            'reportid' => $report['EventReport']['id'],
                            'eventid' => $report['EventReport']['event_id'],
                            'proxyMISPElements' => $proxyMISPElements,
                        ]
                    ],
                    'additionalMarkdownHelpModalElements' => [[
                        'path' => 'EventReports/reportHelpModal',
                        'tab_name' => __('Markdown format'),
                    ]]
                ]);
            ?>
        </div>
    </div>
    <div style="margin-bottom: 15px;"></div>
</div>
<script type="text/javascript">
$(document).ready(function () {
});
</script>


<?php
    if (!isset($ajax) || !$ajax) {
        echo $this->element('/genericElements/SideMenu/side_menu', array('menuList' => 'eventReports', 'menuItem' => 'view'));
    }
?>

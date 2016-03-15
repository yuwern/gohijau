<div class="col-lg-12">
	<div class="portlet box portlet-green">
		<div class="portlet-header">
			<div class="caption"><?= h($circularReportUser->id) ?></div>
		</div>
		<div class="portlet-body">
			<table class="table table-striped table-bordered detail-view">
				<tbody>
        <tr>
            <th><?= __('Circular') ?></th>
            <td><?= $circularReportUser->has('circular') ? $this->Html->link($circularReportUser->circular->name, ['controller' => 'Circulars', 'action' => 'view', $circularReportUser->circular->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Passcode') ?></th>
            <td><?= h($circularReportUser->passcode) ?></td>
        </tr>
        <tr>
            <th><?= __('User Pdf File') ?></th>
            <td><?= h($circularReportUser->user_pdf_file) ?></td>
        </tr>
        <tr>
            <th><?= __('Name Of Broker') ?></th>
            <td><?= h($circularReportUser->name_of_broker) ?></td>
        </tr>
        <tr>
            <th><?= __('Name Of Shareholders') ?></th>
            <td><?= h($circularReportUser->name_of_shareholders) ?></td>
        </tr>
        <tr>
            <th><?= __('Account Qualifiers') ?></th>
            <td><?= h($circularReportUser->account_qualifiers) ?></td>
        </tr>
        <tr>
            <th><?= __('Icno') ?></th>
            <td><?= h($circularReportUser->icno) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($circularReportUser->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Broker Code') ?></th>
            <td><?= $this->Number->format($circularReportUser->broker_code) ?></td>
        </tr>
        <tr>
            <th><?= __('Broker Type') ?></th>
            <td><?= $this->Number->format($circularReportUser->broker_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Cds Ac No') ?></th>
            <td><?= $this->Number->format($circularReportUser->cds_ac_no) ?></td>
        </tr>
        <tr>
            <th><?= __('Share Holdings') ?></th>
            <td><?= $this->Number->format($circularReportUser->share_holdings) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $circularReportUser->status ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
</div>
	</div>
</div>
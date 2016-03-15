<div class="col-lg-12">
	<div class="portlet box portlet-green">
		<div class="portlet-header">
			<div class="caption"><?= h($annualReportUser->id) ?></div>
		</div>
		<div class="portlet-body">
			<table class="table table-striped table-bordered detail-view">
				<tbody>
        <tr>
            <th><?= __('Annual Report') ?></th>
            <td><?= $annualReportUser->has('annual_report') ? $this->Html->link($annualReportUser->annual_report->name, ['controller' => 'AnnualReports', 'action' => 'view', $annualReportUser->annual_report->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Passcode') ?></th>
            <td><?= h($annualReportUser->passcode) ?></td>
        </tr>
        <tr>
            <th><?= __('User Pdf File') ?></th>
            <td><?= h($annualReportUser->user_pdf_file) ?></td>
        </tr>
        <tr>
            <th><?= __('Name Of Broker') ?></th>
            <td><?= h($annualReportUser->name_of_broker) ?></td>
        </tr>
        <tr>
            <th><?= __('Name Of Shareholders') ?></th>
            <td><?= h($annualReportUser->name_of_shareholders) ?></td>
        </tr>
        <tr>
            <th><?= __('Account Qualifiers') ?></th>
            <td><?= h($annualReportUser->account_qualifiers) ?></td>
        </tr>
        <tr>
            <th><?= __('Icno') ?></th>
            <td><?= h($annualReportUser->icno) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($annualReportUser->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Broker Code') ?></th>
            <td><?= $this->Number->format($annualReportUser->broker_code) ?></td>
        </tr>
        <tr>
            <th><?= __('Broker Type') ?></th>
            <td><?= $this->Number->format($annualReportUser->broker_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Cds Ac No') ?></th>
            <td><?= $this->Number->format($annualReportUser->cds_ac_no) ?></td>
        </tr>
        <tr>
            <th><?= __('Share Holdings') ?></th>
            <td><?= $this->Number->format($annualReportUser->share_holdings) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $annualReportUser->status ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
</div>
	</div>
</div>
<div class="col-lg-12">
	<div class="portlet box portlet-green">
		<div class="portlet-header">
			<div class="caption"><?= h($company->name) ?></div>
		</div>
		<div class="portlet-body">
			<?= $this->Html->link(__('Edit Company'), ['action' => 'edit', $company->id], ['class'=>'btn btn-success']) ?>
			<?= $this->Form->postLink(__('Delete Company'), ['action' => 'delete', $company->id], ['confirm' => __('Are you sure you want to delete # {0}?', $company->id), 'class'=>'btn btn-danger']) ?> 
			<p>&nbsp;</p>
			<table class="table table-striped table-bordered detail-view">
				<tbody>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $company->has('user') ? $this->Html->link($company->user->email, ['controller' => 'Users', 'action' => 'view', $company->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($company->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Address') ?></th>
            <td><?= h($company->address) ?></td>
        </tr>
        <tr>
            <th><?= __('Phone No') ?></th>
            <td><?= h($company->phone_no) ?></td>
        </tr>
        <tr>
            <th><?= __('Street') ?></th>
            <td><?= h($company->street) ?></td>
        </tr>
        <tr>
            <th><?= __('City') ?></th>
            <td><?= h($company->city) ?></td>
        </tr>
        <tr>
            <th><?= __('State') ?></th>
            <td><?= h($company->state) ?></td>
        </tr>
        <tr>
            <th><?= __('Country') ?></th>
            <td><?= h($company->country) ?></td>
        </tr>
        <tr>
            <th><?= __('Image Url') ?></th>
            <td><?= h($company->image_url) ?></td>
        </tr>
        <tr>
            <th><?= __('Stock Code') ?></th>
            <td><?= h($company->stock_code) ?></td>
        </tr>
        <tr>
            <th><?= __('Market') ?></th>
            <td><?= h($company->market) ?></td>
        </tr>
        <tr>
            <th><?= __('Sector') ?></th>
            <td><?= h($company->sector) ?></td>
        </tr>
        <tr>
            <th><?= __('Website') ?></th>
            <td><?= h($company->website) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($company->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $company->status ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Annual Reports') ?></h4>
        <?php if (!empty($company->annual_reports)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Company Name') ?></th>
                <th><?= __('Report Year') ?></th>
                <th><?= __('Shareholder File Path') ?></th>
                <th><?= __('Report Pdf File Path') ?></th>
                <th><?= __('Failed Count') ?></th>
                <th><?= __('Total Count') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($company->annual_reports as $annualReports): ?>
            <tr>
                <td><?= h($annualReports->id) ?></td>
                <td><?= h($annualReports->user_id) ?></td>
                <td><?= h($annualReports->name) ?></td>
                <td><?= h($annualReports->company_name) ?></td>
                <td><?= h($annualReports->report_year) ?></td>
                <td><?= h($annualReports->shareholder_file_path) ?></td>
                <td><?= h($annualReports->report_pdf_file_path) ?></td>
                <td><?= h($annualReports->failed_count) ?></td>
                <td><?= h($annualReports->total_count) ?></td>
                <td><?= h($annualReports->status) ?></td>
                <td><?= h($annualReports->created) ?></td>
                <td><?= h($annualReports->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AnnualReports', 'action' => 'view', $annualReports->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'AnnualReports', 'action' => 'edit', $annualReports->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AnnualReports', 'action' => 'delete', $annualReports->id], ['confirm' => __('Are you sure you want to delete # {0}?', $annualReports->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Circulars') ?></h4>
        <?php if (!empty($company->circulars)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Company Name') ?></th>
                <th><?= __('Circular Year') ?></th>
                <th><?= __('Subject') ?></th>
                <th><?= __('Shareholder List File') ?></th>
                <th><?= __('Report Pdf') ?></th>
                <th><?= __('Failed Count') ?></th>
                <th><?= __('Total Count') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($company->circulars as $circulars): ?>
            <tr>
                <td><?= h($circulars->id) ?></td>
                <td><?= h($circulars->user_id) ?></td>
                <td><?= h($circulars->name) ?></td>
                <td><?= h($circulars->company_name) ?></td>
                <td><?= h($circulars->circular_year) ?></td>
                <td><?= h($circulars->subject) ?></td>
                <td><?= h($circulars->shareholder_list_file) ?></td>
                <td><?= h($circulars->report_pdf) ?></td>
                <td><?= h($circulars->failed_count) ?></td>
                <td><?= h($circulars->total_count) ?></td>
                <td><?= h($circulars->status) ?></td>
                <td><?= h($circulars->created) ?></td>
                <td><?= h($circulars->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Circulars', 'action' => 'view', $circulars->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Circulars', 'action' => 'edit', $circulars->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Circulars', 'action' => 'delete', $circulars->id], ['confirm' => __('Are you sure you want to delete # {0}?', $circulars->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Events') ?></h4>
        <?php if (!empty($company->events)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Company Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Event Type') ?></th>
                <th><?= __('Company Name') ?></th>
                <th><?= __('Year') ?></th>
                <th><?= __('Report Type') ?></th>
                <th><?= __('Report Id') ?></th>
                <th><?= __('Date') ?></th>
                <th><?= __('Time') ?></th>
                <th><?= __('Venue') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Descripiton') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($company->events as $events): ?>
            <tr>
                <td><?= h($events->id) ?></td>
                <td><?= h($events->company_id) ?></td>
                <td><?= h($events->user_id) ?></td>
                <td><?= h($events->event_type) ?></td>
                <td><?= h($events->company_name) ?></td>
                <td><?= h($events->year) ?></td>
                <td><?= h($events->report_type) ?></td>
                <td><?= h($events->report_id) ?></td>
                <td><?= h($events->date) ?></td>
                <td><?= h($events->time) ?></td>
                <td><?= h($events->venue) ?></td>
                <td><?= h($events->title) ?></td>
                <td><?= h($events->descripiton) ?></td>
                <td><?= h($events->status) ?></td>
                <td><?= h($events->created) ?></td>
                <td><?= h($events->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Events', 'action' => 'view', $events->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Events', 'action' => 'edit', $events->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Events', 'action' => 'delete', $events->id], ['confirm' => __('Are you sure you want to delete # {0}?', $events->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
	</div>
</div>
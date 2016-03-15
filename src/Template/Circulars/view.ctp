<div class="col-lg-12">
	<div class="portlet box portlet-green">
		<div class="portlet-header">
			<div class="caption"><?= h($circular->name) ?></div>
		</div>
		<div class="portlet-body">
			<?= $this->Html->link(__('Edit Circular'), ['action' => 'edit', $circular->id], ['class'=>'btn btn-success']) ?>
			<?= $this->Form->postLink(__('Delete Circular'), ['action' => 'delete', $circular->id], ['confirm' => __('Are you sure you want to delete # {0}?', $circular->id), 'class'=>'btn btn-danger']) ?> 
			<p>&nbsp;</p>
			<table class="table table-striped table-bordered detail-view">
				<tbody>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $circular->has('user') ? $this->Html->link($circular->user->email, ['controller' => 'Users', 'action' => 'view', $circular->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($circular->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Company Name') ?></th>
            <td><?= h($circular->company_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Circular Year') ?></th>
            <td><?= h($circular->circular_year) ?></td>
        </tr>
        <tr>
            <th><?= __('Subject') ?></th>
            <td><?= h($circular->subject) ?></td>
        </tr>
        <tr>
            <th><?= __('Shareholder List File') ?></th>
            <td>				<?php
					echo $this->Html->link('Share Holder File', '/files/AnnualReports/shareholder_file_path/'. $circular->shareholder_list_file).' <br />';
				?></td>
        </tr>
        <tr>
            <th><?= __('Report Pdf') ?></th>
            <td>
				<?php
					echo $this->Html->link('Report Pdf File', '/files/AnnualReports/report_pdf_file_path/'. $circular->report_pdf);
				?>
		</td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($circular->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($circular->modified) ?></td>
        </tr>
    </table>
</div>
	</div>
</div>
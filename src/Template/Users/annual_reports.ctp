<table class="table custom_table">
	<thead>
	  <tr>
		<th>Date</th>
		<th>Type</th>
		<th>Details</th>
		<th>View</th>
	  </tr>
	</thead>
	<tbody>
		<?php foreach ($annual_reports as $annual_report): ?>
		<tr>
			<td><?php echo date('m/d/Y', strtotime($annual_report->created)) ?></td>
			<td class="f9 PT12"><?= h($annual_report->name) ?></td>
			<td><a href="#demo<?= h($annual_report->id) ?>" class="toggle plus" data-toggle="collapse" title="<?= h($annual_report->name) ?>"><?php echo $this->Text->truncate(h($annual_report->company_name).' '.h($annual_report->name).' '.h($annual_report->report_year), 30, ['ellipsis' => '...', 'exact' => false]); ?></a></td>
			<td class="f9 PT12"><?= $this->Html->link('VIEW ONLINE',  ['controller' => 'AnnualReports', 'action' => 'user_view', $annual_report->id, '_full' => true], ['class' => 'button']);?></td>
		</tr>
		<tr id="demo<?= h($annual_report->id) ?>" class="collapse demo">
			<td colspan="4">
				<div class="collapse_cont col-md-12">
					<div class="row">
						<div class="col-md-5 left_cont">
						<p><?php echo $this->Html->image("../files/Companies/image_url/".$annual_report->company->image_url,['width'=>'100px']);?></p>
							NAME: <?= $annual_report->company->name; ?><br/>
							STOCK CODE: <?= $annual_report->company->stock_code; ?><br/>
							MARKET: <?= $annual_report->company->market; ?><br/>
							SECTOR: <?= $annual_report->company->sector; ?><br/>
							WEBSITE: <a href="<?= $annual_report->company->website; ?>" title="VISIT OFFICIAL WEBSITE" target="_blank">VISIT OFFICIAL WEBSITE</a>
						</div>
					<div class="col-md-7 right_cont">
					<?= $annual_report->company->description; ?>
					</div>
					</div>
				</div>
		  </td>
		</tr>
		<?php endforeach; ?>
	</tbody>
	</table>
	<div class="text-right ar_pagelinks">
		<?= $this->Paginator->numbers(['url'=>['action'=>'get_annual_reports']]) ?>
	</div>
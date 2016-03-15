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
			<?php foreach ($circulars as $circular): ?>
			<tr>
				<td><?php echo date('m/d/Y', strtotime($circular->created)) ?></td>
				<td class="f9 PT12"><?= h($circular->name) ?></td>
				<td><a href="#circular<?= h($circular->id) ?>" class="toggle plus" data-toggle="collapse" title="<?= h($circular->name) ?>"><?= h($circular->company_name).' '.h($circular->name).' '.h($circular->circular_year) ?></a></td>
				<td class="f9 PT12"><?= $this->Html->link('VIEW ONLINE',  ['controller' => 'Circulars', 'action' => 'user_view', $circular->id, '_full' => true], ['class' => 'button']);?></td>
			</tr>
			<tr id="circular<?= h($circular->id) ?>" class="collapse demo">
				<td colspan="4">
					<div class="collapse_cont col-md-12">
						<div class="row">
							<div class="col-md-5 left_cont">
							<p><?php echo $this->Html->image("../files/Companies/image_url/".$circular->company->image_url,['width'=>'100px']);?></p>
								NAME: <?= $circular->company->name; ?><br/>
								STOCK CODE: <?= $circular->company->stock_code; ?><br/>
								MARKET: <?= $circular->company->market; ?><br/>
								SECTOR: <?= $circular->company->sector; ?><br/>
								WEBSITE: <a href="<?= $circular->company->website; ?>" title="VISIT OFFICIAL WEBSITE" target="_blank">VISIT OFFICIAL WEBSITE</a>
							</div>
						<div class="col-md-7 right_cont">
						<?= $circular->company->description; ?>
						</div>
						</div>
					</div>
			  </td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<div class="text-right circular">
		<?= $this->Paginator->numbers() ?>
	</div>
<%
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return !in_array($schema->columnType($field), ['binary', 'text']);
    })
    ->take(7);

if (isset($modelObject) && $modelObject->behaviors()->has('Tree')) {
    $fields = $fields->reject(function ($field) {
        return $field === 'lft' || $field === 'rght';
    });
}
%>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-green">
			<div class="panel-heading"><h3><?= __('<%= $pluralHumanName %>') ?></h3></div>
			<div class="panel-body">
				<div class="<%= $pluralVar %>-search">
					<form id="w0" action="" method="get">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group field-search-title">
									<label class="control-label" for="search-title">Title</label>
									<input type="text" id="search-title" class="form-control" name="search[title]">
									<div class="help-block"></div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group field-search-content">
									<label class="control-label" for="search-content">Content</label>
									<input type="text" id="search-content" class="form-control" name="search[content]">

									<div class="help-block"></div>
								</div>	
							</div>
							<div class="col-md-4">
								<div class="form-group field-search-email">
									<label class="control-label" for="search-email">Email</label>
									<input type="text" id="search-email" class="form-control" name="search[email]">

									<div class="help-block"></div>
								</div>	
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Search</button>        
							<button type="reset" class="btn btn-default">Reset</button>   
						</div>
					</form>
				</div>		
	<div class="table">
	<p class="pull-right">
			<?= $this->Html->link(__('New <%= $singularHumanName %>'), ['action' => 'add'], ['class'=>'btn btn-success']) ?> </p>
				<table class="table table-striped table-bordered">
					<thead>
            <tr>
<% foreach ($fields as $field): %>
                <th><?= $this->Paginator->sort('<%= $field %>') ?></th>
<% endforeach; %>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($<%= $pluralVar %> as $<%= $singularVar %>): ?>
            <tr>
<%        foreach ($fields as $field) {
            $isKey = false;
            if (!empty($associations['BelongsTo'])) {
                foreach ($associations['BelongsTo'] as $alias => $details) {
                    if ($field === $details['foreignKey']) {
                        $isKey = true;
%>
                <td><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?></td>
<%
                        break;
                    }
                }
            }
            if ($isKey !== true) {
                if (!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
%>
                <td><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
<%
                } else {
%>
                <td><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></td>
<%
                }
            }
        }

        $pk = '$' . $singularVar . '->' . $primaryKey[0];
%>
                <td class="actions">
					<?= $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span>', ['action' => 'view', <%= $pk %>], ['escape'=>false]) ?>
					<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>', ['action' => 'edit', <%= $pk %>], ['escape'=>false]) ?>
					<?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>', ['action' => 'delete', <%= $pk %>], ['escape'=>false, 'confirm' => __('Are you sure you want to delete # {0}?', <%= $pk %>)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="row">
		<div class="col-lg-6">
			<div class="pagination-panel">
				<?= $this->Paginator->counter(
					'Page {{page}} of {{pages}}, showing {{current}} records out of
					 {{count}} total'
				); ?>
			</div>
		</div>
		<div class="col-lg-6 text-right">
			<div class="pagination-panel">
				<ul class="pagination pagination-sm man">
					<?= $this->Paginator->prev('< ' . __('previous')) ?>
					<?= $this->Paginator->numbers() ?>
					<?= $this->Paginator->next(__('next') . ' >') ?>
				</ul>
			</div>
		</div>
	</div>	
</div>
</div>
		</div>
	</div>
</div>
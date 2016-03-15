<?php
use Cake\Core\Configure;

if (Configure::read('debug')):
    $this->layout = 'error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error400.ctp');

    $this->start('file');
	$this->controller->viewBuilder()->layout('error');
?>
<?php if (!empty($error->queryString)) : ?>
    <p class="notice">
        <strong>SQL Query: </strong>
        <?= h($error->queryString) ?>
    </p>
<?php endif; ?>
<?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
        <?= Debugger::dump($error->params) ?>
<?php endif; ?>
<?= $this->element('auto_table_warning') ?>
<?php
    if (extension_loaded('xdebug')):
        xdebug_print_function_stack();
    endif;

    $this->end();
?>
<h2><?= h($message) ?></h2>
<p class="error">
    <strong><?= __d('cake', 'Error') ?>: </strong>
    <?= sprintf(
        __d('cake', 'The requested address %s was not found on this server.'),
        "<strong>'{$url}'</strong>"
    ) ?>
</p>
<?php else:

	$this->controller->viewBuilder()->layout('error');
?>
<body id="error-page" class="animated bounceInLeft">
<div id="error-page-content"><h1>500!</h1><h4>Internal Server Error</h4>

    <p>The website cannot display the page.</p>

    <p><a href='index.html'>Return home</a> or please come back in a while.</p></div>
</body>
<?php endif;?>
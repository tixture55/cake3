<html>
<head>

<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<style type="text/css">
<!--
body {
	background-color: #CC99CC;
}
-->
</style>
<title>form</title>
<?php echo $this->Html->script('jquery-1.10.1.min'); ?>">
<link rel="stylesheet" href="<?php echo $this->Html->url('/js/jquery-ui-1.11.4/jquery-ui.css'); ?>">
<script src="<?php echo $this->Html->url('/js/jquery-ui-1.11.4/jquery-ui.js'); ?>"></script>

<?php echo $this->Html->script('d957df7'); ?>

<script>
$(function() {
		$( "#accordion" ).accordion({
collapsible: true
});
		});
</script>
</head>
<body>
</p>



<table border="1">
<tr>
<td>
担当者名
</td>
<td>
案件名
</td>
<td>
関連チケット数
</td>
<td>
最終更新日時
</td>
</tr>

<?php
if($users){
	foreach ($users as $this->value) {
		echo '<tr>';
		echo '<td>';
		echo $this->value['name'];
		echo '</td>';
		echo '<td>';
		?>
		<a href="<?php echo $this->Url->build(['controller'=>'Tasks', 'action'=>'detail', 'taskId' => $this->value['id']]); ?>" class="something"><?php echo $this->value['work']; ?></a>

		<?php
                echo '</td>';
		echo '<td>';
		echo $this->value['ticket_num'];
		echo '</td>';
		echo '<td>';
		echo $this->value['last_update'];
		echo '</td>';
		echo '</tr>';
		}
	echo '</table>';
}


?>
<div class="paging">
    <?= $this->Paginator->prev('<< ' . __('prev')); ?>
    <?= $this->Paginator->numbers(); ?>
    <?= $this->Paginator->next(__('next') . ' >>'); ?>
</div>
<?php
	echo '<br>';
	echo '<br>';
	echo '<div id="accordion">';
	echo '<h3>直近のISSUE</h3>';
?>
<table border="1">
<tr>
<td>
担当者名
</td>
<td>
ticketタイトル
</td>
<td>
ticket内容
</td>
<td>
ticket最終更新日時
</td>
<td>
ticket有効期限
</td>
</tr>
<?php

if($tickets){
	foreach ($tickets as $this->value) {
		echo '<tr>';
		echo '<td>';
		echo $this->value['target_name'];
		echo '</td>';
		echo '<td>';
		echo $this->value['title'];
		echo '</td>';
		echo '<td>';
		echo $this->value['details'];
		echo '</td>';
		echo '<td>';
		echo $this->value['last_update'];
		echo '</td>';
		echo '<td>';
		echo $this->value['deadline'];
		echo '</td>';
		echo '</tr>';
		}
	echo '</table>';
}

echo '<table border="1">';
	echo '<div>';
echo '</div>';

echo '</div>';
echo '</p>';


echo '<h3>新しいチケット作成</h3>';
echo '<div>';
echo $this->Form->create('hello', array('url' => 'add','method' => 'post'));
 /*echo $this->Form->hidden(
                 'id' ,
                 array('value' => $id)
                 );*/
 echo $this->Form->hidden(
                 'trans_status' ,
                 array('value' => 0)
                 );
 echo $this->Form->input(
                 'hello.plice',
                 array('label' => 'チケットタイトル')
                 );
 echo $this->Form->input(
                 'hello.bank',
                 array('label' => '内容')
                 );
 echo $this->Form->input(
                 'hello.account',
                 array('label' => '担当者名')
                 );
echo $this -> Form -> submit ( "チケット作成");
 //echo $this->Form->end();
 echo '<p>';
 echo '</ul>';
 echo '</div>';
?>
</p>
</body>
</html>


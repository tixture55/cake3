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
<script src="<?php echo $this->Html->script('/js/jquery-1.10.1.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo $this->Html->url('/js/jquery-ui-1.11.4/jquery-ui.css'); ?>">
<script src="<?php echo $this->Html->url('/js/jquery-ui-1.11.4/jquery-ui.js'); ?>"></script>

<?php echo $this->Html->script('/js/957df7.js'); ?>

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

/*if($posts){
	foreach ($posts as $this->value) {
		echo '<tr>';
		echo '<td>';
		echo $this->value['name'];
		echo '</td>';
		echo '<td>';
		echo $this->value['work'];
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
*/
if($users){
	foreach ($users as $this->value) {
		echo '<tr>';
		echo '<td>';
		echo $this->value['name'];
		echo '</td>';
		echo '<td>';
		echo $this->value['work'];
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

if(isset($balance)){
	$balance_last_modify = array_pop($balance);
	$balance_money = array_pop($balance);

	echo '<table border="1">';
	echo $this->Html->tableCells(array(
				'口座残高','最終入出金日時'
				));
	echo $this->Html->tableCells(array(
				number_format($balance_money).'円',$balance_last_modify

				));
	echo '</table>';
}
echo '<table border="1">';
echo $this->Html->tableCells(array(
			array(
				$this->Html->link(
					'残高照会',
					array(
						'outputOtherAccount',
						'index'


						)),

				),
				array())) 
	. PHP_EOL;
	echo '<div>';
	echo '<p>';
if(isset($history)){

		echo 'お客様ID:'.$history["customerID"];
		echo '<br>';
		echo '出金金額(手数料込み):'.number_format($history["output_value"]).'円';
		echo '<br>';
		echo '出金日時:'.$history["output_date"];
	}else{
		echo '現在やりとりされているISSUEはありません。';
	}
echo '</p>';
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


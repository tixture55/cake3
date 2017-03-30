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
<script src="<?php echo $this->Html->url('/js/jquery-1.10.1.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo $this->Html->url('/js/jquery-ui-1.11.4/jquery-ui.css'); ?>">
<script src="<?php echo $this->Html->url('/js/jquery-ui-1.11.4/jquery-ui.js'); ?>"></script>

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
お客様ID
</td>
<td>
姓
</td>
<td>
名
</td>
<td>
電話番号
</td>
</tr>

<?php
if(isset($list)){
	foreach ($list as $this->value) {
		echo '<tr>';
		echo '<td>';
		echo $this->value['ID'];
		echo '</td>';
		echo '<td>';
		echo $this->value['LASTNAME'];
		echo '</td>';
		echo '<td>';
		echo $this->value['FNAME'];
		echo '</td>';
		echo '<td>';
		echo $this->value['TELE'];
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
	echo '<div id="accordion">';
	echo '<h3>直近の出金履歴</h3>';
	echo '<div>';
	echo '<p>';
if(isset($history)){

		echo 'お客様ID:'.$history["customerID"];
		echo '<br>';
		echo '出金金額(手数料込み):'.number_format($history["output_value"]).'円';
		echo '<br>';
		echo '出金日時:'.$history["output_date"];
	}else{
		echo '現在出金履歴はありません。';
	}
echo '</p>';
echo '</div>';
echo '<h3>出金処理</h3>';
echo '<div>';
echo $this->Form->create('hello', array('action' => 'add','method' => 'post'));
echo $this->Form->hidden(
		'id' ,
		array('value' => $id)
		);
echo $this->Form->hidden(
		'trans_status' ,
		array('value' => 0)
		);
echo $this->Form->input(
		'hello.plice',
		array('label' => '金額')
		);
echo $this->Form->input(
		'hello.bank',
		array('label' => '入金先銀行')
		);
echo $this->Form->input(
		'hello.account',
		array('label' => '入金先口座番号')
		);
echo $this->Form->end('出金');
echo '<p>';
echo '</ul>';
echo '</div>';

echo '<h3>振込処理</h3>';
echo '<div>';
echo '<p>';
echo $this->Form->create('hello', array('action' => 'add','method' => 'post'));
echo $this->Form->hidden(
		'id' ,
		array('value' => $id)
		);
echo $this->Form->input(
		'transfer',
		array('label' => '金額')
		);
echo '</p>';
echo '<p>';
echo $this->Form->input(
		'trans_acc',
		array('label' => '入金先お客様ID')
		);
echo '</p>';
echo '<p>';
echo $this->Form->end('振込確認');
echo '</p>';
echo '</ul>';
echo '</div>';



echo '</div>';
echo '</p>';

echo $this->Form->create('hello', array('action' => 'add','method' => 'post'));

?>
</p>
</body>
</html>


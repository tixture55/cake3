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

<?php
$work = array();
if($posts){
	foreach ($posts as $this->value) {
            $work = $this->value['work'];
}
}
?> 


<table border="1">
<tr>
<td width="100">
案件名
</td>
<td width="200">
<?php echo $work; ?>
</td>
</tr>
<tr>
<td>
総コミット数</td>
<td>
</td>
</tr>
<tr><td>
クライアント名
</td>
</tr>
<tr><td>
重要度</td>
</tr>
<?php

		echo '</tr>';

	echo '</table>';

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


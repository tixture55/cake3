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
if($task_details){
	foreach ($task_details as $this->value) {
            $tag = $this->value['tag'];
            $commit_num = $this->value['commit_num'];
            $client_name = $this->value['client_name'];
            $recent_ticket = $this->value['recent_ticket'];
        }
}
?> 


<table border="1">
<tr>
<td width="100">
<?php echo $titles[0]; ?>
</td>
<td width="200">
<?php echo $work; ?>
</td>
</tr>
<tr>
<td>
<?php echo $titles[1]; ?>
</td>
<td>
<?php echo $commit_num; ?></td>
</tr>
<tr>
<td>
<?php echo $titles[2]; ?>
</td>
<td>
<?php echo $client_name; ?></td>
</tr>
<tr>
<td>
<?php echo $titles[3]; ?>
</td>
<td>
<?php echo $recent_ticket; ?></td>
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


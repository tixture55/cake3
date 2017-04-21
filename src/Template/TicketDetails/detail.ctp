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
<?php echo $this->Html->script('/js/d957df7'); ?>


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

if($tickets){
	foreach ($tickets as $this->value) {
            $ticket_name = $this->value['title'];
            $status = $this->value['status'];
            $ticket_detail = $this->value['details'];
            $last_update = $this->value['last_update'];
        }


}

/*if($task_details){
	foreach ($task_details as $this->value) {
            $tag = $this->value['tag'];
            $commit_num = $this->value['commit_num'];
            $client_name = $this->value['client_name'];
            $recent_ticket = $this->value['recent_ticket'];
        }
}*/
?> 


<table border="1">
<tr>
<td width="100">
<?php echo $titles[0]; ?>
</td>
<td width="200">
<?php echo $ticket_name; ?>
</td>
</tr>
<tr>
<td>
<?php echo $titles[1]; ?>
</td>
<td>
<?php echo $status; ?></td>
</tr>
<tr>
<td>
<?php echo $titles[2]; ?>
</td>
<td>
<?php echo $work; ?></td>
</tr>
<tr>
<td>
<?php echo $titles[3]; ?>
</td>
<td>
<?php echo $ticket_detail; ?></td>
</tr>
<tr>
<td>
<?php echo $titles[4]; ?>
</td>
<td>
<?php echo $last_update; ?></td>
</tr>
<?php

		echo '</tr>';

	echo '</table>';

?>
</p>
</body>
</html>


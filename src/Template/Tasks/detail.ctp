<?php
$work = array();
if($posts){
	foreach ($posts as $this->value) {
            $work = $this->value['work'];
        }
}
if($task_details){
	foreach ($task_details as $this->value) {
            $task_id = $this->value['task_id'];
            $tag = $this->value['tag'];
            $commit_num = $this->value['commit_num'];
            $client_name = $this->value['client_name'];
            $recent_ticket = $this->value['recent_ticket'];
        }
}
$details = array();
if($tickets){
	foreach ($tickets as $this->value) {
            array_push($details , $this->value['details']);
        }
}
?> 


<table class="center-table" border="1">
<tr>
<td width="100" id="test">
<?php echo $titles[0]; ?>
</td>
<td width="200" id="test">
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
<?php foreach($details as $val){ ?>	
	<a href="<?php echo $this->Url->build(['controller'=>'Tickets', 'action'=>'detail', 'ticket_id' => $task_id]); ?>" class="something"><?php echo $val; ?></a>
<?php echo '<br>'; ?>
<?php echo '<br>'; ?>
<?php } ?>
</tr>
<tr>
<td>
<?php echo $titles[4]; ?>
</td>
<td>
<?php echo $tag; ?></td>
</tr>
<?php

		echo '</tr>';

	echo '</table>';

echo '<div class="ticket-title"><h3>新しいチケット作成</h3></div>';
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


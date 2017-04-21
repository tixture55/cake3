<?php echo $this->element('header'); ?>

<table border="1">
<tr>
<td>
<?php echo $titles[0]; ?>

</td>
<td>
<?php echo $titles[1]; ?>
</td>
<td>
<?php echo $titles[2]; ?>
</td>
<td>
<?php echo $titles[3]; ?>
</td>
</tr>

<?php
$works = array();

if($tasks){
	foreach ($tasks as $this->value) {
		array_push($works , $this->value['work']);
	}
}

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
	echo '<h3>直近のチケット</h3>';
	echo '<br>';
?>
<div class = "phui-header-header">
<div id="table-container">
<table border="1">
<tr>
<td>
ticket status
</td>
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
		echo '<span><span class="phui-tag-core ">';
		echo $this->value['status'].'</span><span>';
		echo '</td>';
		echo '<td>';
		echo $this->value['target_name'];
		echo '</td>';
		echo '<td>';
		
		?>
                <a href="<?php echo $this->Url->build(['controller'=>'Tickets', 'action'=>'detail', 'ticket_id' => $this->value['id']]); ?>" class="something"><?php echo $this->value['title']; ?></a>
		<?php 
                echo '</td>';
		echo '<td>';
		echo $this->value['details'];
		echo '</td>';
		echo '<td>';
		echo $this->value['last_update'];
		echo '</td>';
		echo '<td id="deadline">';
		echo $this->value['deadline'];
		echo '</td>';
		echo '</tr>';
		}
	echo '</div>';
	echo '</table>';
}
echo '</div>';

echo '<table border="1">';
	echo '<div>';
echo '</div>';

echo '</div>';
echo '</p>';
echo '</br>';
echo '</br>';


$id = $this->request->data('hello.plice');


echo '<h3>新しいチケット作成</h3>';
echo '<div id="main">';
echo $this->Form->create('hello', array('url' => '/posts','method' => 'post'));
 /*echo $this->Form->hidden(
                 'id' ,
                 array('value' => $id)
                 );*/
 echo $this->Form->hidden(
                 'trans_status' ,
                 array('value' => 0)
                 );
 echo $this->Form->input(
                 'ticket_title',
                 array('label' => 'チケットタイトル')
                 );
 echo $this->Form->input(
                 'works',
                 array('label' => '案件名','options' =>$works)
                 );
 echo $this->Form->input(
                 'detail',
                 array('label' => '内容')
                 );
 echo $this->Form->input(
                 'target_name',
                 array('label' => '担当者名')
                 );
//echo $this -> Form -> submit ("チケット作成"); 
 //echo $this->Form->end();
echo $this->Form->submit(__(' チケット作成 ',true),array(
    'name' => 'send',
));
 echo '<p>';
 echo '</ul>';
 echo '</div>';
?>
</p>
<br>
<br>
<br>
</body>
</html>


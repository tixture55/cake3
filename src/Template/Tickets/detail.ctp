<?php 

$work = array();

if($posts){
	foreach ($posts as $this->value) {
            $work = $this->value['work'];
        }
}
if($tickets){
	foreach ($tickets as $this->value) {
            $ticket_id = $this->value['id'];
            $ticket_name = $this->value['title'];
            $status = $this->value['status'];
            $ticket_detail = $this->value['details'];
            $last_update = $this->value['last_update'];
        }


}

?> 

<div class = "phui-header-header">

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
<span><span class="phui-tag-core ">
<?php echo $status.'</span><span>'; ?></td>
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
</div>
<div class="phui-box phui-box-border phui-object-box mlt mll mlr phui-box-blue-property "><div class="phui-header-shell "><h1 class="phui-header-view"><div class="phui-header-row"><div class="phui-header-col2"><span class="phui-header-header">チケットへの返信</span></div>

	<div class="phui-header-col3"></div></div></h1></div>
		<div class="phui-property-list-section"><div class="phui-property-list-container grouped">
			<div class="phui-property-list-properties-wrap "><dl class="phui-property-list-properties">
				<dt class="phui-property-list-key">
					<?php //if(isset($ticket_reply_detail)) echo $ticket_reply_detail; ?>
					<?php 
	foreach ($ticket_replies as $this->value) {
             echo $this->value['details'];
	     echo '<br>';
	     echo '<hr>';
        }
					?>

				</dt>
</a>
	</div>
<div class="phui-box phui-box-border phui-object-box mlt mll mlr phui-box-blue-property "><div class="phui-header-shell "><h1 class="phui-header-view"><div class="phui-header-row"><div class="phui-header-col2"><span class="phui-header-header">Details</span></div><div class="phui-header-col3"></div></div></h1></div><div class="phui-property-list-section"><div class="phui-property-list-container grouped"><div class="phui-property-list-properties-wrap "><dl class="phui-property-list-properties"><dt class="phui-property-list-key">Commits #総コミット数：<?php echo $commit_num; ?> </dt><dd class="phui-property-list-value"><a href="/D12052">
<?php if($commits){
	foreach ($commits as $this->value) {
             echo '　';
	     echo $this->value['title'];
	     echo '<br>';
        }
}
?>
</a>
</div>
</div>
</div>
<div class="reply">
<div class="phui-box phui-box-border phui-object-box mlt mll mlr phui-box-blue-property "><div class="phui-header-shell "><h1 class="phui-header-view"><div class="phui-header-row"><div class="phui-header-col2"><span class="phui-header-header">Reply</span></div><div class="phui-header-col3"></div></div></h1></div><div class="phui-property-list-section"><div class="phui-property-list-container grouped"><div class="phui-property-list-properties-wrap "><dl class="phui-property-list-properties"><dt class="phui-property-list-key">

<?php echo '<div id="main">';

//replyボタンを押した場合はticket_idのパラメータを持っていないため、DBから値が取れなくて、画面が真っ赤になる
echo $this->Form->create('Tickets', array('url' => '/tickets/detail?ticket_id='.$ticket_id,'method' => 'post'));
 /*echo $this->Form->hidden(
                 'id' ,
                 array('value' => $id)
                 );*/
 echo $this->Form->hidden(
                 'trans_status' ,
                 array('value' => 0)
                 );
$items = array('0'=>'open','1'=>'close');
echo $this->Form->input('status',
		  array('type'=>'select',
       			'label'=>'status',
			'options'=>$items));
echo $this->Form->input(
                 'detail',
                 ['placeholder' => '内容を入力してください', 'label' => '内容']		 
                 );
 echo $this->Form->input(
                 'target_name',
                 ['placeholder' => '担当者を入力してください', 'label' => '担当者']		 
		 
                 );
echo $this -> Form -> submit ( "reply");
 echo '<p>';
 echo '</ul>';
 echo '</div>'; ?>


</div>
</div>
</div>
</div>
<br>
<br>
<br>
</body>
</html>


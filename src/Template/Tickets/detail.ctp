<?php 


$work = array();

if($posts){
	foreach ($posts as $this->value) {
            	
		$posts_id = $this->value['posts_id'];
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
if($ticket_replies){
	foreach ($ticket_replies as $this->value) {
            $status = $this->value['status'];
	}


}

?> 
<div class = "phui-header-header">

<table border="1">
<tr>
<td width="100">
<?php echo $titles[0]; ?>
</td>
<td id="ticket_id" width="200">
<?php echo $ticket_id; ?>
</td>
</tr>
<tr>
<td width="100">
<?php echo $titles[1]; ?>
</td>
<td width="200">
<?php echo $ticket_name; ?>
</td>
</tr>
<tr>
<td>
<?php echo $titles[2]; ?>
</td>
<td>
<span><span class="phui-tag-core ">
<?php echo $status.'</span><span>'; ?></td>
</tr>
<tr>
<td>
<?php echo $titles[3]; ?>
</td>
<td>
<?php echo $work; ?></td>
</tr>
<tr>
<td>
<?php echo $titles[4]; ?>
</td>
<td>
<?php echo $ticket_detail; ?></td>
</tr>
<tr>
<td>
<?php echo $titles[5]; ?>
</td>
<td>
<?php echo $last_update; ?></td>
</tr>
<?php

		echo '</tr>';
?>
<tr>
<td>
<?php echo $titles[6]; ?>
</td>
<td>
<?php 
   if(isset($isReadTicket) && $isReadTicket){
      echo '<div id="read_status">既読';
   }else{
      echo '<div id="read_status">未読　　';
      echo $this->Form->button('既読にする',
			 ['type' => 'button',
			  'class' => 'button3'
			]);
   }
?>
</div>
<?php 
//echo $read_status; ?></td>
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
					<?php 
	foreach ($ticket_replies as $this->value) {
             echo htmlspecialchars($this->value['target_name'] ,ENT_QUOTES , 'UTF-8').": ".htmlspecialchars($this->value['details'] , ENT_QUOTES , 'UTF-8');
	     echo '<br>';
	     echo '<hr>';
        }
					?>

				</dt>
</a>
	</div>
<div class="phui-box phui-box-border phui-object-box mlt mll mlr phui-box-blue-property "><div class="phui-header-shell "><h1 class="phui-header-view"><div class="phui-header-row"><div class="phui-header-col2"><span class="phui-header-header">Details</span></div><div class="phui-header-col3"></div></div></h1></div><div class="phui-property-list-section"><div class="phui-property-list-container grouped"><div class="phui-property-list-properties-wrap "><dl class="phui-property-list-properties"><dt class="phui-property-list-key">Commits #総コミット数：<?php echo $commit_num; ?> </dt><dd class="phui-property-list-value">


<?php
echo $this -> Form -> text( "textbox", [ "class" => "commit_search"] );
echo '<br>';
echo $this->Form->button('コミットの検索', [ 'id' => 'commit' ,"class" => "commit_search", 'type' => 'button']);
echo '<br>';
echo '<br>';
$pieces = array();

if($commit_arr){
          foreach ($commit_arr as $this->value) {
               echo '　';
               $pieces = explode(" ", $this->value);
	       ?>
	       <a href="<?php echo $this->Url->build(['controller'=>'Commits','action'=>'detail','ticket_id' => $ticket_id, 'commit_id' => $pieces[0]]); ?>" class="something">
               <?php echo '<span><span class="phui-tag-core ">'.$pieces[0].'</span></span>';
	       $commit_detail = str_replace($pieces[0] , "" , $this->value);
	       echo ' '.$commit_detail;
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

//echo $this->Form->create('Tickets', array('url' => '/tickets/detail?ticket_id='.$ticket_id,'method' => 'post'));
if(isset($reply_data)){
    echo $this->Form->create($reply_data , array('method' => 'post'));
}else{
    echo $this->Form->create('Tickets', array('url' => '/tickets/detail?ticket_id='.$ticket_id,'method' => 'post'));

}
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
		 array('maxlength'=>400,
		       'placeholder' => '内容を入力してください',
		       'label' => '内容'
		)
                 );
 echo $this->Form->input(
                 'target_name',
		 array('maxlength'=>10,
		       'placeholder' => '担当者を入力してください',
		       'label' => '担当者'
		)
		 
                 );
echo $this->Form->submit(__(' reply ',true),array(
    'name' => 'send',
));
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


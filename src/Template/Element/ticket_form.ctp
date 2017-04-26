<?php
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
if(isset($works)){
 echo $this->Form->input(
                 'works',
                 array('label' => '案件名','options' =>$works)
                 );
}
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

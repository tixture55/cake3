<?php 
use Cake\Routing\Router;
                                                                          use Cake\Routing\Route\DashedRoute;

echo $this->Html->script('jquery-1.10.1.min'); ?>">
<?php echo $this->Html->script('/js/ajax'); 

//echo $this->Html->url(array('controller' =>'Ajax','action' => 'ajaxTest'));
//echo Router::url(array('controller' =>'Ajax','action' => 'ajaxTest'));
?>
<button onclick="ajaxMethod();">ajaxTest</button>

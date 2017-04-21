<?php

//CakePHP3のPostsTable.php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CommitsTable extends Table {

	public function initialize(array $config)
        {
		$this->belongsTo('Posts', [
            		'foreignKey' => 'posts_id'
        	]);
        }

}

<?php

//CakePHP3のPostsTable.php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TicketsTable extends Table {

	public function initialize(array $config)
        {
		$this->belongsTo('Posts', [
            		'foreignKey' => 'posts_id'
        	]);
        }
	/*public function validationDefault(Validator $validator)
	{
		$validator
			//notEmptyの記述。第二引数はメッセージ
			->notEmpty('detail', 'required mail')
			//メール形式のチェック
			->add('detail', 'validFormat', [
					'rule' => 'email',
					'message' => 'E-mail must be valid'
			])
			;
		return $validator;
	}*/
	public $validate = [
        'detail' => [
            [
                'rule' => 'notBlank',
                'message' => '内容は必須入力の項目です。',
            ],
        ],
	]; 
}

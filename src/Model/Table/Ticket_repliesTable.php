<?php

//CakePHP3のPostsTable.php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use App\Event\ContactsListener;

class Ticket_repliesTable extends Table {

	public function initialize(array $config)
        {
		$this->belongsTo('Posts', [
            		'foreignKey' => 'posts_id'
        	]);

            $listener = new ContactsListener();
            $this->eventManager()->on($listener);
        }



    public function checkDuplicates()
    {
        $arr = ['a'=> 1, 'b'=> 2];
        //... some code here
        $event = new Event('Model.Contacts.afterDuplicatesCheck', $this, [
            'duplicates' => $arr
        ]);
        $this->eventManager()->dispatch($event);
        return true;

    }

	public function validationDefault(Validator $validator)
	{
		$validator
			//notEmptyの記述。第二引数はメッセージ
			->requirePresence('detail')
            ->notEmpty('detail', 'required mail');
			//メール形式のチェック
			/*->add('detail', 'validFormat', [
					'rule' => 'email',
					'message' => 'E-mail must be valid'
			])*/
        $errors = [
            'detail' => ['please enter detail.']
        ];
		return $validator;
	}
}

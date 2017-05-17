<?php

//CakePHP3のPostsTable.php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use App\Event\ContactsListener;

class TicketsTable extends Table {

	public function initialize(array $config)
        {
		$this->belongsTo('Posts', [
            		'foreignKey' => 'posts_id'
        	]);

            $listener = new ContactsListener();
            $this->eventManager()->on($listener);
        }

    public function beforeFind(Event $event , $entity , $options) {
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
            ->notEmpty('detail', 'detail must be written.')
            ->notEmpty('target_name', 'target_name must be written.');
		return $validator;
	}
}

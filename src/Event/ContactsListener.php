<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/05/15
 * Time: 22:05
 */
namespace App\Event;

use Cake\Event\Event;
use Cake\Event\EventListenerInterface;
use Cake\Log\Log;

class ContactsListener implements EventListenerInterface
{

    public function implementedEvents()
    {
        return [
            'Model.afterDuplicatesCheck' => 'createNotificationAfterCheckDuplicates',
        ];
    }

    public function createNotificationAfterCheckDuplicates(Event $event, array $duplicates)
    {
        dump($event);
        Log::debug('Here I am');
    }
}
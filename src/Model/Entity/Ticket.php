<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/05/17
 * Time: 7:23
 */

namespace App\Model\Entity;
use Cake\ORM\Entity;
use Cake\Collection\Collection;

class Ticket extends Entity
{
    protected $_accessible = [
        'params' => true,
        'user_id' => true,
        'title' => true,
        'description' => true,
        'url' => true,
        'user' => true,
        'tags' => true,
        'tag_string' => true,
    ];
}
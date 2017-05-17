<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/05/18
 * Time: 5:33
 */

namespace App\Controller;


class Singleton
{
    private $_id;

    private static $_instance;

    /**
     * コンストラクタ
     */
    private function __construct() {
        $this->_id = md5(date('ymdhis') . mt_rand());
    }

    /**
     * クラスを生成する為の唯一の窓口
     */
    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new Singleton;
        }

        return self::$_instance;
    }
    /**
     * IDを返す
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * 複製を禁止する
     */
    public final function __clone()
    {
        throw new RuntimeException('Singletonパターンの為、cloneキーワードの使用は禁止されています。');
    }
}
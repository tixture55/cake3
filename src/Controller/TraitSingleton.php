<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/05/18
 * Time: 4:50
 */

namespace App\Controller;
use App\Core as Core;
trait TraitSingleton
{
    /**
     * get instance.
     */
    public static function getInstance() {
        static $instance; // 静的なinstanceを保持するための変数

        // インスタンスが存在しない時だけインスタンスを作る
        if(! $instance)
        {
            // 遅延静的束縛
            $reflection = new ReflectionClass(get_called_class());
            $construct = $reflection->getConstructor();
            $construct->setAccessible(true);

            // インスタンスをコンストラクタ無しで作成
            $instance = $reflection->newInstanceWithoutConstructor();

            // コンストラクタを実行する
            $construct->invokeArgs($instance ,func_get_args());
        }

        return $instance;
    }
    /**
     * the instance clone is not allowd
     * @throws RuntimeException
     */
    public final function __clone()
    {
        throw new RuntimeException('Clone is not allowed against ' . get_called_class($this));
    }
}
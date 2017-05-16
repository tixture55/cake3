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


    public function colorScheme(String $source_code){

        $replace_br = str_replace("@@", "<br><br>", $source_code);
        $replace_br = str_replace("+", "<br><div class=\"plus\">+", $replace_br);

        $replace_br = str_replace(");", ");</div><br>", $replace_br);
        $replace_br = preg_replace("/class[^=]/", "<font color=\"green\">class </font>", $replace_br);
        $replace_br = preg_replace("/abstract|protected|public|return|extends|final|new/", "<font color=\"green\">$0 </font>", $replace_br);
        $replace_br = preg_replace("/\&|\-/", "<font color=\"red\">$0</font>", $replace_br);
        $replace_br = preg_replace("/true|DESC/", "<font color=\"red\">$0</font>", $replace_br);
        $replace_br = preg_replace("/this/", "<font color=\"blue\">$0</font>", $replace_br);
        $replace_br = preg_replace("/\+/", "<font color=\"blue\">$0</font>", $replace_br);
        $replace_br = preg_replace("/\/\/.*/", "<font color=\"blue\">$0</font>", $replace_br);
        $replace_br = preg_replace("/\/\*.*/", "<font color=\"blue\">$0</font>", $replace_br);

        return $replace_br;
    }

}

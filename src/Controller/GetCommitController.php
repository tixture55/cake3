<?php
namespace App\Controller;

final class GetCommitController {


        //画面によって、セットするタイトルを変える
	public function getCommit(int $start , int $end){
		
		$commit_arr = array();
		
		while($end - $start >= 0){
			$shell_str = "git log --oneline | sed -n -e ".$start."p";
			$start = $start + 1;
			array_push($commit_arr ,shell_exec($shell_str));
 		}
		
		return $commit_arr;
	}
	
	public function getCommitNumber(){

		$commit_num = shell_exec("git log --oneline | wc -l");

		return $commit_num;		

	}
	public function getCommitFileDiff(){

		$file_diff = shell_exec("git diff --stat ".$commit_id." ".$commit_id2);

		return $file_diff;		

	}

}

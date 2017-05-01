<?php
namespace App\Controller;

final class GetCommitController {


        //画面によって、セットするタイトルを変える
	public function getId(int $start , int $end){
		
		$commit_arr = array();
		
		while($end - $start >= 0){
			$shell_str = "git log --oneline | sed -n -e ".$start."p";
			$start = $start + 1;
			array_push($commit_arr ,shell_exec($shell_str));
 		}
		
		return $commit_arr;
	}
	
	public function getBranch(){

		$branch = shell_exec("git branch");
                $b_arr = explode(" ",$branch);

                $key = array_search('master' , $b_arr);
                if(isset($key)){
			$branch = "master"; 
			return $branch;		
		}else{
			$key = array_search('*' , $b_arr);
			
			return $b_arr[$key + 1];
		}
	}

	public function getCommitNumber(){

		$commit_num = intval(shell_exec("git log --oneline | wc -l"));

		return $commit_num;		

	}
	public function getCommitFileDiff($commit_id , $commit_id2){

	        $shell_str = "git diff --stat ".$commit_id." ".$commit_id2;
		$file_diff = shell_exec($shell_str);
                
		return $file_diff;		

	}
	
	public function getCommitFileDiffDetail($commit_id , $commit_id2){

	        $shell_str = "git diff ".$commit_id." ".$commit_id2;
		$file_diff = shell_exec($shell_str);
		
                
		return $file_diff;		

	}

}

<?php
/*
Strictly following the word instructions 
disregarding the first sample output
as it is same with second output [confusing]
*/
class JosefDS{

	private $limit 		= 1;
	private $arr_given 	= array();

	public function __construct(){
		// echo " --- construct<hr>";
		// Pass the given pathfiles upon construct
		$this->arr_given =
		[
			'/home/user/folder1/folder2/kdh4kdk8.txt',
			'/home/user/folder1/folder2/565shdhh.txt',
			'/home/user/folder1/folder2/folder3/nhskkuu4.txt',
			'/home/user/folder1/iiskjksd.txt',
			'/home/user/folder1/folder2/folder3/owjekksu.txt',
		];
	}


	public function parsePathfiles()
	{
		/* Now, satisfy two things here.
		(1) Parse and convert each path into an array
		(2) Add a method to this class that converts the output of the first method into a *tree array*
		*/
	    $result = array();
	    $array 	= $this->arr_given;

	   	foreach ($array as $val)
	    {
	        $parts = explode('/', $val);
	        $pathfile = &$result;
	        for ($i = 1, $max = count($parts)-1; $i < $max; $i++)
	        { 
	        	// print_r($parts[$i+1]);echo"<br>"; // uncomment to debug
	            if (!isset($pathfile[$parts[$i]]))
	            {
	                 $pathfile[$parts[$i]] = array();
	            }
	            $pathfile = &$pathfile[$parts[$i]];
	        }
	        $pathfile[] = $parts[$i];
	        // break;
	    }

	    return $result; // THIS RESULT IS IN TREE ARRAY FORMAT
	}

	public function printRecursively($array){
		/*
			a method that recursively prints the above array
		*/
		$depth = 6; // accomodates from 0 to 5

		$tab_spaces = "&nbsp;&nbsp;&nbsp;&nbsp;"; 

		for ($i=0; $i < $depth; $i++) {
			# code...
			$newarr = "";
			$path = "";
			if ($i==0){
				$arr = $array;
			}
			// this loop takes the maximum leafs per branch level
			foreach ($arr as $k => $v) {
				if (is_array($v)){
					$newarr = $v;
					$path = "$tab$k";
				}else{
					echo "$tab$v";
					echo "<br>";
				}
			}
			echo $path."<br>";
			$arr = (!empty($newarr)) ? $newarr : array();

			$tab .= $tab_spaces;
			
		}
	}

	public function generateRandomPathfiles($basepath, $paths, $depth, $files){
		// returns an array of randomly generated file paths
		$result = array();

		// set files limit per depth
		for ($i=$this->limit; $i <= $depth; $i++) { 
			$arr_depthlimit[$i] = $files;
		}
		
		// GENERATE RANDOM FILE PATHS STORED IN AN ARRAY
		$i=0;
		while ($i < $paths) {			
			// generate random file with 8 character filename
			$filename = substr(md5(microtime()),rand(0,26), 8)."txt"; 
			// generate depth
			$randepth = rand($this->limit, $depth);
			// check max number of files in this depth
			if ($arr_depthlimit[$randepth] > 0){
				$folder = "";
				for ($j=1; $j <= $randepth; $j++): $folder .= "folder".$j."/"; endfor;
				$result[$i] = ["/".$basepath."/".$folder.$filename];
				$gen_check = count($result);
				if ($gen_check == $i+1) {
					$i++; // only increment on success
					$arr_depthlimit[$randepth] -= 1;
				}
				
			}
		}

		return $result;
	}

	public function __destruct(){
		// echo "<hr> --- destruct";
	}
}

$sfp = new JosefDS;
$res = $sfp->parsePathfiles($arr);
// NOTE: COMMENT OUT THE FOLLOWING TO VIEW THE TREE ARRAY OUTPUT
// echo "<br><br>RESULT:<br>"; print_r($res);
// echo "<br><br>var_dump:<br>"; var_dump($res); // another is provided to show further
// echo "<br><br>VAR_DUMP FROM folder1:<br>"; var_dump($res['home']['user']['folder1']);


/* Now, this recursively prints the tree array */
echo "<hr>Recursively Print the Array Tree:<br>";
/* CALL THE METHOD RECURSIVELY PRINTS THE TREE ARRAY */
$sfp->printRecursively($res);


/* Finally, returns an array of randomly generated file paths */
echo "<hr>Recursively Print the Array Tree:<br>";
/* GENERATE RANDOM FILE PATHS STORED IN AN ARRAY */
$arr_genpathfiles = $sfp->generateRandomPathfiles("home/user", 5, 3, 3);
var_dump($arr_genpathfiles);


echo "<br><br>by JOSEFDS";
?>

<?php

function sorty($a,$b){
    return strlen($b)-strlen($a);
}


function generate_password($NumWords, $separator){
	require 'google10kwordlist.php';

	$passout = "";
	for ($i=0;$i<$NumWords-1;$i++){
		$randindex =  rand (0, count($wordlist));
		$pass[$i]=$wordlist[$randindex];
		$passout .= $pass[$i].$separator;
	}
	$randindex =  rand (0, count($wordlist));
	$pass[$i]=$wordlist[$randindex];
	$passout .= $pass[$i];

	//echo $randindex;
	return $passout;
}
//usort($wordlist,"sorty");

?>


<?php

function sorty($a,$b){
    return strlen($b)-strlen($a);
}


function generate_password($NumWords, $separator, $NumNums, $WordLengthMin, $WordLengthMax, $CapFirstLetter){
	require 'google10kwordlist.php';

	// sort the wordlist by length of word - longest to shortest
	usort($wordlist,"sorty");

	for ($i=0;$i<count($wordlist);$i++){
		if (strlen($wordlist[$i])<=$WordLengthMax)
			break;
	}
	$MaxIndex = $i;

	for ($i=$MaxIndex;$i<count($wordlist);$i++){
		if (strlen($wordlist[$i])<$WordLengthMin)
			break;
	}
	$MinIndex = $i;

	$passout = "";
	$pass = "";
	
	// prepend the password with $NumNums amount of random numbers
	for ($i=0;$i<$NumNums;$i++){
		$passout .= rand(0,9);
	}
	for ($i=0;$i<$NumWords-1;$i++){
		$randindex =  rand ($MaxIndex, $MinIndex);
		if ($CapFirstLetter=="Yes")
			$pass[$i]=ucfirst($wordlist[$randindex]);
		else
			$pass[$i]=$wordlist[$randindex];
		$passout .= $pass[$i].$separator;
	}
	// to prevent the trailing separator, loop only count()-1 and inline the last word without the separator
	$randindex =  rand ($MaxIndex, $MinIndex);
	if ($CapFirstLetter=="Yes")
		$pass[$i]=ucfirst($wordlist[$randindex]);
	else
		$pass[$i]=$wordlist[$randindex];
	$passout .= $pass[$i];

	// append the password with $NumNums amount of random numbers
	for ($i=0;$i<$NumNums;$i++){
		$passout .= rand(0,9);
	}

//$sorted = usort($wordlist,"sorty");
	//print_r($sorted);
	//print_r($wordlist);
	//echo $randindex;
	return $passout;
}


?>

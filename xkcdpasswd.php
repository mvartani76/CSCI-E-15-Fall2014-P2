
<?php

function sorty($a,$b){
    return strlen($b)-strlen($a);
}


function generate_password($NumWords, $separator, $NumNums, $WordLengthMin, $WordLengthMax, $CapWords, $SpecialChars){
	require 'google10kwordlist.php';

	$specialchar_array = array('~','`','!','@','#','$','%','^','&','*','(',')','_','-','+','=','[',']','{','}','|','\\',':',';','"','\'','<',',','>','.');

	//print_r($specialchar_array);

	// sort the wordlist by length of word - longest to shortest
	usort($wordlist,"sorty");

	// find the index position where the maximum word length is found
	for ($i=0;$i<count($wordlist);$i++){
		if (strlen($wordlist[$i])<=$WordLengthMax)
			break;
	}
	$MaxIndex = $i;

	// find the index position where the minimum word length is found
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
		if ($CapWords=="FirstLetterCap")
			$pass[$i]=ucfirst($wordlist[$randindex]);
		else if ($CapWords=="UpperCase")
			$pass[$i]=strtoupper($wordlist[$randindex]);
		else
			$pass[$i]=$wordlist[$randindex];

		// add a single special character to the end of each word
		if ($SpecialChars=="Yes"){
			$randindex = rand(0, count($specialchar_array)-1);
			$passout .= $pass[$i].$specialchar_array[$randindex].$separator;
		}
		else
			$passout .= $pass[$i].$separator;
	}
	// to prevent the trailing separator, loop only count()-1 and inline the last word without the separator
	$randindex =  rand ($MaxIndex, $MinIndex);
	if ($CapWords=="FirstLetterCap")
		$pass[$i]=ucfirst($wordlist[$randindex]);
	else if ($CapWords=="UpperCase")
		$pass[$i]=strtoupper($wordlist[$randindex]);
	else
		$pass[$i]=$wordlist[$randindex];

	// add a single special character to the end of each word
	if ($SpecialChars=="Yes"){
		$randindex = rand(0, count($specialchar_array)-1);
		$passout .= $pass[$i].$specialchar_array[$randindex];
	}
	else
		$passout .= $pass[$i];

	// append the password with $NumNums amount of random numbers
	for ($i=0;$i<$NumNums;$i++){
		$passout .= rand(0,9);
	}

	return $passout;
}


?>
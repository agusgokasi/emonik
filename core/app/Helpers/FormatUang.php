<?php
function format_uang($angka){ 
    $hasil =  number_format($angka,0, ',' , '.'); 
    return $hasil; 
}

function reduce_money($money){
	$temp_second = "";
	if ($money >= 1000000000000) {
		$temp_second = " triliun";
		$money = round($money/1000000000000 , 2);
		return $money . $temp_second;
	}
	elseif ($money >= 1000000000) {
		$temp_second = " milyar";
		$money = round($money/1000000000,2);
		return $money . $temp_second;
	}
	elseif ($money >= 1000000) {
		$temp_second = " juta";
		$money = round($money/1000000, 2);
		return $money . $temp_second;
	}
	elseif ($money >= 1000) {
		$temp_second = " ribu";
		$money = round($money/1000,2);
		return $money . $temp_second;
	}
	else{
	    return $money;
	}
}
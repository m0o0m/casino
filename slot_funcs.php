<?php

function rnd($min=0,$max=0) {
	mt_srand();
	if($min==$max)return $min;
	elseif($min>$max)
		{
		$m=$min;
		$min=$max;
		$max=$m;
		}
	else return intval(mt_rand()/mt_getrandmax()*($max-$min+1)+$min);
}

function game_ctrl($bet,$win,$bonus_win=0,$type='',$jackpot=0) {

	if(empty($_SESSION['gameBank'])) {
		$_SESSION['gameBank'] = 0;
	}

    global $api;
    if($type != '') {
        $_SESSION['balance'] = $_SESSION['balance'] - $bet + $win + $bonus_win;
        $api->playerBalance = $_SESSION['balance'];
    }

    return true;

	if($win > $_SESSION['gameBank']) {
		return false;
	}
	else {
		if($type !== '') {
			$_SESSION['gameBank'] -= $win;
			$_SESSION['gameBank'] += $bet;
		}

		return true;
	}
}

function getCurrencyChar($curiso) {
	$c=[
        'USD'=>'$',
		'EUR'=>'€',
	    'NAN'=>' ',
		'FPY'=>' ',
		'GBR'=>'£',
    ];
	return (array_key_exists($curiso,$c)?$c[$curiso]:$curiso);
}

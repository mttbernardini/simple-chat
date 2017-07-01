<?php

//FORMAT THE STRING
function format($string) {

$string = htmlspecialchars($string, ENT_COMPAT, "UTF-8");

//replace emoticons
$emot=array(':)'=>'happy', ':D'=>'very_happy', ':d'=>'very_happy', ';)'=>'wink', ':P'=>'tongue', ':p'=>'tongue', ':('=>'sad', ':4'=>'angry', ';('=>'cry', ':S'=>'confused', ':s'=>'confused', ':?'=>'dont_know', ':|'=>'surprised', ':o'=>'omg', ':O'=>'omg', ':1'=>'thoughtful', ':$'=>'embarrassed');
$emoticons='/(:\)|:D|;\)|:P|:\(|:4|;\(|:S|:\?|:\||:o|:1|:\$)/i';

$string=preg_replace_callback($emoticons, function($m) use ($emot) {
	return '<img alt=" '.$m[0].'" src="emoticons/'.$emot[$m[0]].'.gif" class="emot" />';
}, $string);


//replace errors
$string=str_ireplace('perchè', 'perché', $string);
$string=str_replace("PERCHE'", 'PERCHÉ', $string);
$string=str_replace(" E'", ' È', $string);
$string=str_ireplace("poichè", 'poiché', $string);


//BBCode
$bbcodes=array('/\[b\](.+)\[\/b\]/Ui', '/\[i\](.+)\[\/i\]/Ui', '/\[u\](.+)\[\/u\]/Ui', '/\[url\]([a-zA-Z0-9:\.\/\?&%=\-_#]+)\[\/url\]/Ui', '/\[url\=([a-zA-Z0-9:\.\/\?&=%\-_#]+)\](.+)\[\/url\]/Ui');
$html=array('<b>$1</b>', '<i>$1</i>', '<span style="text-decoration:underline;">$1</span>', '<a target="_blank" href="$1">$1</a>', '<a target="_blank" href="$1">$2</a>');

$string=preg_replace($bbcodes, $html, $string);


//return the formatted string
return $string;
}

?>

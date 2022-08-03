$mytext=”nihao”;

function chao_echo(){

global $mytext;

echo $mytext;

echo $GLOBALS['mytext'];



}
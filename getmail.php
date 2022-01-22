<?php  
$mailbox = imap_open("{mail.narwastuarthatama.com:993/imap/ssl/novalidate-cert}INBOX","farhanaldiansyah@narwastuarthatama.com","Joey6661*"); 

$headers = imap_headers($mailbox);

$message = imap_body($mailbox,2); 
// $strmsg = @imap_fetchstructure($mailbox,1); 
// imap_close($mailbox); 
//menampilkan header 
$codes = array("7bit","8bit","binary","base64","quoted-printable","other");
$stt = array("Text","Multipart","Message","Application","Audio","Image","Video","Other");

$pictures = 0;
$html = "";
$horttext = "";

for ($n=1; $n<=count($headers); $n++) {
        $html .=  "<h3>".$headers[$n-1]."</h3><br />";

# Read the email structure and decide if it's multipart or not

        $st = imap_fetchstructure($mailbox, $n);
        $multi = $st->parts;
        $nparts = count($multi);
        if ($nparts == 0) {
                $html .=  "* SINGLE part email<br>";
        } else{
                $html .=  "* MULTI part email<br>";
        }

# look at the main part of the email, and subparts if they're present

        for ($p=0; $p<=$nparts; $p++) {
                $text =imap_fetchbody($mailbox,$n,$p);
                if ($p ==  0) {
                        $it = $stt[$st->type];
                        $is = ucfirst(strtolower($st->subtype));
                        $ie = $codes[$st->encoding];
                } else {
                        $it = $stt[$multi[$p-1]->type];
                        $is = ucfirst(strtolower($multi[$p-1]->subtype));
                        $ie = $codes[$multi[$p-1]->encoding];
                }

# Report on the mimetype

                $mimetype = "$it/$is";
                $html .=  "<br /><b>Part $p ... ";
                $html .=  "Encoding: $ie for $mimetype</b><br />";

# decode content if it's encoded (more types to add later!)

                if ($ie == "base64") {
                        $realdata = imap_base64($text);
                        }
                if ($ie == "quoted-printable") {
                        $realdata = imap_qprint($text);
                        }

# If it's a .jpg image, save it (more types to add later)

                if ($mimetype == "Image/Jpeg") {
                        $picture++;
                        $fho = fopen("imx/mp$picture.jpg","w");
                        fputs($fho,$realdata);
                        fclose($fho);
                        # And put the image in the report, limited in size
                        $html .= "<img src=/demo/imx/mp$picture.jpg width=150><br />";
                }

# Add the start of the text to the message

                $shorttext = substr($text,0,800);
                if (strlen($text) > 800) $horttext .= " ...\n";
                $html .=  nl2br(htmlspecialchars($shorttext))."<br>";
        }
}


// $from_array = imap_mime_header_decode($header->fromaddress); 
// $to_array = imap_mime_header_decode($header->toaddress); 
// print("From : " .htmlspecialchars($from_array[0]->text). "<br>\n"); 
// print("To : " .htmlspecialchars($to_array[0]->text). "<br>\n"); 
// print("Date : " . $header->date . "<br>\n"); 
// print("<br>Message-ID : " .htmlspecialchars($header->message_id). "<br>\n"); 
// print("<br>Content-Type : " .$strmsg->type. "/" .$strmsg->subtype. "<br>\n"); 
// print("Subject : " . $header->subject . "<p>\n"); 
// //message 
// print("<p>Isi Pesan :"); 
// $msgarray = explode("\r\n", $message); 
// for($i=0;$i<count($msgarray);$i++) {
// 	print("<br>$msgarray[$i]"); 
// }
?>

<html>
<head>
<title>Reading a Mailbox including multipart emails from within PHP</title>
</head>
<body>
<h1>Mailbox Summary ....</h1>
<?= $html ?>
</body>
</html>
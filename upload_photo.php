<?php
$access_token = ''; // imgur api access token (need to be regen'd like once in a month)
$album_hash = ''; // hash of the album to upload to

$file = $_FILES['img'];
$filename = $file['tmp_name'];
$url = 'https://api.imgur.com/3/image.json';
$headers = array("Authorization: Bearer $access_token");

$handle = fopen($filename, "r");
$data = fread($handle, filesize($filename));
$pvars   = array('image' => base64_encode($data), 'album' => $album_hash);

$curl = curl_init();
curl_setopt_array($curl, array(
   CURLOPT_URL=> $url,
   CURLOPT_TIMEOUT => 30,
   CURLOPT_POST => 1,
   CURLOPT_HTTPHEADER => $headers,
   CURLOPT_POSTFIELDS => $pvars
));
if(curl_exec($curl))
   header("Location: index.php");
else
   echo "Oxe deu ruim avisa o gibim";
curl_close ($curl); 
?>

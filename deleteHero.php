<?php 
if (isset($_GET["id"])) {

  $id = $_GET["id"];

//Create connection since we changed the port num had to add it here
function curl_delete_contents($url)
{
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'accept: text/plain'
]);
  $data = curl_exec($ch);
  $error = curl_error($ch);
  if(!$data) {
    echo $error;
  }
  curl_close($ch);
  return $data;
}

$url = "https://localhost:7046/api/SuperHero/$id";

$result = curl_delete_contents($url);

if ($result) {
  echo "all good in the hood";
} else {
  echo "Whoops";
}

header("location: /SuperHeroUI.PHP/index.php");
exit;
}
?>
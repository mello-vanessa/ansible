<?php

$privatekey = "d96c44ef558eb88d7a3fc84c4968999a46b689fb";
$apikey = "452b121df7d2b2c27ac73d02fdabcd3e";
$now = microtime();

$query = http_build_query([
     'apikey' => $apikey,
     'ts' => $now,
     'hash' => md5($now . $privatekey . $apikey)
]);

$url = "https://gateway.marvel.com:443/v1/public/characters?name=Spider-Man&". $query;
$arraySpiderMan = json_decode((file_get_contents($url)), true);

if ($arraySpiderMan["data"]["results"][0]["name"] == "Spider-Man")
{
        $idSpiderMan =  $arraySpiderMan["data"]["results"][0]["id"];
}

$url = "https://gateway.marvel.com:443/v1/public/stories?characters=".$idSpiderMan."&". $query;
$result = json_decode(file_get_contents($url),true);

$arrayStories = $result["data"]["results"];
$id = rand(0, (sizeof($arrayStories)-1));

echo "<h1>Spider Man random story</h1>";
echo "AttributionText: ".$result["attributionText"];
echo "<br>";

$description = $arrayStories[$id]["description"]."<br />";

echo "Story description: ";
if (strlen($description) == 6) {
        echo "There´s no description to this story.<br>";
}
else {
        echo $description."<br>";
}

$arrayCharacters[] = $arrayStories[$id]["characters"]["items"];

echo "<h3>Character´s list:</h3>";

foreach ($arrayCharacters as $characters) {
        foreach ($characters as $char) {
                echo $char["name"]."<br>";
                $url = $char["resourceURI"]."?".$query;
                $result = json_decode(file_get_contents($url),true);
                $imgSrc = $result["data"]["results"][0]["thumbnail"]["path"]."/portrait_xlarge.jpg";
                echo "<img src='$imgSrc' height='250' width='250'>";
                echo "<br><br>";
        }
}
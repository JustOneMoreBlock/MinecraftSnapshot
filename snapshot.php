<?php

function api($api)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $req = json_decode(curl_exec($ch));
    curl_close($ch);
    Return $req;
}

$json = api("https://launchermeta.mojang.com/mc/game/version_manifest.json");

$version = $json->{'latest'}->{'snapshot'};
$release = $json->{'latest'}->{'release'};

foreach ($json->{'versions'} as $getVersion) {
	if($getVersion->{'id'} == $version) {
		$getVersionURL = $getVersion->{'url'};
	}
}

$json = api($getVersionURL);
$download = $json->{'downloads'}->{'server'}->{'url'};

echo $download;

?>

<?php

require_once 'vendor/autoload.php';

$httpClient = new \GuzzleHttp\Client();

$audioOutputDir = __DIR__ . '/audio/';
if(!file_exists($audioOutputDir)) {
    mkdir($audioOutputDir, 0777);
}

$ttsClient = new \GoogleFree\TextToSpeech\Client($httpClient);
$ttsClient->setAudioOutputDir($audioOutputDir);
$ttsClient->setLanguageTag('en-US');

try {
    $speechFile = new \GoogleFree\TextToSpeech\SpeechMp3File('The freedom of speech');

    $ttsClient->downloadAudio($speechFile);
}
catch(\Exception $ex) {
    var_dump($ex->getMessage());
}
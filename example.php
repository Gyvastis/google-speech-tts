<?php

require_once 'vendor/autoload.php';

$httpClient = new \GuzzleHttp\Client();

$audioOutputDir = __DIR__ . '/audio/';
if(!file_exists($audioOutputDir)) {
    mkdir($audioOutputDir, 0777);
}

$ttsClient = new \GoogleFree\TextToSpeech\Client($httpClient);
$ttsClient->setAudioOutputDir($audioOutputDir);

try {
    $speechFile = new \GoogleFree\TextToSpeech\SpeechFile('The freedom of speech', 'en-US');

    $didSucceed = $ttsClient->downloadAudio($speechFile);

    var_dump($didSucceed ? 'Success!' : 'Argh! Something went wrong');
}
catch(\Exception $ex) {
    var_dump($ex->getMessage());
}
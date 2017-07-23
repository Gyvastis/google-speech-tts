# Google Text-to-Speech Wrapper

## Run it in your code

`composer require google-free/google-speech-tts`

```php
$audioOutputDir = __DIR__ . '/audio';

$ttsClient = new \GoogleFree\TextToSpeech\Client($httpClient);

$ttsClient->setAudioOutputDir($audioOutputDir);

$speechFile = new \GoogleFree\TextToSpeech\SpeechFile('The freedom of speech', 'en-US');

$didSucceed = $ttsClient->downloadAudio($speechFile);
// now you should see an audio file in the '/audio' directory
```

## Test it out with an example
1. `git clone git@github.com:Gyvastis/google-speech-tts.git`

2. `composer install`

3. `php example.php`

## Language tags

All available langauge tags can be found [here](https://cloud.google.com/speech/docs/languages).

## Credits

This is an updated approach of [AlboVieira](https://github.com/AlboVieira/google-speech-tts).

As this is a very simple but still a wrapper over an existing service, use it at your own risk.
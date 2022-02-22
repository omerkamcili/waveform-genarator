# Waveform Converter

This package solves a real-world problem related to converting an audio file into a useful waveform structure.

## Installation

````
composer install omerkamcili/waveform-genarator
````

## Usage example

Provide raw output txt file from an audio ffmpeg silence detection to channel.

In case for example you have a detected file like customer_channel.txt and it looks like;
##### customer_channel.txt
```
[silencedetect @ 0x7fbfbbc076a0] silence_start: 3.504
[silencedetect @ 0x7fbfbbc076a0] silence_end: 6.656 | silence_duration: 3.152
[silencedetect @ 0x7fbfbbc076a0] silence_start: 14
[silencedetect @ 0x7fbfbbc076a0] silence_end: 19.712 | silence_duration: 5.712
[silencedetect @ 0x7fbfbbc076a0] silence_start: 20.144
[silencedetect @ 0x7fbfbbc076a0] silence_end: 27.264 | silence_duration: 7.12
[silencedetect @ 0x7fbfbbc076a0] silence_start: 36.528
[silencedetect @ 0x7fbfbbc076a0] silence_end: 41.728 | silence_duration: 5.2
[silencedetect @ 0x7fbfbbc076a0] silence_start: 47.28
[silencedetect @ 0x7fbfbbc076a0] silence_end: 49.792 | silence_duration: 2.512
```

Create a channel and provide parameters (channel name, raw output from silence-detect, total meet time)
```
$totalSessionTime = 73.42;
$channel = new WaveformGenerator\Channels\FileChannel('customer_channel', 'customer_channel.txt', $totalSessionTime);
```

Create FFMpeg parser (you are able to implement the other silence detectors if there is)
```
$parser = new WaveformGenerator\Parsers\FFMpegParser();
```

Create Converter instance and manage what do you need
```
$converter = new Converter($parser, $totalSessionTime);
```

Getting beautifully talk collections with talk percentage and longest monologue
```
$converter->getTalkCollections();
```

Getting just longest monologue from channel
```
$converter->getLongestMonologueFromChannel('customer_channel');
```

Getting just talks percentage from channel
```
$converter->getChannelTalkPercentage('customer_channel');
```

## Maintainers

- Bilyan Asenov

<?php
require __DIR__ . '/vendor/autoload.php';

use Corbpie\Gumlet;

$gm = new Gumlet\GumletVideo();

//Creating (adding) a new video with extra audio channels
$parameters = [
    'profile_id' => '65138fa952ccfd817db2a665',
    'title' => 'The title for this great video',
    'description' => 'The description for this great video',
    'mp4_access' => false,
    'audio_only' => false,
    'additional_tracks' => [
        [
            'url' => 'https://gumlet.sgp1.digitaloceanspaces.com/video/sample_1.aac',
            'type' => 'audio',
            'language_code' => 'en',
            'name' => 'English'],
        [
            'url' => 'https://gumlet.sgp1.digitaloceanspaces.com/video/sample_1.aac',
            'type' => 'audio',
            'language_code' => 'pl',
            'name' => 'Polish'
        ]
    ]
];

$video = $gm->createVideoFromUrl(
    'https://domain.com/video.mp4',
    'MP4',
    $parameters
);

echo json_encode($video);
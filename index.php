<?php
require __DIR__ . '/vendor/autoload.php';

use Corbpie\Gumlet;

$gm = new Gumlet\GumletVideo();

//Setting video collection
$gm->video_collection = '64b8c2bf2c2bc76a3c83f096';

//Setting video ID
$gm->video_id = '64bbf923a0f8d93c55f09ba0';

echo json_encode($gm->listProfiles());
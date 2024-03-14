# Gumlet video hosting API wrapper

## This is currently in progress!


![Badge](https://img.shields.io/badge/V%201.0-blue)
![Badge](https://img.shields.io/badge/PHP%208.2-✔-brightgreen)


---

## Table of contents

- [Features](#features)
- [Installing & usage](#installing)
    - [Usage](#usage)
    - [Setting API key](#setting-api-key)
- [Profiles](#list-profiles)
  - [List profiles](#list-profiles)
  - [Set profile](#set-profile)
  - [Get profile](#get-profile)
- [Video](#video)
    - [List videos](#list-videos)
    - [Get video details](#get-video-details)
    - [Create from URL](#create-video-from-a-url)
    - [Update thumbnail from frame](#update-thumbnail-from-frame)

---

# Features

Create and update videos & profiles...

---
<span id="installing"></span>

# Installing and Usage

Install with composer:

```
composer require corbpie/gumlet-api
```
<span id="usage"></span>
Use like:

```php
require __DIR__ . '/vendor/autoload.php';

use Corbpie\Gumlet;

$gm = new Gumlet\GumletVideo();

```

#### Setting API key:

<span id="setting-api-key"></span>

Line 7 ```GumletBase.php```

```php
const API_KEY = 'XXXX-XXXX-XXXX';
```

---

# Video

---

## List Profiles


```php
 $gm->listProfiles();
```

---

## Set Profile

**Requires $gm->profile_id to be set**


```php
$gm->profile_id = 'TJQuvxBnOcxQwnPOWc';
```

---

## Get Profile

**Requires $gm->profile_id to be set**


```php
 $gm->getProfile();
```

---


## List videos

**Requires $gm->video_collection to be set**

```php
 $gm->listVideos();
```
---


## Get video details

```php
 $gm->video_id = '65f1819d759d13a91c0a4c09';

 echo json_encode($gm->getVideo());

```

---

## Create video from a URL

**Requires $url and $gm->video_collection**

```php
 $gm->createVideoFromUrl($url, $format, $parameters);
```

_Inputs:_

**Note setting $gm->profile_id will override everything except the $url and the collection id**

`string` `$url` The URL to download the video from to use.

`string` `$format` Format for the video encoding "HLS, MPEG-DASH and MP4" ONLY!

`array` `$parameters` Optional values for the video creation:

```
[
'tag'=> 'example, another',
'title'=> 'title to video',
'description'=> 'This video is all about XYZ',
'width'=> '75%',
'height'=> '75%',
'resolution'=> '720p',
'mp4_access'=> true,
'per_title_encoding'=> false,
'process_low_resolution_input'=> true,
'audio_only'=> false,
'enable_drm'=> true
]
```


#### Example for creating a video from URL with multiple audio tracks:

```php
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
```
---

## Update thumbnail from frame

```php
 $gm->video_id = '65f1819d759d13a91c0a4c09';
 
 $frame = 20;
 $gm->updateVideoThumbnailFromFrame($frame);
```
# Gumlet video hosting API wrapper

## This is currently in progress!

![Badge](https://img.shields.io/badge/PHP%208.2-✔-brightgreen)


---

## Table of contents

- [Features](#features)
- [Installing & usage](#installing)
    - [Usagae](#usage)
    - [Setting API key](#setting-api-key)
- [Video](#video)
    - [Create from URL](#create-video-from-a-url)

---

# Features

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

## Create video from a URL

**Requires $url and $gm->video_collection**

`$gm->createVideoFromUrl($url, $format, $parameters);`

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

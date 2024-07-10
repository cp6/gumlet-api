<?php

namespace Corbpie\Gumlet;

class GumletPlaylist extends GumletBase
{

    public function getPlaylists(): array
    {
        return $this->ApiCall('GET', "video/sources");
    }

    public function getPlaylist(): array
    {
        return $this->ApiCall('GET', "video/playlist/{$this->playlist_id}");
    }

    public function deletePlaylist(): array
    {
        return $this->ApiCall('DELETE', "video/playlist/{$this->playlist_id}");
    }

}
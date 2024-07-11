<?php

namespace Corbpie\Gumlet;

class GumletPlaylist extends GumletBase
{

    public function getPlaylists(): array
    {
        return $this->ApiCall('GET', "video/playlist");
    }

    public function getPlaylist(): array
    {
        return $this->ApiCall('GET', "video/playlist/{$this->playlist_id}");
    }

    public function getPlaylistAssets(string $sort_by = 'asset_title', int $sort_order = 1, int $page_number = 1, int $page_size = 10): array
    {
        return $this->ApiCall('GET', "video/playlist/{$this->playlist_id}/assets", ['sort_by' => $sort_by, 'sort_order' => $sort_order, 'page_number' => $page_number, 'page_size' => $page_size]);
    }

    public function deletePlaylist(): array
    {
        return $this->ApiCall('DELETE', "video/playlist/{$this->playlist_id}");
    }

    public function createPlaylist(string $title, string $description = ''): array
    {
        return $this->ApiCall('POST', "video/playlist", ['collection_id' => $this->collection_id, 'title' => $title, 'description' => $description]);
    }

    public function updatePlaylist(string $title, int $position, bool $visible = true, string $description = ''): array
    {
        return $this->ApiCall('POST', "video/playlist/{$this->playlist_id}", ['title' => $title, 'position' => $position, 'channel_visibility' => $visible, 'description' => $description]);
    }

    public function addAssetsToPlaylist(array $assets = []): array
    {
        return $this->ApiCall('POST', "video/playlist/{$this->playlist_id}/asset", ['asset_list' => $assets]);
    }

    public function removeAssetsToPlaylist(array $assets = []): array
    {
        return $this->ApiCall('DELETE', "video/playlist/{$this->playlist_id}/asset", ['delete_list' => $assets]);
    }

}
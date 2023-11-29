<?php

namespace Corbpie\Gumlet;

class GumletVideo extends GumletBase
{
    public string $video_id;

    public string $video_collection;

    public string $profile_id;


    public function getProfile(): array
    {
        return $this->ApiCall('GET', "video/profiles/{$this->profile_id}");
    }

    public function listProfiles(): array
    {
        return $this->ApiCall('GET', "video/profiles");
    }

    public function listVideos(): array
    {
        return $this->ApiCall('GET', "video/assets/list/{$this->video_collection}");
    }

    public function getVideo(): array
    {
        return $this->ApiCall('GET', "video/assets/{$this->video_id}");
    }

    public function deleteVideo(): array
    {
        return $this->ApiCall('DELETE', "video/assets/{$this->video_id}");
    }

    public function updateVideoThumbnailFromFrame(int $frame_second = 2): array
    {
        return $this->ApiCall('POST', "video/assets/{$this->video_id}/thumbnail", ['frame_at_second' => $frame_second]);
    }

    public function updateVideoTitle(string $title): array
    {
        return $this->ApiCall('POST', "video/assets/update", ['asset_id' => $this->video_id, 'title' => $title]);
    }

    public function updateVideoDescription(string $description): array
    {
        return $this->ApiCall('POST', "video/assets/update", ['asset_id' => $this->video_id, 'description' => $description]);
    }

    public function updateVideoTag(string $tag): array
    {
        return $this->ApiCall('POST', "video/assets/update", ['asset_id' => $this->video_id, 'tag' => $tag]);
    }

    public function getMostViewed(string $start_at, string $end_at, string $collection_id = '', int $page = 1, int $per_page = 100): array
    {
        ($collection_id !== "") ? $collection = "&collection_id={$collection_id}" : $collection = "";
        return $this->ApiCall('GET', "video/streaming-duration?start_at={$start_at}&end_at={$end_at}{$collection}&page={$page}&page_size={$per_page}");
    }

    public function createVideoFromUrl(string $url, string $format = 'HLS', array $parameters = []): array
    {
        $parameters['collection_id'] = $this->video_collection;
        $parameters['profile_id'] = $this->profile_id;//Providing this ignores format
        $parameters['input'] = $url;
        $parameters['format'] = $format;
        return $this->ApiCall('POST', "video/assets", $parameters);
    }

}
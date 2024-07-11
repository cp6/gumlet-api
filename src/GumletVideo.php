<?php

namespace Corbpie\Gumlet;

class GumletVideo extends GumletBase
{
    public function getProfile(): array
    {
        return $this->ApiCall('GET', "video/profiles/{$this->profile_id}");
    }

    public function listProfiles(): array
    {
        return $this->ApiCall('GET', "video/profiles");
    }

    public function deleteProfile(): array
    {
        return $this->ApiCall('DELETE', "video/profiles/{$this->profile_id}");
    }

    public function listVideos(): array
    {
        return $this->ApiCall('GET', "video/assets/list/{$this->collection_id}");
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

    public function uploadVideo(string $upload_url, string $video_filename): int
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $upload_url);
        curl_setopt($curl, CURLOPT_PUT, 1);
        curl_setopt($curl, CURLOPT_INFILE, fopen($video_filename, 'rb'));
        curl_setopt($curl, CURLOPT_INFILESIZE, filesize($video_filename));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $call = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        return $http_code;
    }

    public function getMostViewed(string $start_at, string $end_at, string $collection_id = '', int $page = 1, int $per_page = 100): array
    {
        ($collection_id !== "") ? $collection = "&collection_id={$collection_id}" : $collection = "";
        return $this->ApiCall('GET', "video/streaming-duration?start_at={$start_at}&end_at={$end_at}{$collection}&page={$page}&page_size={$per_page}");
    }

    public function createVideoFromUrl(string $url, string $format = 'HLS', array $parameters = []): array
    {
        $parameters['collection_id'] = $this->collection_id;
        $parameters['profile_id'] = $this->profile_id ?? null;//Providing this ignores format
        $parameters['input'] = $url;
        $parameters['format'] = $format;
        return $this->ApiCall('POST', "video/assets", $parameters);
    }

    public function createProfile(string $name, string $format = 'HLS', array $parameters = []): array
    {
        $parameters['name'] = $name;
        $parameters['format'] = $format;
        return $this->ApiCall('POST', "video/profiles", $parameters);
    }

    public function getAnalytics(string $metrics = 'top_assets', string $start_date = '', string $end_date = ''): array
    {
        $parameters['metrics'] = [$metrics];
        $parameters['date_range'] = ['start_at' => $start_date, 'end_at' => $end_date];
        $parameters['filters'] = ['collection_id' => $this->collection_id] ?? null;
        return $this->ApiCall('POST', "video/analytics", $parameters);
    }

}
<?php

namespace Corbpie\Gumlet;

class GumletProfile extends GumletBase
{

    public function getProfiles(): array
    {
        return $this->ApiCall('GET', "video/profiles");
    }

    public function getProfile(): array
    {
        return $this->ApiCall('GET', "video/profiles/{$this->profile_id}");
    }

    public function deleteProfile(): array
    {
        return $this->ApiCall('DELETE', "video/profiles/{$this->profile_id}");
    }

    public function createProfile(string $name, string $format = 'ABR', array $parameters = []): array
    {
        $parameters['name'] = $name;
        $parameters['format'] = $format;
        return $this->ApiCall('POST', "video/profiles", $parameters);
    }

    public function updateProfile(array $parameters = []): array
    {
        $parameters['profile_id'] = $this->profile_id;
        return $this->ApiCall('POST', "video/profiles/{$this->profile_id}", $parameters);
    }

}
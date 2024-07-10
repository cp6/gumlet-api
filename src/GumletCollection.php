<?php

namespace Corbpie\Gumlet;

class GumletCollection extends GumletBase
{

    public function getCollections(): array
    {
        return $this->ApiCall('GET', "video/sources");
    }

    public function getCollection(): array
    {
        return $this->ApiCall('GET', "video/sources/{$this->collection_id}");
    }

    public function deleteCollection(): array
    {
        return $this->ApiCall('DELETE', "video/sources/{$this->collection_id}");
    }

    public function createCollection(string $name, string $type, array $parameters = []): array
    {
        $parameters['name'] = $name;
        $parameters['type'] = $type;
        $parameters = array_merge($parameters, $parameters);
        return $this->ApiCall('POST', "video/sources", $parameters);
    }

    public function updateCollection(array $parameters): array
    {
        return $this->ApiCall('POST', "video/sources/{$this->collection_id}", $parameters);
    }

}
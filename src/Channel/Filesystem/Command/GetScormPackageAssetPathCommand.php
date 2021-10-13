<?php

namespace Fluxlabs\FluxScormPlayerApi\Channel\Filesystem\Command;

use Fluxlabs\FluxScormPlayerApi\Adapter\Config\FilesystemConfigDto;

class GetScormPackageAssetPathCommand
{

    private FilesystemConfigDto $filesystem_config;


    public static function new(FilesystemConfigDto $filesystem_config) : static
    {
        $command = new static();

        $command->filesystem_config = $filesystem_config;

        return $command;
    }


    public function getScormPackageAssetPath(string $id, string $path) : ?string
    {
        $path = $this->filesystem_config->getFolder() . "/" . $id . "/" . $path;

        if (!file_exists($path)) {
            return null;
        }

        return $path;
    }
}
<?php

namespace FluxScormPlayerApi\Service\Filesystem\Command;

use Exception;
use FluxScormPlayerApi\Adapter\MetadataStorage\MetadataDto;
use FluxScormPlayerApi\Adapter\MetadataStorage\MetadataStorage;
use FluxScormPlayerApi\Adapter\MetadataStorage\MetadataType;
use FluxScormPlayerApi\Libs\FluxFileStorageApi\Adapter\Api\FileStorageApi;
use FluxScormPlayerApi\Service\Filesystem\FilesystemUtils;

class UploadScormPackageCommand
{

    use FilesystemUtils;

    private function __construct(
        private readonly FileStorageApi $file_storage_api,
        private readonly MetadataStorage $metadata_storage
    ) {

    }


    public static function new(
        FileStorageApi $file_storage_api,
        MetadataStorage $metadata_storage
    ) : static {
        return new static(
            $file_storage_api,
            $metadata_storage
        );
    }


    public function uploadScormPackage(string $id, string $title, string $file) : void
    {
        $id = $this->normalizeId(
            $id
        );

        $this->file_storage_api->upload(
            $file,
            $id . ".zip",
            $id,
            true,
            false,
            true,
            true
        );

        $manifest = json_decode(json_encode(simplexml_load_file($this->file_storage_api->getFullPath(
            $id . "/imsmanifest.xml"
        ))), true);

        switch ($manifest["metadata"]["schemaversion"]) {
            case "1.2":
                $type = MetadataType::_1_2;
                break;

            case "CAM 1.3":
            case "2004 3rd Edition":
            case "2004 4rd Edition":
                $type = MetadataType::_2004;
                break;

            default:
                throw new Exception("Unknown scorm type " . $manifest["metadata"]["schemaversion"]);
        }

        $this->metadata_storage->storeMetadata(
            $id,
            MetadataDto::new(
                $title,
                $manifest["resources"]["resource"]["@attributes"]["href"],
                $type
            )
        );
    }
}

<?php

namespace FluxScormPlayerApi\Adapter\DataStorage;

interface DataStorage
{

    public function deleteData(string $scorm_id) : void;


    public function getData(string $scorm_id, string $user_id) : ?object;


    public function storeData(string $scorm_id, string $user_id, object $data) : void;
}

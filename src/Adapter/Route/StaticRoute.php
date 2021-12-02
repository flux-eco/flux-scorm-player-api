<?php

namespace FluxScormPlayerApi\Adapter\Route;

use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Method\DefaultMethod;
use FluxRestBaseApi\Method\Method;
use FluxRestBaseApi\Status\DefaultStatus;
use FluxScormPlayerApi\Adapter\Api\Api;

class StaticRoute implements Route
{

    private readonly Api $api;


    public static function new(Api $api) : static
    {
        $route = new static();

        $route->api = $api;

        return $route;
    }


    public function getDocuRequestBodyTypes() : ?array
    {
        return null;
    }


    public function getDocuRequestQueryParams() : ?array
    {
        return null;
    }


    public function getMethod() : Method
    {
        return DefaultMethod::GET;
    }


    public function getRoute() : string
    {
        return "/static/{path.}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $path = $this->api->getStaticPath(
            $request->getParam(
                "path"
            )
        );

        if ($path !== null) {
            return ResponseDto::new(
                null,
                null,
                null,
                null,
                $path
            );
        } else {
            return ResponseDto::new(
                null,
                DefaultStatus::_404
            );
        }
    }
}

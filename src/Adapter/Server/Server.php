<?php

namespace FluxScormPlayerApi\Adapter\Server;

use FluxRestApi\Adapter\Collector\FolderRouteCollector;
use FluxRestApi\Adapter\Handler\SwooleHandler;
use FluxScormPlayerApi\Adapter\Api\Api;
use FluxScormPlayerApi\Adapter\Config\Config;
use FluxScormPlayerApi\Adapter\Config\EnvConfig;
use Swoole\Http\Server as SwooleServer;

class Server
{

    private readonly Config $config;
    private readonly SwooleHandler $handler;


    public static function new(?Config $config = null) : static
    {
        $server = new static();

        $server->config = $config ?? EnvConfig::new();
        $server->handler = SwooleHandler::new(
            FolderRouteCollector::new(
                __DIR__ . "/../Route",
                [
                    Api::new(
                        $server->config
                    )
                ]
            )
        );

        return $server;
    }


    public function init() : void
    {
        $options = [
            "package_max_length" => $this->config->getServerConfig()->max_upload_size
        ];
        $sock_type = SWOOLE_TCP;

        if ($this->config->getServerConfig()->https_cert !== null) {
            $options += [
                "ssl_cert_file" => $this->config->getServerConfig()->https_cert,
                "ssl_key_file"  => $this->config->getServerConfig()->https_key
            ];
            $sock_type += SWOOLE_SSL;
        }

        $server = new SwooleServer($this->config->getServerConfig()->listen, $this->config->getServerConfig()->port, SWOOLE_PROCESS, $sock_type);

        $server->set($options);

        $server->on("request", [$this->handler, "handle"]);

        $server->start();
    }
}

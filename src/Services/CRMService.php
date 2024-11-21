<?php

namespace OP\Services;

use GuzzleHttp\Client;
use Microsoft\Graph\Graph;
use SilverStripe\Control\Controller;
use SilverStripe\Core\Environment;

class CRMService
{
    protected $resource;
    protected $graph;

    public function __construct()
    {
        $this->resource = Environment::getEnv('CRM_RESOURCE');
        $guzzle = new Client();
        $result = $guzzle->post(
            Controller::curr()->join_links([
                "https://login.microsoftonline.com/",
                Environment::getEnv("CRM_TENANT"),
                "oauth2/token"
            ]),
            [
                'form_params' => [
                    'client_id' => Environment::getEnv("CRM_CLIENT_ID"),
                    'client_secret' => Environment::getEnv("CRM_CLIENT_SECRET"),
                    "resource" => $this->resource,
                    'scope' => 'https://graph.microsoft.com/.default',
                    'grant_type' => 'client_credentials',
                ],
            ]
        )->getBody()->getContents();
        $access_token = json_decode($result)->access_token;
        $this->graph = new Graph();
        $this->graph->setAccessToken($access_token);
    }

    public function request($query, $type = "GET", $body = [])
    {
        return $this->graph
            ->createRequest(
                $type,
                Controller::curr()->join_links([
                    $this->resource,
                    $query
                ]),
            )
            ->attachBody($body)
            ->execute();
    }
}

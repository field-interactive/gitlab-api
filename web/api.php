<?php

use GuzzleHttp\Client;

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/config.php';

$client = new Client(['base_uri' => 'https://gitlab.com/']);

/**
 * Update all issues of a project with the confidential flag
 *
 * https://docs.gitlab.com/ce/api/README.html#pagination
 */
$nextPage = 1;
do {
    /** https://docs.gitlab.com/ee/api/issues.html#list-project-issues */
    $response = $client->get(
        "/api/v4/projects/{$config['project']}/issues", [
            'form_params' => [
                'private_token' => $config['access_token'],
                'page' => $nextPage
            ]]
    );

    $issues = json_decode($response->getBody()->getContents(), true);

    $nextPage = $response->getHeader('X-Next-Page')[0];

    foreach ($issues as $issue) {
        /** https://docs.gitlab.com/ee/api/issues.html#edit-issue */
        $response = $client->put(
            "/api/v4/projects/{$config['project']}/issues/{$issue['iid']}", [
                'form_params' => [
                    'private_token' => $config['access_token'],
                    'confidential' => true,
                ]]
        );
    }
} while ($nextPage);

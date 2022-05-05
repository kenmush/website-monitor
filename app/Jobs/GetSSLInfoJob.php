<?php

namespace App\Jobs;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetSSLInfoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Project $project)
    {
    }

    public function handle()
    {
        $url = $this->project->url;
        $orignal_parse = parse_url($url, PHP_URL_HOST);
        $get = stream_context_create(["ssl" => ["capture_peer_cert" => true]]);
        $read = stream_socket_client("ssl://".$orignal_parse.":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
        $cert = stream_context_get_params($read);

        $certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);

        $SSLInfo = collect($certinfo);

        $this->project->monitoring([
                'ssl'    => $SSLInfo,
                'status' => 'success',
            ''
        ]);

    }
}
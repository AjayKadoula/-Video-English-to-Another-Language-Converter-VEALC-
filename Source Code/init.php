<?php

function get($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function secToDuration($seconds)
{
    $minutes  = intval($seconds/60);
    $seconds = ($seconds - ($minutes * 60));
    return "$minutes minutes $seconds seconds";
}

function parseStream($stream)
{
    $available_formats = [];
    foreach ($stream as $format) {
        parse_str($format, $format_info);
        if (isset($format_info['bitrate'])) $quality = isset($format_info['quality_label'])?$format_info['quality_label']:round($format_info['bitrate']/1000). 'k';
        else $quality = isset($format_info['quality'])?$format_info['quality']:'';

        switch ($quality) {
            case 'hd720':
                $quality = "720p";
                break;
            case 'medium':
                $quality = "360p";
                break;
            case 'small':
                $quality = "240p"; // May Less
                break;
        }
        $type = explode(";", $format_info['type']);
        $type= $type[0];
        switch ($type) {
            case 'video/3gpp':
                $type = "3GP";
                break;
            case 'video/mp4':
                $type = "MP4";
                break;
             case 'video/webm':
                $type = "WebM";
                break;
        }
        $available_formats[] = [
            'itag' =>  $format_info['itag'],
            'quality' => $quality,
            'type' => $type,
            'url' => $format_info['url'],
            'size' => getSize($format_info['url']),

        ];
    }
   
    return $available_formats;
}

function getSize($url)
{

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $r = curl_exec($ch);

    foreach (explode("\n", $r) as $header) {
        if (strpos($header, 'Content-Length:') === 0) {
            return intval(intval(trim(substr($header, 16)))/ (1024*1024)) . " MB";
        }
    }
}
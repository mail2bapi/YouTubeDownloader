<?php
/**
 * Author: Bapi Roy <mail2bapi@astrosoft.co.in>
 * Date: 06/10/20
 * Time: 11:28 PM
 **/

include_once '../vendor/autoload.php';
use Mail2bapi\YouTubeDownloader\YoutubeDownloader;

$yt = new YoutubeDownloader();
$videos = $yt->getVideoDetail('https://www.youtube.com/watch?v=Pg4XhiV_72Y');
$yt->downloadThumbnails($videos)
    ->downloadThumbnails();

echo  'Done'.PHP_EOL;
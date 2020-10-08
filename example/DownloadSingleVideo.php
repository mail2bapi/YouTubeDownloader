<?php
/**
 * Author: Bapi Roy <mail2bapi@astrosoft.co.in>
 * Date: 07/10/20
 * Time: 5:55 PM
 **/

include_once '../vendor/autoload.php';
use Mail2bapi\YouTubeDownloader\YoutubeDownloader;

$yt = new YoutubeDownloader();
$videos = $yt->getVideoDetail('https://www.youtube.com/watch?v=Pg4XhiV_72Y');
$videoQualities = $yt->getVideoQualities();
$yt->downloadThumbnails($videos)
    ->setLogging(true)
    ->downloadAVideo($videos['formats']['360p']['link'], $videos['video_id'], $videoQualities[0]);

echo  'Done'.PHP_EOL;
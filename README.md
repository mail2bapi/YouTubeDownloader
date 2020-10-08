# YouTubeDownloader
A PHP library for downloading videos from YouTube without API key.

## Requirements
- PHP 7.2 or higher

## Installation
Run in console below command to download package to your project:

```
composer mail2bapi/youtube-downloader
```

## Usage
```PHP
use Mail2bapi\YouTubeDownloader\YoutubeDownloader;

// Yourtube URL
$yourtubeVideoUrl = '<youtube.com video URL>';

// New YoutubeDownloader instance
$yt = new YoutubeDownloader();

// Enabling logging
$yt->setLogging(true);

// Setting location for saving videos and thumbnails. By default is saves in directory 'videos/'
$yt->setDownloadFolder('<my/location>');

// Collect Video ID from URL
$videoId = $yt->getVideoId($yourtubeVideoUrl);

// Get Video details of a Yourtube video
$videos = $yt->getVideoDetail($yourtubeVideoUrl);

// $videos array have following keys 
// 'video_id', 'channel_id', 'duration', 'title', 'description', 'keywords', 'average_rating', 'allow_ratings', 'view_count', 'author', 'video', 'embed_video', 'adaptive_formats', 'formats', 'thumbnails'

// Get array of all video qualities
$videoQualities = $yt->getVideoQualities();

// Download all Thumbnail images
$yt->downloadThumbnails($videos);

// Download all videos as per video qualities available for the video
$yt->downloadVideo();

// Download single videos as per video qualities available for the video
$yt->downloadAVideo($videos['formats']['360p']['link'], $videos['video_id'], $videoQualities[0]);

```

Enjoyed using the library. Please help to improve it by report issues and suggesting improvements. Thank you!
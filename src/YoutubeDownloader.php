<?php
/**
 * Author: Bapi Roy <mail2bapi@astrosoft.co.in>
 * Date: 06/10/20
 * Time: 7:07 PM
 **/

namespace Mail2bapi\YouTubeDownloader;

class YoutubeDownloader
{
    const YOUTUBE_INFO_API_URL = "https://youtube.com/get_video_info?video_id=";

    /**
     * Youtube video detail information
     * @var
     */
    protected $videos;

    /**
     * List of video qualities
     * @var array
     */
    protected $videoQualities;

    /**
     * Youtube video ID
     * @var string
     */
    private $videoId;

    /**
     * Check for logging
     * @var false
     */
    private $logging;

    /**
     * Location where to save the file
     * @var string
     */
    private $downloadFolder;

    /**
     * YoutubeDownloader constructor.
     */
    public function __construct()
    {
        $this->videoId = '';
        $this->logging = false;
        $this->videoQualities = [];
        $this->downloadFolder = 'videos/';
    }

    /**
     * Get Youtube video ID
     * @param string $url
     * @return $this
     */
    public function getVideoId(string $url): string
    {
        if(empty($url)){
            throw new \RuntimeException('Youtube video URL is missing');
        }

        parse_str( parse_url( $url, PHP_URL_QUERY ), $vars);
        $this->videoId = isset($vars['v'])? $vars['v'] : '';

        return $this->videoId;
    }

    /**
     * Collect Youtube video details
     * @param string $videoUrl
     * @return array
     */
    public function getVideoDetail(string $videoUrl=''): array
    {
        if(empty($videoUrl)){
            throw new \RuntimeException('Youtube video URL is missing');
        }

        $this->getVideoId($videoUrl);
        if(empty($this->videoId)){
            throw new \RuntimeException('Youtube video ID is missing');
        }
        $this->videos = [];

        $videoData = file_get_contents(self::YOUTUBE_INFO_API_URL.$this->videoId);
        if($videoData === false){
            throw new \RuntimeException('Could not get Youtube video detail');
        }

        parse_str($videoData,$videoInfo);
        $playabilityJson = json_decode($videoInfo['player_response']);
        $videoDetail = $playabilityJson->videoDetails;

        //Checking playable or not
        $isPlayable = $playabilityJson->playabilityStatus->status;
        if(($this->logging) && (strtolower($isPlayable) != 'ok')) {
            $log = date("c")." ".$videoInfo['player_response']."\n";
            file_put_contents('./video.log', $log, FILE_APPEND);
        }

        if(!empty($videoInfo) && $videoInfo['status'] == 'ok' && strtolower($isPlayable) == 'ok') {
            $videoOptions = [];
            $videoOptionsOrg = [];
            $videoThumbnails = [];

            // Adaptive Formats
            foreach($playabilityJson->streamingData->adaptiveFormats as $stream) {
                $videoOptions[] = [
                    'link' => $stream->url,
                    'type' => explode(";", $stream->mimeType)[0],
                    'quality' => (!empty($stream->qualityLabel))? $stream->qualityLabel : '',
                ];
            }

            // Video Formats
            foreach($playabilityJson->streamingData->formats as $stream) {
                if(!empty($stream->qualityLabel)){
                    $this->videoQualities[] = $stream->qualityLabel;
                    $videoOptionsOrg[$stream->qualityLabel] = [
                        'link' => $stream->url,
                        'type' => explode(";", $stream->mimeType)[0],
                    ];
                }
            }

            // Thumbnail
            foreach ($videoDetail->thumbnail->thumbnails as $thumbnail){
                $videoThumbnails[] = [
                    'url' => $thumbnail->url,
                    'width' => $thumbnail->width,
                    'height' => $thumbnail->height
                ];
            }

            $this->videos = [
                'video_id' => $this->videoId,
                'channel_id' => $videoDetail->channelId,
                'duration' => gmdate("H:i:s", $videoDetail->lengthSeconds),
                'title' => $videoDetail->title,
                'description' => $videoDetail->shortDescription,
                'keywords' => implode(', ', $videoDetail->keywords),
                'average_rating' => $videoDetail->averageRating,
                'allow_ratings' => $videoDetail->allowRatings,
                'view_count' => $videoDetail->viewCount,
                'author' => $videoDetail->author,
                'video' => "http://www.youtube.com/watch?v=" . $this->videoId,
                'embed_video' => "http://www.youtube.com/embed/" . $this->videoId,
                'adaptive_formats'=> $videoOptions,
                'formats' => $videoOptionsOrg,
                'thumbnails' => $videoThumbnails,
            ];
        }

        return $this->videos;
    }

    /**
     * Download all videos as per quality present.
     * @return $this
     */
    public function downloadVideo(): self
    {
        // Download videos
        foreach ($this->videos['formats'] as $quality => $video){
            $this->downloadAVideo($video['link'], $this->videoId, $quality);
        }

        // Download thumbnail
        $this->downloadThumbnails($this->videos);

        return $this;
    }

    /**
     * Return list of video qualities present for the video
     * @return array
     */
    public function getVideoQualities(): array
    {
        return $this->videoQualities;
    }


    /**
     * Dowbloa a single video
     * @param string $url
     * @param string $videoId
     * @param string $quality
     */
    public function downloadAVideo(string $url, string $videoId, string $quality): void
    {
        $downloadFolder = $this->downloadFolder.$videoId.'/';
        if (!is_dir($downloadFolder)) {
            throw new \RuntimeException(sprintf('"%s" directory is not present', $downloadFolder));
        }

        // Downloading file
        $videoFile = file_get_contents($url);
        if($videoFile === false){
            throw new \RuntimeException('Could not get download Youtube video having URL- '.$url);
        }

        // Saving to local disk
        $fileName = 'ytvideo_'.$quality;
        $videoFileWithPath = $downloadFolder.$fileName.'.mp4';
        $videoFile = file_put_contents($videoFileWithPath, $videoFile);
        if($videoFile === false){
            throw new \RuntimeException('Could not save the Youtube video to local disk');
        }
    }

    /**
     * Download all video
     * @param array $video
     * @return $this
     */
    public function downloadThumbnails(array $video): self
    {
        $downloadFolder = $this->downloadFolder.$video['video_id'].'/';
        if (!mkdir($downloadFolder, 755, true) && !is_dir($downloadFolder)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $downloadFolder));
        }

        foreach ($video['thumbnails'] as $thumbnail){
            // Downloading file
            $thumbnailFile = @file_get_contents($thumbnail['url']);
            $fileName = 'ytimg_'.$thumbnail['width'].'-'.$thumbnail['height'].'px';
            $thumbnailFileWithPath = $downloadFolder.$fileName.'.jpg';
            @file_put_contents($thumbnailFileWithPath, $thumbnailFile);
        }

        return $this;
    }

    /**
     * Get the location of download folder
     * @return string
     */
    public function getDownloadFolder(): string
    {
        return $this->downloadFolder;
    }

    /**
     * @param string $downloadFolder
     */
    public function setDownloadFolder(string $downloadFolder): void
    {
        $this->downloadFolder = $downloadFolder.'/';
        if (!is_dir($this->downloadFolder)) {
            throw new \RuntimeException(sprintf('"%s" directory is not present', $this->downloadFolder));
        }
    }

    /**
     * Set to log or not
     * @param false $logging
     */
    public function setLogging(bool $logging): void
    {
        $this->logging = $logging;
    }
}
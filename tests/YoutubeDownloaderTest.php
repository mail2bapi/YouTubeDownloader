<?php
/**
 * Author: Bapi Roy <mail2bapi@astrosoft.co.in>
 * Date: 07/10/20
 * Time: 6:01 PM
 **/

namespace Mail2bapi\YouTubeDownloader;


use PHPUnit\Framework\TestCase;
use Mail2bapi\YouTubeDownloader\YoutubeDownloader;

class YoutubeDownloaderTest extends TestCase
{
    private $youtube;
    private $youtubeURL;
    private $videoDetail;
    

    protected function setUp(): void
    {
        $this->youtube = new YoutubeDownloader();
        $this->youtubeURL = 'https://www.youtube.com/watch?v=Pg4XhiV_72Y';

        $this->videoDetail = $this->youtube->getVideoDetail($this->youtubeURL);
    }

    protected function tearDown(): void
    {
        $this->youtube = NULL;
    }

    public function testGetVideoId()
    {
        $videoId = $this->youtube->getVideoId($this->youtubeURL);
        $this->assertEquals('Pg4XhiV_72Y', $videoId);
    }

    public function testGetVideoDetail()
    {
        $acceptedVideoDetail = [
            'video_id' => 'Pg4XhiV_72Y',
            'channel_id' => 'UCMcUlJgY09ZwG1o4ce53YbA',
            'duration' => '00:03:24',
            'title' => 'How To Play Super Nintendo Games On Any PC',
            /*'description' => "Hi, In this video I will show you How To Play Super Nintendo Games On Any PC
                            
                            To view the snes rom hacks I mention in this video go to http://snesguy.com/category/rom-hacks
                            
                            Subscribe YouTube : http://www.youtube.com/user/lcp03o?sub_confirmation=1
                            Twitter : https://twitter.com/ComputerGarageo
                            Google+ : https://plus.google.com/u/0/110841393164005763306
                            Website : http://www.computergarage.org
                            
                            Thanks for watching this video ON How To Play Super Nintendo Games On Any PC If you have any feedback please post it below and hit the like button if you found this video useful. If you have time please subscribe to my channel @ http://www.youtube.com/user/lcp03o?sub_confirmation=1",
            'keywords' => 'computergarage_org, HOW, to, play, super nintendo, super, nintendo, snes, games, roms, on your, computer, pc',
            'average_rating' => 5,
            'allow_ratings' => 1,
            'view_count' => 1425,
            'author' => 'Computer Garage_org',
            'video' => 'http://www.youtube.com/watch?v=Pg4XhiV_72Y',
            'embed_video' => 'http://www.youtube.com/embed/Pg4XhiV_72Y',
            'adaptive_formats' => [

        [
            'link' => 'https://r1---sn-fpnioxu-jj0l.googlevideo.com/videoplayback?expire=1602182297&ei=OQh_X9-0N5qq3LUP5KKi0Ag&ip=103.219.45.103&id=o-ALOe9q4STIrVdG-FTrSSHm3gcIpn7TA0kbk5oaoQpPpP&itag=136&aitags=133%2C134%2C135%2C136%2C160%2C242%2C243%2C244%2C247%2C278&source=youtube&requiressl=yes&mh=pI&mm=31%2C29&mn=sn-fpnioxu-jj0l%2Csn-bvvbax-jj0e&ms=au%2Crdu&mv=m&mvi=1&pcm2cms=yes&pl=22&nh=%2CIgppcjAxLmNjdTAxKg8yMjMuMjIzLjE1OC4yMDE&pcm2=yes&initcwndbps=672500&vprv=1&mime=video%2Fmp4&gir=yes&clen=7382338&dur=203.666&lmt=1563797040472703&mt=1602160596&fvip=3&keepalive=yes&fexp=23915654&c=WEB&txp=2206222&sparams=expire%2Cei%2Cip%2Cid%2Caitags%2Csource%2Crequiressl%2Cpcm2%2Cvprv%2Cmime%2Cgir%2Cclen%2Cdur%2Clmt&sig=AOq0QJ8wRAIgBNYPvxNnELRz2APsSocRT2ZT4vycIm6x3d3wk-P1kx4CIEyz0CBkSey0s5CLzPve6cQ261woGGhe4LJtLOzdLrii&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpcm2cms%2Cpl%2Cnh%2Cinitcwndbps&lsig=AG3C_xAwRAIgc5oRxGesUECBS-AWtMisevtLL-UyJ0uPs8Pt9nKQrr0CIFzIYKJlvcNs07DmB0JH1c3tP4VyIa4Ki5BRGhEl1Fh-',
            'type' => 'video/mp4',
            'quality' => '720p',
        ],

        [
            'link' => 'https://r1---sn-fpnioxu-jj0l.googlevideo.com/videoplayback?expire=1602182297&ei=OQh_X9-0N5qq3LUP5KKi0Ag&ip=103.219.45.103&id=o-ALOe9q4STIrVdG-FTrSSHm3gcIpn7TA0kbk5oaoQpPpP&itag=247&aitags=133%2C134%2C135%2C136%2C160%2C242%2C243%2C244%2C247%2C278&source=youtube&requiressl=yes&mh=pI&mm=31%2C29&mn=sn-fpnioxu-jj0l%2Csn-bvvbax-jj0e&ms=au%2Crdu&mv=m&mvi=1&pcm2cms=yes&pl=22&nh=%2CIgppcjAxLmNjdTAxKg8yMjMuMjIzLjE1OC4yMDE&pcm2=yes&initcwndbps=672500&vprv=1&mime=video%2Fwebm&gir=yes&clen=5422443&dur=203.666&lmt=1563797039995266&mt=1602160596&fvip=3&keepalive=yes&fexp=23915654&c=WEB&txp=2206222&sparams=expire%2Cei%2Cip%2Cid%2Caitags%2Csource%2Crequiressl%2Cpcm2%2Cvprv%2Cmime%2Cgir%2Cclen%2Cdur%2Clmt&sig=AOq0QJ8wRgIhANO8SLEuCvEHQZ2uKEd1aBTbjkNZEPfHT6SUge_2ujcuAiEAyU_nar0kxvnCMR6eCDcpC_7mwh6Y89__7pzg8DjwSik%3D&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpcm2cms%2Cpl%2Cnh%2Cinitcwndbps&lsig=AG3C_xAwRAIgc5oRxGesUECBS-AWtMisevtLL-UyJ0uPs8Pt9nKQrr0CIFzIYKJlvcNs07DmB0JH1c3tP4VyIa4Ki5BRGhEl1Fh-',
            'type' => 'video/webm',
            'quality' => '720p',
        ],

        [
            'link' => 'https://r1---sn-fpnioxu-jj0l.googlevideo.com/videoplayback?expire=1602182297&ei=OQh_X9-0N5qq3LUP5KKi0Ag&ip=103.219.45.103&id=o-ALOe9q4STIrVdG-FTrSSHm3gcIpn7TA0kbk5oaoQpPpP&itag=135&aitags=133%2C134%2C135%2C136%2C160%2C242%2C243%2C244%2C247%2C278&source=youtube&requiressl=yes&mh=pI&mm=31%2C29&mn=sn-fpnioxu-jj0l%2Csn-bvvbax-jj0e&ms=au%2Crdu&mv=m&mvi=1&pcm2cms=yes&pl=22&nh=%2CIgppcjAxLmNjdTAxKg8yMjMuMjIzLjE1OC4yMDE&pcm2=yes&initcwndbps=672500&vprv=1&mime=video%2Fmp4&gir=yes&clen=3783916&dur=203.666&lmt=1563797040472987&mt=1602160596&fvip=3&keepalive=yes&fexp=23915654&c=WEB&txp=2206222&sparams=expire%2Cei%2Cip%2Cid%2Caitags%2Csource%2Crequiressl%2Cpcm2%2Cvprv%2Cmime%2Cgir%2Cclen%2Cdur%2Clmt&sig=AOq0QJ8wRQIhAI5JzOFk-_Ut6-NEjfBc5WfmSC4V7zcBKi7GvBOFWqDBAiBg8hEA2JEgDKdaip5E_400ReAU9Nluztn_3fWo4pi9ew%3D%3D&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpcm2cms%2Cpl%2Cnh%2Cinitcwndbps&lsig=AG3C_xAwRAIgc5oRxGesUECBS-AWtMisevtLL-UyJ0uPs8Pt9nKQrr0CIFzIYKJlvcNs07DmB0JH1c3tP4VyIa4Ki5BRGhEl1Fh-',
        'type' => 'video/mp4',
        'quality' => '480p',
    ],

            [
                'link' => 'https://r1---sn-fpnioxu-jj0l.googlevideo.com/videoplayback?expire=1602182297&ei=OQh_X9-0N5qq3LUP5KKi0Ag&ip=103.219.45.103&id=o-ALOe9q4STIrVdG-FTrSSHm3gcIpn7TA0kbk5oaoQpPpP&itag=244&aitags=133%2C134%2C135%2C136%2C160%2C242%2C243%2C244%2C247%2C278&source=youtube&requiressl=yes&mh=pI&mm=31%2C29&mn=sn-fpnioxu-jj0l%2Csn-bvvbax-jj0e&ms=au%2Crdu&mv=m&mvi=1&pcm2cms=yes&pl=22&nh=%2CIgppcjAxLmNjdTAxKg8yMjMuMjIzLjE1OC4yMDE&pcm2=yes&initcwndbps=672500&vprv=1&mime=video%2Fwebm&gir=yes&clen=2720473&dur=203.666&lmt=1563797039985987&mt=1602160596&fvip=3&keepalive=yes&fexp=23915654&c=WEB&txp=2206222&sparams=expire%2Cei%2Cip%2Cid%2Caitags%2Csource%2Crequiressl%2Cpcm2%2Cvprv%2Cmime%2Cgir%2Cclen%2Cdur%2Clmt&sig=AOq0QJ8wRQIgTUT_6wJNEH3R2vjRz6cx9SpzlZEDUOIMmsAslZeC14cCIQDuFGHOkDHoWoDXMaIGgLGYgN0xHNx74hBvxjnlYH_Xkg%3D%3D&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpcm2cms%2Cpl%2Cnh%2Cinitcwndbps&lsig=AG3C_xAwRAIgc5oRxGesUECBS-AWtMisevtLL-UyJ0uPs8Pt9nKQrr0CIFzIYKJlvcNs07DmB0JH1c3tP4VyIa4Ki5BRGhEl1Fh-',
                'type' => 'video/webm',
                'quality' => '480p',
            ],

            [
                'link' => 'https://r1---sn-fpnioxu-jj0l.googlevideo.com/videoplayback?expire=1602182297&ei=OQh_X9-0N5qq3LUP5KKi0Ag&ip=103.219.45.103&id=o-ALOe9q4STIrVdG-FTrSSHm3gcIpn7TA0kbk5oaoQpPpP&itag=134&aitags=133%2C134%2C135%2C136%2C160%2C242%2C243%2C244%2C247%2C278&source=youtube&requiressl=yes&mh=pI&mm=31%2C29&mn=sn-fpnioxu-jj0l%2Csn-bvvbax-jj0e&ms=au%2Crdu&mv=m&mvi=1&pcm2cms=yes&pl=22&nh=%2CIgppcjAxLmNjdTAxKg8yMjMuMjIzLjE1OC4yMDE&pcm2=yes&initcwndbps=672500&vprv=1&mime=video%2Fmp4&gir=yes&clen=2190520&dur=203.666&lmt=1563797040471514&mt=1602160596&fvip=3&keepalive=yes&fexp=23915654&c=WEB&txp=2206222&sparams=expire%2Cei%2Cip%2Cid%2Caitags%2Csource%2Crequiressl%2Cpcm2%2Cvprv%2Cmime%2Cgir%2Cclen%2Cdur%2Clmt&sig=AOq0QJ8wRQIhAKd-4OBNLJn27fvuimfDJvKpqESZoK-C5a8aO13oeWqZAiAGxqElgQv8KrGov_i15ZjLUXoKqiRCMWX5vRQKT6PPxg%3D%3D&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpcm2cms%2Cpl%2Cnh%2Cinitcwndbps&lsig=AG3C_xAwRAIgc5oRxGesUECBS-AWtMisevtLL-UyJ0uPs8Pt9nKQrr0CIFzIYKJlvcNs07DmB0JH1c3tP4VyIa4Ki5BRGhEl1Fh-',
                'type' => 'video/mp4',
                'quality' => '360p',
            ],

            [
                'link' => 'https://r1---sn-fpnioxu-jj0l.googlevideo.com/videoplayback?expire=1602182297&ei=OQh_X9-0N5qq3LUP5KKi0Ag&ip=103.219.45.103&id=o-ALOe9q4STIrVdG-FTrSSHm3gcIpn7TA0kbk5oaoQpPpP&itag=243&aitags=133%2C134%2C135%2C136%2C160%2C242%2C243%2C244%2C247%2C278&source=youtube&requiressl=yes&mh=pI&mm=31%2C29&mn=sn-fpnioxu-jj0l%2Csn-bvvbax-jj0e&ms=au%2Crdu&mv=m&mvi=1&pcm2cms=yes&pl=22&nh=%2CIgppcjAxLmNjdTAxKg8yMjMuMjIzLjE1OC4yMDE&pcm2=yes&initcwndbps=672500&vprv=1&mime=video%2Fwebm&gir=yes&clen=1763696&dur=203.666&lmt=1563797039980022&mt=1602160596&fvip=3&keepalive=yes&fexp=23915654&c=WEB&txp=2206222&sparams=expire%2Cei%2Cip%2Cid%2Caitags%2Csource%2Crequiressl%2Cpcm2%2Cvprv%2Cmime%2Cgir%2Cclen%2Cdur%2Clmt&sig=AOq0QJ8wRAIgEMB4AZdm78n-4iJm73Ar1v34jcOVzyo9lLBYPlq6EK8CIDo9bPTo4dNUwv_VS8dPtHn9BMl0kklpLcNNUSj6twuY&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpcm2cms%2Cpl%2Cnh%2Cinitcwndbps&lsig=AG3C_xAwRAIgc5oRxGesUECBS-AWtMisevtLL-UyJ0uPs8Pt9nKQrr0CIFzIYKJlvcNs07DmB0JH1c3tP4VyIa4Ki5BRGhEl1Fh-',
                'type' => 'video/webm',
                'quality' => '360p',
            ],

            [
                'link' => 'https://r1---sn-fpnioxu-jj0l.googlevideo.com/videoplayback?expire=1602182297&ei=OQh_X9-0N5qq3LUP5KKi0Ag&ip=103.219.45.103&id=o-ALOe9q4STIrVdG-FTrSSHm3gcIpn7TA0kbk5oaoQpPpP&itag=133&aitags=133%2C134%2C135%2C136%2C160%2C242%2C243%2C244%2C247%2C278&source=youtube&requiressl=yes&mh=pI&mm=31%2C29&mn=sn-fpnioxu-jj0l%2Csn-bvvbax-jj0e&ms=au%2Crdu&mv=m&mvi=1&pcm2cms=yes&pl=22&nh=%2CIgppcjAxLmNjdTAxKg8yMjMuMjIzLjE1OC4yMDE&pcm2=yes&initcwndbps=672500&vprv=1&mime=video%2Fmp4&gir=yes&clen=1229238&dur=203.666&lmt=1563797040488999&mt=1602160596&fvip=3&keepalive=yes&fexp=23915654&c=WEB&txp=2206222&sparams=expire%2Cei%2Cip%2Cid%2Caitags%2Csource%2Crequiressl%2Cpcm2%2Cvprv%2Cmime%2Cgir%2Cclen%2Cdur%2Clmt&sig=AOq0QJ8wRQIgSOpymsXNGCL5A3EclWoeJgTKRmWj6tyuqUsWfTp0SgkCIQCozeoY73-QtH0vrTPzCa-zcbY88fF6WjoKSw5w00HDPQ%3D%3D&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpcm2cms%2Cpl%2Cnh%2Cinitcwndbps&lsig=AG3C_xAwRAIgc5oRxGesUECBS-AWtMisevtLL-UyJ0uPs8Pt9nKQrr0CIFzIYKJlvcNs07DmB0JH1c3tP4VyIa4Ki5BRGhEl1Fh-',
                'type' => 'video/mp4',
                'quality' => '240p',
            ],
            [

                'link' => 'https://r1---sn-fpnioxu-jj0l.googlevideo.com/videoplayback?expire=1602182297&ei=OQh_X9-0N5qq3LUP5KKi0Ag&ip=103.219.45.103&id=o-ALOe9q4STIrVdG-FTrSSHm3gcIpn7TA0kbk5oaoQpPpP&itag=242&aitags=133%2C134%2C135%2C136%2C160%2C242%2C243%2C244%2C247%2C278&source=youtube&requiressl=yes&mh=pI&mm=31%2C29&mn=sn-fpnioxu-jj0l%2Csn-bvvbax-jj0e&ms=au%2Crdu&mv=m&mvi=1&pcm2cms=yes&pl=22&nh=%2CIgppcjAxLmNjdTAxKg8yMjMuMjIzLjE1OC4yMDE&pcm2=yes&initcwndbps=672500&vprv=1&mime=video%2Fwebm&gir=yes&clen=1002522&dur=203.666&lmt=1563797039984828&mt=1602160596&fvip=3&keepalive=yes&fexp=23915654&c=WEB&txp=2206222&sparams=expire%2Cei%2Cip%2Cid%2Caitags%2Csource%2Crequiressl%2Cpcm2%2Cvprv%2Cmime%2Cgir%2Cclen%2Cdur%2Clmt&sig=AOq0QJ8wRQIhAN0Q7wiT51pdG6MJD2YlxXvNxKKo9evFKp0ot3mRwY6iAiAqHUr83vufpCzzW1dZcHEg5RxPD2HsUkZ4uGmqiuEsZg%3D%3D&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpcm2cms%2Cpl%2Cnh%2Cinitcwndbps&lsig=AG3C_xAwRAIgc5oRxGesUECBS-AWtMisevtLL-UyJ0uPs8Pt9nKQrr0CIFzIYKJlvcNs07DmB0JH1c3tP4VyIa4Ki5BRGhEl1Fh-',
                'type' => 'video/webm',
                'quality' => '240p',
            ],
            [
                'link' => 'https://r1---sn-fpnioxu-jj0l.googlevideo.com/videoplayback?expire=1602182297&ei=OQh_X9-0N5qq3LUP5KKi0Ag&ip=103.219.45.103&id=o-ALOe9q4STIrVdG-FTrSSHm3gcIpn7TA0kbk5oaoQpPpP&itag=160&aitags=133%2C134%2C135%2C136%2C160%2C242%2C243%2C244%2C247%2C278&source=youtube&requiressl=yes&mh=pI&mm=31%2C29&mn=sn-fpnioxu-jj0l%2Csn-bvvbax-jj0e&ms=au%2Crdu&mv=m&mvi=1&pcm2cms=yes&pl=22&nh=%2CIgppcjAxLmNjdTAxKg8yMjMuMjIzLjE1OC4yMDE&pcm2=yes&initcwndbps=672500&vprv=1&mime=video%2Fmp4&gir=yes&clen=615411&dur=203.666&lmt=1563797040479675&mt=1602160596&fvip=3&keepalive=yes&fexp=23915654&c=WEB&txp=2206222&sparams=expire%2Cei%2Cip%2Cid%2Caitags%2Csource%2Crequiressl%2Cpcm2%2Cvprv%2Cmime%2Cgir%2Cclen%2Cdur%2Clmt&sig=AOq0QJ8wRQIgGoVs17MpRtbfl81k5c6azDH-0UmfS7W2WkBcm0BJ4ngCIQCohz34vSDHKuGYk5o1XobSXjITwWFvt4OcUJd5YP2BEg%3D%3D&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpcm2cms%2Cpl%2Cnh%2Cinitcwndbps&lsig=AG3C_xAwRAIgc5oRxGesUECBS-AWtMisevtLL-UyJ0uPs8Pt9nKQrr0CIFzIYKJlvcNs07DmB0JH1c3tP4VyIa4Ki5BRGhEl1Fh-',
                'type' => 'video/mp4',
                'quality' => '144p'
            ],
            [
                'link' => 'https://r1---sn-fpnioxu-jj0l.googlevideo.com/videoplayback?expire=1602182297&ei=OQh_X9-0N5qq3LUP5KKi0Ag&ip=103.219.45.103&id=o-ALOe9q4STIrVdG-FTrSSHm3gcIpn7TA0kbk5oaoQpPpP&itag=278&aitags=133%2C134%2C135%2C136%2C160%2C242%2C243%2C244%2C247%2C278&source=youtube&requiressl=yes&mh=pI&mm=31%2C29&mn=sn-fpnioxu-jj0l%2Csn-bvvbax-jj0e&ms=au%2Crdu&mv=m&mvi=1&pcm2cms=yes&pl=22&nh=%2CIgppcjAxLmNjdTAxKg8yMjMuMjIzLjE1OC4yMDE&pcm2=yes&initcwndbps=672500&vprv=1&mime=video%2Fwebm&gir=yes&clen=716641&dur=203.666&lmt=1563797039984639&mt=1602160596&fvip=3&keepalive=yes&fexp=23915654&c=WEB&txp=2206222&sparams=expire%2Cei%2Cip%2Cid%2Caitags%2Csource%2Crequiressl%2Cpcm2%2Cvprv%2Cmime%2Cgir%2Cclen%2Cdur%2Clmt&sig=AOq0QJ8wRQIhALn5cqk_nkbRbkJqSlfgLyJmQ60xto2fEifF-lWkWD3WAiAVuDhwkXApKEKoFUDnNdABEQT7osWyZbSJu3P4oXJvHQ%3D%3D&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpcm2cms%2Cpl%2Cnh%2Cinitcwndbps&lsig=AG3C_xAwRAIgc5oRxGesUECBS-AWtMisevtLL-UyJ0uPs8Pt9nKQrr0CIFzIYKJlvcNs07DmB0JH1c3tP4VyIa4Ki5BRGhEl1Fh-',
                'type' => 'video/webm',
                'quality' => '144p'
            ],
            [
                'link' => 'https://r1---sn-fpnioxu-jj0l.googlevideo.com/videoplayback?expire=1602182297&ei=OQh_X9-0N5qq3LUP5KKi0Ag&ip=103.219.45.103&id=o-ALOe9q4STIrVdG-FTrSSHm3gcIpn7TA0kbk5oaoQpPpP&itag=140&source=youtube&requiressl=yes&mh=pI&mm=31%2C29&mn=sn-fpnioxu-jj0l%2Csn-bvvbax-jj0e&ms=au%2Crdu&mv=m&mvi=1&pcm2cms=yes&pl=22&nh=%2CIgppcjAxLmNjdTAxKg8yMjMuMjIzLjE1OC4yMDE&pcm2=yes&initcwndbps=672500&vprv=1&mime=audio%2Fmp4&gir=yes&clen=3297906&dur=203.731&lmt=1563797032457241&mt=1602160596&fvip=3&keepalive=yes&fexp=23915654&c=WEB&txp=2201222&sparams=expire%2Cei%2Cip%2Cid%2Citag%2Csource%2Crequiressl%2Cpcm2%2Cvprv%2Cmime%2Cgir%2Cclen%2Cdur%2Clmt&sig=AOq0QJ8wRAIgJ1xOCRtaahPe01OPlTS2WvAO9gyEhF62kWAgdrtqDVcCIFclDOmebx7q3Iio3qIYfjSeObODYqrZVo_mi5NESdr9&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpcm2cms%2Cpl%2Cnh%2Cinitcwndbps&lsig=AG3C_xAwRAIgc5oRxGesUECBS-AWtMisevtLL-UyJ0uPs8Pt9nKQrr0CIFzIYKJlvcNs07DmB0JH1c3tP4VyIa4Ki5BRGhEl1Fh-',
                'type' => 'audio/mp4',
                'quality' => null
            ],
            [
                'link' => 'https://r1---sn-fpnioxu-jj0l.googlevideo.com/videoplayback?expire=1602182297&ei=OQh_X9-0N5qq3LUP5KKi0Ag&ip=103.219.45.103&id=o-ALOe9q4STIrVdG-FTrSSHm3gcIpn7TA0kbk5oaoQpPpP&itag=249&source=youtube&requiressl=yes&mh=pI&mm=31%2C29&mn=sn-fpnioxu-jj0l%2Csn-bvvbax-jj0e&ms=au%2Crdu&mv=m&mvi=1&pcm2cms=yes&pl=22&nh=%2CIgppcjAxLmNjdTAxKg8yMjMuMjIzLjE1OC4yMDE&pcm2=yes&initcwndbps=672500&vprv=1&mime=audio%2Fwebm&gir=yes&clen=1250634&dur=203.701&lmt=1563799206066396&mt=1602160596&fvip=3&keepalive=yes&fexp=23915654&c=WEB&txp=2201222&sparams=expire%2Cei%2Cip%2Cid%2Citag%2Csource%2Crequiressl%2Cpcm2%2Cvprv%2Cmime%2Cgir%2Cclen%2Cdur%2Clmt&sig=AOq0QJ8wRAIgPAOOGVP5pSakshYGaZ6rcLE5kVCO9mN39ezwNSZGK2kCICtRQ7PurLeOQ4tyij96raXgIWPoEr7aQLHNh9HX4Gwq&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpcm2cms%2Cpl%2Cnh%2Cinitcwndbps&lsig=AG3C_xAwRAIgc5oRxGesUECBS-AWtMisevtLL-UyJ0uPs8Pt9nKQrr0CIFzIYKJlvcNs07DmB0JH1c3tP4VyIa4Ki5BRGhEl1Fh-',
                'type' => 'audio/webm',
                'quality' => null,
            ],
            [
                'link' => 'https://r1---sn-fpnioxu-jj0l.googlevideo.com/videoplayback?expire=1602182297&ei=OQh_X9-0N5qq3LUP5KKi0Ag&ip=103.219.45.103&id=o-ALOe9q4STIrVdG-FTrSSHm3gcIpn7TA0kbk5oaoQpPpP&itag=250&source=youtube&requiressl=yes&mh=pI&mm=31%2C29&mn=sn-fpnioxu-jj0l%2Csn-bvvbax-jj0e&ms=au%2Crdu&mv=m&mvi=1&pcm2cms=yes&pl=22&nh=%2CIgppcjAxLmNjdTAxKg8yMjMuMjIzLjE1OC4yMDE&pcm2=yes&initcwndbps=672500&vprv=1&mime=audio%2Fwebm&gir=yes&clen=1616970&dur=203.701&lmt=1563799201158694&mt=1602160596&fvip=3&keepalive=yes&fexp=23915654&c=WEB&txp=2201222&sparams=expire%2Cei%2Cip%2Cid%2Citag%2Csource%2Crequiressl%2Cpcm2%2Cvprv%2Cmime%2Cgir%2Cclen%2Cdur%2Clmt&sig=AOq0QJ8wRAIgVucyfOLXnusSFD_czUsB_eDTAH4xcwB1fDe8ZkL_IH8CIAlELiHLyj-1ommXevvNFEEL_vIeaOovvikomOWc5dg7&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpcm2cms%2Cpl%2Cnh%2Cinitcwndbps&lsig=AG3C_xAwRAIgc5oRxGesUECBS-AWtMisevtLL-UyJ0uPs8Pt9nKQrr0CIFzIYKJlvcNs07DmB0JH1c3tP4VyIa4Ki5BRGhEl1Fh-',
                'type' => 'audio/webm',
                'quality' => null
            ],
            [
                'link' => 'https://r1---sn-fpnioxu-jj0l.googlevideo.com/videoplayback?expire=1602182297&ei=OQh_X9-0N5qq3LUP5KKi0Ag&ip=103.219.45.103&id=o-ALOe9q4STIrVdG-FTrSSHm3gcIpn7TA0kbk5oaoQpPpP&itag=251&source=youtube&requiressl=yes&mh=pI&mm=31%2C29&mn=sn-fpnioxu-jj0l%2Csn-bvvbax-jj0e&ms=au%2Crdu&mv=m&mvi=1&pcm2cms=yes&pl=22&nh=%2CIgppcjAxLmNjdTAxKg8yMjMuMjIzLjE1OC4yMDE&pcm2=yes&initcwndbps=672500&vprv=1&mime=audio%2Fwebm&gir=yes&clen=3782352&dur=203.701&lmt=1563799203764997&mt=1602160596&fvip=3&keepalive=yes&fexp=23915654&c=WEB&txp=2201222&sparams=expire%2Cei%2Cip%2Cid%2Citag%2Csource%2Crequiressl%2Cpcm2%2Cvprv%2Cmime%2Cgir%2Cclen%2Cdur%2Clmt&sig=AOq0QJ8wRgIhAImecAv9WuMOcv8L5vGi4QkwTh4nkkCGe7MxXVBJs_Q8AiEAsHI7qCw9cs2xwSPyA25tYC8oe-8ex6ODSmAcgJTVrwU%3D&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpcm2cms%2Cpl%2Cnh%2Cinitcwndbps&lsig=AG3C_xAwRAIgc5oRxGesUECBS-AWtMisevtLL-UyJ0uPs8Pt9nKQrr0CIFzIYKJlvcNs07DmB0JH1c3tP4VyIa4Ki5BRGhEl1Fh-',
                'type' => 'audio/webm',
                'quality' => null
            ]

        ],
            'formats' => [
                '360p' => [
                    'link' => 'https://r1---sn-fpnioxu-jj0l.googlevideo.com/videoplayback?expire=1602182297&ei=OQh_X9-0N5qq3LUP5KKi0Ag&ip=103.219.45.103&id=o-ALOe9q4STIrVdG-FTrSSHm3gcIpn7TA0kbk5oaoQpPpP&itag=18&source=youtube&requiressl=yes&mh=pI&mm=31%2C29&mn=sn-fpnioxu-jj0l%2Csn-bvvbax-jj0e&ms=au%2Crdu&mv=m&mvi=1&pcm2cms=yes&pl=22&nh=%2CIgppcjAxLmNjdTAxKg8yMjMuMjIzLjE1OC4yMDE&pcm2=yes&initcwndbps=672500&vprv=1&mime=video%2Fmp4&gir=yes&clen=6437928&ratebypass=yes&dur=203.731&lmt=1563796462496029&mt=1602160596&fvip=3&fexp=23915654&c=WEB&txp=2211222&sparams=expire%2Cei%2Cip%2Cid%2Citag%2Csource%2Crequiressl%2Cpcm2%2Cvprv%2Cmime%2Cgir%2Cclen%2Cratebypass%2Cdur%2Clmt&sig=AOq0QJ8wRQIhAOMBkQVEtbMKQxIwo2VCQGPaRmS4i02nD7_wMOVkYjzVAiA6NG9FBjkLYjWk3Y0vOqlAMmWEw1LGPsaDAgCQjVsuXg%3D%3D&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpcm2cms%2Cpl%2Cnh%2Cinitcwndbps&lsig=AG3C_xAwRAIgc5oRxGesUECBS-AWtMisevtLL-UyJ0uPs8Pt9nKQrr0CIFzIYKJlvcNs07DmB0JH1c3tP4VyIa4Ki5BRGhEl1Fh-',
                    'type' => 'video/mp4',
                ],

                '720p' => [
                    'link' => 'https://r1---sn-fpnioxu-jj0l.googlevideo.com/videoplayback?expire=1602182297&ei=OQh_X9-0N5qq3LUP5KKi0Ag&ip=103.219.45.103&id=o-ALOe9q4STIrVdG-FTrSSHm3gcIpn7TA0kbk5oaoQpPpP&itag=22&source=youtube&requiressl=yes&mh=pI&mm=31%2C29&mn=sn-fpnioxu-jj0l%2Csn-bvvbax-jj0e&ms=au%2Crdu&mv=m&mvi=1&pcm2cms=yes&pl=22&nh=%2CIgppcjAxLmNjdTAxKg8yMjMuMjIzLjE1OC4yMDE&pcm2=yes&initcwndbps=672500&vprv=1&mime=video%2Fmp4&ratebypass=yes&dur=203.731&lmt=1563797047771622&mt=1602160596&fvip=3&fexp=23915654&c=WEB&txp=2206222&sparams=expire%2Cei%2Cip%2Cid%2Citag%2Csource%2Crequiressl%2Cpcm2%2Cvprv%2Cmime%2Cratebypass%2Cdur%2Clmt&sig=AOq0QJ8wRQIhAPtYO0D_AKu1Rpcua6Fgh630KR7mF8X0WZvr2atAFMJqAiAyJqg5Ef56X9dab8xQ-bCe81qhmLQaP8BK13YxDrFkCQ%3D%3D&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpcm2cms%2Cpl%2Cnh%2Cinitcwndbps&lsig=AG3C_xAwRAIgc5oRxGesUECBS-AWtMisevtLL-UyJ0uPs8Pt9nKQrr0CIFzIYKJlvcNs07DmB0JH1c3tP4VyIa4Ki5BRGhEl1Fh-',
                    'type' => 'video/mp4',
                ]

            ],
            'thumbnails' => [
                '0' => [
                    'url' => 'https://i.ytimg.com/vi/Pg4XhiV_72Y/hqdefault.jpg?sqp=-oaymwEiCKgBEF5IWvKriqkDFQgBFQAAAAAYASUAAMhCPQCAokN4AQ==&rs=AOn4CLBZuWaQdxYsUvGoF80igH0uQTML4Q',
                    'width' => '168',
                    'height' => '94',
                ],

                '1' => [
                    'url' => 'https://i.ytimg.com/vi/Pg4XhiV_72Y/hqdefault.jpg?sqp=-oaymwEiCMQBEG5IWvKriqkDFQgBFQAAAAAYASUAAMhCPQCAokN4AQ==&rs=AOn4CLDWX9rB02CyLseQ8rJf24vJeLSUpA',
                    'width' => '196',
                    'height' => '110',
                ],

                '2' => [
                    'url' => 'https://i.ytimg.com/vi/Pg4XhiV_72Y/hqdefault.jpg?sqp=-oaymwEjCPYBEIoBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLDtkafz0onH3WPOCOjlUm2Jx7hKVQ',
                    'width' => '246',
                    'height' => '138',
                ],

                '3' => [
                    'url' => 'https://i.ytimg.com/vi/Pg4XhiV_72Y/hqdefault.jpg?sqp=-oaymwEjCNACELwBSFryq4qpAxUIARUAAAAAGAElAADIQj0AgKJDeAE=&rs=AOn4CLAIbuZmrLq2zK20NGZHKHFBXYNKSg',
                    'width' => '336',
                    'height' => '188',
                ],

                '4' => [
                    'url' => 'https://i.ytimg.com/vi/Pg4XhiV_72Y/maxresdefault.jpg',
                    'width' => '1920',
                    'height' => '1080',
                ],

            ]*/
        ];
        
        $this->assertEquals($acceptedVideoDetail['title'], $this->videoDetail['title']);
    }

    public function testGetVideoQualities()
    {
        $acceptedQualities = ['360p', '720p'];
        $qualities = $this->youtube->getVideoQualities();
        $this->assertEquals(implode(' ', $acceptedQualities), implode(' ', $qualities));
    }

    public function testDownloadThumbnails()
    {
        $this->youtube->downloadThumbnails($this->videoDetail);
        $this->assertFileExists('videos/Pg4XhiV_72Y/ytimg_168-94px.jpg');
    }

    public function testDownloadAVideo()
    {
        $this->youtube->downloadAVideo($this->videoDetail['formats']['360p']['link'], $this->videoDetail['video_id'], '360p');
        $this->assertFileExists('videos/Pg4XhiV_72Y/ytvideo_360p.mp4');
    }

    public function testGetDownloadFolder(){
        $this->assertDirectoryExists('videos/Pg4XhiV_72Y');
    }
}

<?php
require "init.php";
$link = $_GET['link'];

parse_str($link, $urlData);
$my_id = array_values($urlData)[0];

$videoFetchURL = "http://www.youtube.com/get_video_info?&video_id=" . $my_id . "&asv=3&el=detailpage&hl=en_US";
$videoData = get($videoFetchURL);
echo '<iframe width="250px" height="60px" scrolling="no" style="border:none;" src="https://www.download-mp3-youtube.com/api/?api_key=MjI1OTAwMDgw&format=mp3&video_id=' . $my_id . '"></iframe>';

parse_str($videoData, $video_info);

$video_info = json_decode(json_encode($video_info));
if (!$video_info->status ===  "ok") {
    die("error in fetching youtube video data");
}
$videoTitle = $video_info->title;
$videoAuthor = $video_info->author;
$videoDurationSecs = $video_info->length_seconds;
$videoDuration = secToDuration($videoDurationSecs);
$videoViews = $video_info->view_count;

//change hqdefault.jpg to default.jpg for downgrading the thumbnail quality
$videoThumbURL = "http://i1.ytimg.com/vi/{$my_id}/hqdefault.jpg";

if (!isset($video_info->url_encoded_fmt_stream_map)) {
    die('No data found');
}

$streamFormats = explode(",", $video_info->url_encoded_fmt_stream_map);

if (isset($video_info->adaptive_fmts)) {
    $streamSFormats = explode(",", $video_info->adaptive_fmts);
    $pStreams = parseStream($streamSFormats);
}
    $cStreams = parseStream($streamFormats);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>YouTube Video Downloader</title>
    
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</head>
<body style="font-family: Lato; ">
    <div class="container" style="margin-top: 50px; margin-bottom: 150px;">
        <div class="row">
            <div class="col-md-6 offset-md-3" style="padding: 0; border: 1px solid #CCC; ">
                <a href="index.php"><img src="https://goo.gl/3TsUGi" alt="Header Image" style="width: 100%"> </a>               
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3" style="border: 1px solid #CCC; ">
                <br>
                <h4 style="font-weight: 300;padding-left: 10px;"><?php echo $videoTitle ?></h4>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <!-- Thumbnail -->
                        <img src="<?php echo $videoThumbURL ;?>" alt="Video Thumbnail" style="width:100%;">
                    </div>
                    <div class="col-md-8">
                        <h6 style="font-weight: 700;">Channel</h6>
                        <h6 style="font-size: 80%;"><?php echo $videoAuthor; ?></h6>
                        <h6 style="font-weight: 700;">Duration</h6>
                        <h6 style="font-size: 80%;"><?php echo $videoDuration; ?></h6>
                        <h6 style="font-weight: 700;">Views</h6>
                        <h6 style="font-size: 80%;"><?php echo $videoViews; ?></h6>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="text-align: center;">Video+Audio Formats</h5>
                        <br>
                        <?php foreach ($cStreams as $stream): ?>
                            <?php $stream = json_decode(json_encode($stream)) ;?>
                            <div class="row" style="text-align: center;">
                                <div class="col-md-3"><?php echo $stream->type ?></div>
                                <div class="col-md-3"><?php echo $stream->quality ?></div>
                                <div class="col-md-3"><?php echo $stream->size ?></div>
                                <div class="col-md-3"><a href="<?php echo $stream->url; ?>" download ><button class="btn btn-sm btn-outline-success">Download</button></a></div>

                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <?php if (isset($pStreams)): ?>
                <hr>    
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="text-align: center;">Video+Audio Formats</h5>
                        <br>
                        <?php foreach ($pStreams as $stream): ?>
                            <?php $stream = json_decode(json_encode($stream)) ;?>
                            <div class="row" style="text-align: center;">
                                <div class="col-md-3"><?php echo $stream->type ?></div>
                                <div class="col-md-3"><?php echo $stream->quality ?></div>
                                <div class="col-md-3"><?php echo $stream->size ?></div>
                                <div class="col-md-3"><a href="<?php echo $stream->url; ?>" download ><button class="btn btn-sm btn-outline-success">Download</button></a></div>

                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
				
                <?php endif ?>
				
                <hr>
            </div>
            <hr>
            
        </div>
    </div> 
</body>
</html>
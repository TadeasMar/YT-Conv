<?php
set_time_limit(300);
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['link'])) {
        $format = $_POST['format'];
        $quality = $_POST['quality'];
        if (isset($_POST['playlist'])) {
            $playlistBool = "yes";
        } else {
            $playlistBool = "no";
        }
        $link = escapeshellarg($_POST['link']);
        if ($format === "mp3") {
            $command = "yt-dlp -x -P C:/UwAmp/www/YTConv/download --ffmpeg-location C:/ffmpeg/bin  --audio-format {$format} --audio-quality {$quality}K {$link} --{$playlistBool}-playlist"; 
        } elseif ($format === "mp4") {
            $command = "yt-dlp -f -P C:/UwAmp/www/YTConv/download {$quality}+140 --merge-output-format {$format} {$link} --{$playlistBool}-playlist";
        }
        $handle = popen($command, "r");
        echo "<pre>";
        if ($handle) {
            while (!feof($handle)) {
                $line = fgets($handle);
                echo htmlspecialchars($line) . "<br>"; 
                ob_flush();
                flush();
            }
            pclose($handle);
        }
        echo "</pre>";
       }
?>
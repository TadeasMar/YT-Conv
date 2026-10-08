<?php
set_time_limit(500);
    $channelsRaw = $_POST['channels'];
    $channels = array_filter(array_map('trim', explode(',', $channelsRaw)));
    $noCheck = isset($_POST['no-check']) ? (int)$_POST['no-check'] : 1;
    $noCheck = max(1, min($noCheck, 50));
    $format = $_POST['format-auto'];
    $downloadDir = 'C:/UwAmp/www/YTConv/download';
    $archiveFile = 'C:/YTConv/archive.txt';
    if (!is_dir($downloadDir)) {
        mkdir($downloadDir, 0777, true);
    }
    foreach ($channels as $url) {
        if (strpos($url, '/videos') === false && strpos($url, '/streams') === false) {
            $url = rtrim($url, '/') . '/videos';
        }
        $safeUrl = escapeshellarg($url);
        $safeArchive = escapeshellarg($archiveFile);
        $safeDir = escapeshellarg($downloadDir);
        $format = escapeshellarg($format);
        $range = escapeshellarg("1:{$noCheck}");
        $command = sprintf(
            'yt-dlp --newline -I %s -f "bv*[height<=480]+ba[ext=m4a]/b[height<=480]" --merge-output-format %s --ffmpeg-location "C:\\ffmpeg\\bin" --download-archive %s -P %s -o "%%(title)s [%%(id)s].%%(ext)s" %s 2>&1',
            $range,
            $format,
            $safeArchive,
            $safeDir,
            $safeUrl
        );
        echo "<h4>Checking: " . htmlspecialchars($url) . " (first {$noCheck} videos)</h4><pre>";
        $handle = popen($command, "r");
        if ($handle === false) {
            echo "Failed to start.</pre><hr>";
            continue;
        }
        while (!feof($handle)) {
            $line = fgets($handle);
            if ($line !== false) {
                echo htmlspecialchars($line) . "<br>";
                ob_flush();
                flush();
            }
        }
        pclose($handle);
        echo "</pre><hr>";
    }
?>
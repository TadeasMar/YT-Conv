<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ytConv</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="forms-wrapper">
    <form method="POST" action="ytconv.php" class="form">
        <!-- MP3 Column -->
        <div class="column column_audio">
            <h3>Audio (MP3)</h3>

            <div class="form_group">
                <input type="radio" name="format" id="mp3" value="mp3">
                <label for="mp3"> MP3 </label>
            </div>

            <h4>Quality</h4>
            <div class="form_group radio_audio quality">
                <input type="radio" name="quality" id="32" value="32">
                <label for="32"> 32kbps </label>
            </div>
            <div class="form_group radio_audio quality">
                <input type="radio" name="quality" id="96" value="96">
                <label for="96"> 96kbps </label>
            </div>
            <div class="form_group radio_audio quality">
                <input type="radio" name="quality" id="128" value="128">
                <label for="128"> 128kbps </label>
            </div>
            <div class="form_group radio_audio quality">
                <input type="radio" name="quality" id="192" value="192">
                <label for="192"> 192kbps </label>
            </div>
            <div class="form_group radio_audio quality">
                <input type="radio" name="quality" id="256" value="256">
                <label for="256"> 256kbps </label>
            </div>
            <div class="form_group radio_audio quality">
                <input type="radio" name="quality" id="320" value="320">
                <label for="320"> 320kbps </label>
            </div>
            <div class="form_group radio_audio">
                <input type="checkbox" name="playlist" id="playlistAudio" value="1">
                <label for="playlist"> Playlist? </label>
            </div>
        </div>

        <!-- MP4 Column -->
        <div class="column column_video">
            <h3>Video (MP4)</h3>

            <div class="form_group">
                <input type="radio" name="format" id="mp4" value="mp4">
                <label for="mp4"> MP4 </label>
            </div>

            <h4>Quality</h4>
            <div class="form_group radio_video quality">
                <input type="radio" name="quality" id="144" value="160">
                <label for="144"> 144p </label>
            </div>
            <div class="form_group radio_videoquality">
                <input type="radio" name="quality" id="240" value="133">
                <label for="240"> 240p </label>
            </div>
            <div class="form_group radio_video quality">
                <input type="radio" name="quality" id="360" value="134">
                <label for="360"> 360p </label>
            </div>
            <div class="form_group radio_video quality">
                <input type="radio" name="quality" id="480" value="83">
                <label for="480"> 480p </label>
            </div>
            <div class="form_group radio_video quality">
                <input type="radio" name="quality" id="720" value="136">
                <label for="720"> 720p </label>
            </div>
            <div class="form_group radio_video quality">
                <input type="radio" name="quality" id="1080" value="37">
                <label for="1080"> 1080p </label>
            </div>
            <div class="form_group radio_video">
                <input type="checkbox" name="playlist" id="playlistVideo" value="1">

                <label for="playlist"> Playlist? </label>
            </div>
        </div>

        <!-- YouTube Link -->
        <div style="grid-column: span 2; text-align: center;">
            <label for="link">YouTube Link:</label>
            <input type="text" name="link" id="link" placeholder="Video URL" required>
        </div>

        <!-- Submit Button -->
        <button type="submit">Submit</button>
    <!-- Auto Download -->
    </form>

    <form method="POST" action="ytconvauto.php" class="form-auto" id="autoForm">
    <div class="column_auto">
        <h3>Channel download</h3>
        
        <!-- Tag input area -->
        <div class="tag-input-wrapper">
            <label for="link-channel">Channel Link:</label>
            <div class="tag-container" id="tagContainer">
                <!-- Tags appear here -->
                <input 
                    type="text" 
                    id="link-channel" 
                    class="tag-input" 
                    placeholder="Channel URL"
                    autocomplete="off"
                >
            </div>
        </div>
        <div class="no_check">
            <label for="no-check">No of videos to check: </label>
            <input type="number" name="no-check" id="no-check" class="no_check">
        </div>
        <fieldset>
        <legend>Select a format:</legend>
        <div>
            <input type="radio" id="mp3" name="format-auto" value="mp3"/>
            <label for="mp3">MP3</label>
        </div>
        <div>
            <input type="radio" id="mp4" name="format-auto" value="mp4" checked/>
            <label for="mp4">MP4</label>
        </div>
        </fieldset>
        <input type="hidden" name="channels" id="channelsHidden" value="">
    </div>
    
    <button type="submit">Submit</button>
    </form>
</div>
    <script>
        const playlistVideo = document.getElementById("playlistVideo");
        const playlistAudio = document.getElementById("playlistAudio");

        // Selects the respective format button if the quality/playlist checkbox is selected
        document.querySelectorAll(".column_video .radio_video").forEach((quality) => {
            quality.addEventListener("change", function() {
                console.log("Video radio button clicked!");
                document.getElementById("mp4").checked = true;
                if (playlistAudio.checked) {
                    playlistAudio.checked = false;
                    playlistVideo.checked = true;
                }
            });
        });
        document.querySelectorAll(".column_audio .radio_audio").forEach((quality) => {
            quality.addEventListener("change", function() {
                console.log("Audio radio button clicked!");
                document.getElementById("mp3").checked = true;
                if (playlistVideo.checked) {
                    playlistAudio.checked = true;
                    playlistVideo.checked = false;
                }
            });
        });

        // Deselects the respective quality checkbox if the format button is selected
        document.querySelectorAll('.column_video input[name="format"]').forEach((quality) => {
            quality.addEventListener("change", function() {
                console.log("MP4 format button clicked!");
                document.querySelectorAll(".column_audio input[name='quality']").forEach((audioQuality) => {
                    audioQuality.checked = false;
                if (playlistAudio.checked) {
                    playlistAudio.checked = false;
                    playlistVideo.checked = true;
                }
                });
            });
        });
        document.querySelectorAll('.column_audio input[name="format"]').forEach((quality) => {
            quality.addEventListener("change", function() {
                console.log("MP3 format button clicked!");
                document.querySelectorAll(".column_video input[name='quality']").forEach((videoQuality) => {
                    videoQuality.checked = false;
                if (playlistVideo.checked) {
                    playlistAudio.checked = true;
                    playlistVideo.checked = false;
                }
                });
            });
        });
        document.querySelectorAll(".column_audio input[type='checkbox']").forEach((playlist) => {
            playlist.addEventListener("change", function() {
                console.log("Audio playlist checkbox checked!");
                document.querySelectorAll(".column_video input[name='quality']").forEach((videoQuality) => {
                    videoQuality.checked = false;
                });
            });
        });
        document.querySelectorAll(".column_video input[type='checkbox']").forEach((playlist) => {
            playlist.addEventListener("change", function() {
                console.log("Video playlist checkbox checked!");
                document.querySelectorAll(".column_audio input[name='quality']").forEach((audioQuality) => {
                    audioQuality.checked = false;
                });
            });
        });
    // --- Tag System ---
    const tagContainer = document.getElementById('tagContainer');
    const tagInput = document.getElementById('link-channel');
    const hiddenInput = document.getElementById('channelsHidden');
    const autoForm = document.getElementById('autoForm');

    let channels = [];

    function updateHidden() {
        hiddenInput.value = channels.join(',');
    }

    function createTag(url) {
        const chip = document.createElement('div');
        chip.className = 'tag-chip';
        
        const text = document.createElement('span');
        text.textContent = url.substring(25,url.length);
        
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'tag-remove';
        removeBtn.innerHTML = '&times;';
        removeBtn.title = 'Remove';
        
        removeBtn.addEventListener('click', () => {
            chip.remove();
            channels = channels.filter(c => c !== url);
            updateHidden();
        });
        
        chip.appendChild(text);
        chip.appendChild(removeBtn);
        tagContainer.insertBefore(chip, tagInput);
    }


    tagInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            const url = tagInput.value.trim();
            
            
            if (!url) return;
            if (channels.includes(url)) {
                tagInput.value = '';
                return; 
            }

            channels.push(url);
            createTag(url);
            updateHidden();
            tagInput.value = '';
        }
    });

    tagContainer.addEventListener('click', () => tagInput.focus());
    </script>
</body>
</html>

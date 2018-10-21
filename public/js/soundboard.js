        var running = false;
        var queuerunning = false;
        var playText = "Pause all";
        var pauseText = "PLAY <b>ALL</b> AT ONCE";
        var currentPlayingIndex = 0;
        
        var audioQueue = [];
        var allAudios = [];
        var currentMedia = [];
        
        window.onload = function(e){ 
            allAudios = document.getElementsByName("sound");
        }

        function toggleAllSounds() {
            if(running)
            {
                stopAllSounds();
            }
            else
            {
                playAllSounds();
            }
        }
        function playAllSounds()
        {
            var btn = document.getElementById('play'); 
            var isLimited = document.getElementById("playLimitation").checked;
            var allCount = allAudios.length;
            if(isLimited)
            {
                var visibleAudio = getVisibleAudio();
                var visibleCount = visibleAudio.length;
                if(visibleAudio.length>0)
                {
                    if(visibleAudio.length>100)
                    {
                        if (confirm("You about to play " + visibleCount + " Samples at once. You want to play them?")) {
                            btn.innerHTML = playText;
                            for (var i = 0; i<visibleAudio.length; i++) {
                                visibleAudio[i].play();
                            }
                            running = true; 
                        }
                    }
                    else
                    {
                        btn.innerHTML = playText;
                        for (var i = 0; i<visibleAudio.length; i++) {
                            visibleAudio[i].play();
                        }
                        running = true; 
                    }
                    
                }
            }
            else
            {
                if (confirm("You about to play " + allCount + " Samples at once. You want to play them?")) {
                    btn.innerHTML = playText;
                    for (var i = 0; i<allAudios.length; i++) {
                        allAudios[i].play();
                    }
                }
                running = true;
            }
            
        }
        function stopAllSounds()
        {
            var btn = document.getElementById('play'); 
            
            document.getElementById('queue_info_right_side').style.display = "";
            btn.innerHTML = pauseText;
            enableQueueButton(false);
            for (var i = 0; i<allAudios.length; i++) {
                allAudios[i].pause();
            }
            running=false;
        }
        function ChangeSpeed(speed){
            document.getElementById("cspeed").value = speed;
            document.getElementById("myRange").value = speed;
            var oAudio = document.getElementsByName('sound');
            
            for(var i=0; i<oAudio.length; i++) 
            {
                oAudio[i].playbackRate = speed;   
            }
        }
        function rewindAudio() {
            if (window.HTMLAudioElement) {
                try 
                {
                    var oAudio = document.getElementsByName('sound');
                    for(var i=0; i<oAudio.length; i++) 
                    {
                        oAudio[i].currentTime = 0.0;
                    }
                }
                catch (e) {
                    // Fail silently but show in F12 developer tools console
                     if(window.console && console.error("Error:" + e));
                }
            }
        }
        function playRandomAudio() {
            if(!(document.getElementById("allowMultiplaycheckbox").checked))
            {
                for(i=0;i<allAudios.length;i++)
                {
                        allAudios[i].pause();
                }
            }
            else {}
            if(document.getElementById("playLimitation").checked)
            {
                var visibleAudio = getVisibleAudio();
                if(visibleAudio.length>0)
                {
                    var id = Math.floor(Math.random() * visibleAudio.length);
                    visibleAudio[id].currentTime = 0.0;
                    visibleAudio[id].play();
                }
                else
                {
                    alert("No sounds to play");
                }
            }
            else
            {
                var id = Math.floor(Math.random() * allAudios.length);
                allAudios[id].currentTime = 0.0;
                allAudios[id].play();
            }
        }
        
        function startsPlaying(id){
            var soundElement = document.getElementById('cell_'+ id);
            if(soundElement.innerHTML.indexOf('\"Sample-Name\"></a') === -1)
            {
                soundElement.style.backgroundColor = "green";
                currentMedia.push(soundElement.cloneNode(true));
                updateCurrentMedia();
            }
        }
        function stopsPlaying(id){
            var element = document.getElementById('cell_'+ id);
            currentMedia.splice(currentMedia.indexOf(element),1);
            updateCurrentMedia();
            element.style.backgroundColor = "inherit";
        }
        function audioEnded(id)
        {
            playNextSampleInQueue();
        }
        function searchBarKeyUp(){
            searchFor();
            var input = document.getElementById("myInput").value.length;
            if(input>0)
            {
                document.getElementById('btnClearSearchbar').style.visibility = "visible";
            }
            else
            {
                document.getElementById('btnClearSearchbar').style.visibility = "hidden";
            }
        }
        function searchFor() {
            var input, filter, table, tr, td1, td2, td3, td4;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("soundTable");
            tr = table.getElementsByTagName("tr");
            
            for (var i = 0; i < tr.length; i++) {
                td1 = tr[i].getElementsByTagName("td")[0];
                td2 = tr[i].getElementsByTagName("td")[1];
                td3 = tr[i].getElementsByTagName("td")[2];
                td4 = tr[i].getElementsByTagName("td")[3];
                if (td1 || td3) {
                    var res1 = td1.innerHTML.toUpperCase().indexOf(filter) > -1;
                    var res2 = td3.innerHTML.toUpperCase().indexOf(filter) > -1;
                    if(res1 === true && res2 === true)
                    {
                        td1.style.display = "";
                        td2.style.display = "";
                        td3.style.display = "";
                        td4.style.display = "";
                        td1.style.filter = "";
                        td2.style.filter = "";
                        td3.style.filter = "";
                        td4.style.filter = "";
                    }
                    else if(res1 === true && res2 === false)
                    {
                        td1.style.display = "";
                        td2.style.display = "";
                        td3.style.display = "";
                        td4.style.display = "";
                        td1.style.filter = "";
                        td2.style.filter = "";
                        td3.style.filter = "contrast(20%)";
                        td4.style.filter = "contrast(20%)";
                    }
                    else if(res1 === false && res2 === true)
                    {
                        td1.style.display = "";
                        td2.style.display = "";
                        td3.style.display = "";
                        td4.style.display = "";
                        td1.style.filter = "contrast(20%)";
                        td2.style.filter = "contrast(20%)";
                        td3.style.filter = "";
                        td4.style.filter = "";
                    }
                    else if(res1 === false && res2 === false)
                    {
                        td1.style.display = "none";
                        td2.style.display = "none";
                        td3.style.display = "none";
                        td4.style.display = "none";
                        td1.style.filter = "";
                        td2.style.filter = "";
                        td3.style.filter = "";
                        td4.style.filter = "";
                    }
                }       
            }
        }

        function clearSearchBar(){
            document.getElementById('myInput').value = "";
            searchBarKeyUp();
        }

        function copyMeme()
        {
            copyTextToClipboard();
            alert("Copied the meme to clipboard");
        }

        function copyTextToClipboard(text) {
            var textArea = document.createElement("textarea");
            textArea.value = document.getElementById("meme_Clipboard_Text").innerText;
            document.body.appendChild(textArea);
            textArea.select();
            try {
                document.execCommand('copy');
            } catch (err) {
                console.log('Oops, unable to copy');
            }
            document.body.removeChild(textArea);
        }

        function queueAll()
        {
            if(document.getElementById("playLimitation").checked)
            {
                audioQueue = getVisibleAudio();
                if(audioQueue.length>0)
                {
                    runQueue();
                }
                else
                {
                    alert("No sounds to queue");
                }
            }
            else
            {
                audioQueue = allAudios;
            }
            runQueue();
            document.getElementById('queue_info_right_side').style.display = "block";
        }
        function enableQueueButton(enable)
        {
            document.getElementById("player_backward").disabled = !enable;
            document.getElementById("player_forward").disabled = !enable;
            document.getElementById("playbutton").disabled = !enable;
        }
        
        function runQueue()
        {
            queuerunning = true;
            currentPlayingIndex = 0;
            playNextSampleInQueue();
            enableQueueButton(true);
        }
        
        function playNextSampleInQueue()
            {
            if(audioQueue.length>0 && audioQueue.length>currentPlayingIndex)
            {
                audioQueue[currentPlayingIndex].currentTime = 0.0;
                audioQueue[currentPlayingIndex].play();
                queuerunning = true;
            }
            else
            {
                queuerunning = false;
                document.getElementById('queue_info_right_side').style.display = "none";
                enableQueueButton(false);
            }
        }
        function playPrevoiusSampleInQueue()
        {
            if(audioQueue.length>0 && 0<currentPlayingIndex)
            {
                audioQueue[currentPlayingIndex].currentTime = 0.0;
                audioQueue[currentPlayingIndex].play();
                queuerunning = true;
            }
            else
            {
                queuerunning = false;
                document.getElementById('queue_info_right_side').style.display = "none";
                enableQueueButton(false);
            }
        }
        function queueFastForward()
        {
            audioQueue[currentPlayingIndex].pause();
            currentPlayingIndex++;
            playNextSampleInQueue();
        }
        function queueReverse()
        {
            audioQueue[currentPlayingIndex].pause();
            currentPlayingIndex--;
            playPrevoiusSampleInQueue();
        }
        function toggleCurrent()
        {
            var playSymbol = '<i class="fas fa-play"></i>';
            var pauseSymbol = '<i class="fas fa-pause"></i>';
            if(!running)
            {
                audioQueue[currentPlayingIndex].pause();
                document.getElementById("playbutton").innerHTML = playSymbol;
            }
            else
            {
                audioQueue[currentPlayingIndex].play();
                document.getElementById("playbutton").innerHTML = pauseSymbol;
            }
            running = !running;
        }
        
        function getVisibleAudio() {
            var visibleAudio = [];
            for(var i=0;i<allAudios.length;i++)
            {

                if(allAudios[i].offsetParent != null)
                {
                    if(allAudios[i].offsetParent.style.filter.length === 0)
                    {
                        visibleAudio.push(allAudios[i]);
                    }
                }
            }
            return visibleAudio;
        }
        function updateCurrentMedia()
        {
            var table = document.getElementById("currentMediaDisplay");
            var cache1, cache2;
            table.innerHTML = '';
            for (var i = 0; i < currentMedia.length; i++) {
                var li = document.createElement("li");
                cache1 = currentMedia[i];
                cache2 = cache1.getElementsByClassName("Meta-Data");
                if(cache2[0] != null)
                {
                    cache1.removeChild(cache2[0]);
                }
                li.innerHTML = currentMedia[i].innerHTML;
                table.appendChild(li);
            }
        }

        document.onkeydown = function(evt) {
            evt = evt || window.event;
            var isEscape = false;
            if ("key" in evt) {
                isEscape = (evt.key === "Escape" || evt.key === "Esc");
            } else {
                isEscape = (evt.keyCode === 27);
            }
            if (isEscape) {
                stopAllSounds();
            }
        };

<?php
// PHP 部分（当前无额外逻辑，预留扩展空间）
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NIHAHAHA</title>
    <style>
        /* 嵌入原 CSS 代码 */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            user-select: none; /* Prevents text and elements from being selected */
            -webkit-touch-callout: none; /* Prevents callout, like the long-press menu */
            -webkit-user-select: none; /* Prevents text selection on iOS */
            -webkit-tap-highlight-color: transparent; /* Prevents the blue highlight on touch */
        }

        body {
            background: url('./img/koyuki_background.png') center center repeat;
            background-size: contain;
            cursor: pointer;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #bgm-toggle {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 9999; /* Ensures the icon is on the top layer */
        }

        #bgm-icon {
            width: 36px;
            height: 36px;
        }

        img.icon {
            position: absolute;
            width: 120px;
            height: 120px;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body>
    <div id="bgm-toggle">
        <img id="bgm-icon" src="./img/bgm_off.png" alt="BGM Off">
    </div>
    <audio id="bgm" src="./sounds/koyuki_bgm.mp3" loop></audio>
    <audio id="nihahaha-sound" src="./sounds/nihahaha.ogx"></audio>
    <audio id="uwah-sound" src="./sounds/uwah.ogx"></audio>

    <script>
        /* 嵌入原 JavaScript 代码 */
        document.addEventListener('DOMContentLoaded', init);

        function init() {
            const bgm = document.getElementById('bgm');
            const bgmIcon = document.getElementById('bgm-icon');
            let nihahahaSoundSrc = './sounds/nihahaha.ogx';
            let uwahSoundSrc = './sounds/uwah.ogx';
            let isBgmOn = false;
            bgm.volume = 0.8;

            window.addEventListener("dragstart", (e)=>e.preventDefault());

            document.getElementById('bgm-toggle').addEventListener('click', (e) => {
                e.stopPropagation();  // Prevents click event from propagating to the body
                toggleBgm();
            });
            
            document.body.addEventListener('click', (e) => handleBodyClick(e));

            function toggleBgm() {
                isBgmOn = !isBgmOn;
                if (isBgmOn) {
                    bgm.play();
                    bgmIcon.src = './img/bgm_on.png';
                } else {
                    bgm.pause();
                    bgmIcon.src = './img/bgm_off.png';
                }
            }

            function handleBodyClick(event) {
                if (event.target.id === 'bgm-icon') return;  // Ensure the click on BGM icon does not spawn another icon
                const iconType = Math.random() < 0.9 ? 'nihahaha' : 'uwah';
                playSound(iconType);
                addIcon(event, iconType);
            }

            function playSound(type) {
                const sound = new Audio(type === 'nihahaha' ? nihahahaSoundSrc : uwahSoundSrc);
                sound.play();
            }

            function addIcon(event, iconType) {
                const iconSize = Math.floor(Math.random() * 51) + 100; // Random size between 100 and 150 inclusive
                const icon = document.createElement('img');
                icon.classList.add('icon');
                icon.style.left = `${event.clientX}px`;
                icon.style.top = `${event.clientY}px`;
                icon.style.width = `${iconSize}px`;
                icon.style.height = `${iconSize}px`;
                icon.src = `./img/${iconType}.png`;
                document.body.appendChild(icon);
            }
        }
    </script>
</body>
</html>

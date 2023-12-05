<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-black text-5xl md:text-4xl lg:text-4xl lg:mt-3 dark:text-white">
            {{ __('Sobre Nosotros') }}
        </h2>
    </x-slot>
    
    <div class="team-container">
        <a href="{{ route('about-gerard') }}">👁️</a>
        <a class="openModalBtn team-member-gerard" onmouseover="showHobby('gerard')" onmouseout="showJob('gerard')">
            <h1 id="gerard-name">Gerard Diaz Calafell</h1>
            <img src="{{ asset('img/gerard-serio.png') }}" alt="Gerard Diaz Calafell" onmouseover="playmusic('audio-gerard', '{{ asset('img/gerard.jpeg') }}', 'grayscale(0%)')" onmouseout="stopmusic('audio-gerard', '{{ asset('img/gerard-serio.png') }}', 'grayscale(100%)')" onclick="openVideo('myModal-gerard', '{{ asset('audio/gerard.mp4') }}')">
            <p id="gerard-job">CEO</p>
        </a>
        <div id="myModal-gerard" class="modal">
            <div class="modal-content">
                <video controls autoplay muted>
                    <source src="{{asset('audio/gerard.mp4') }}" type="video/mp4">
                </video>
            </div>
        </div>
        <audio id="audio-gerard">
            <source src="{{asset('audio/gerard.mp3') }}" type="audio/mp3">
        </audio>

        <a class="openModalBtn team-member-cristian" onmouseover="showHobby('cristian')" onmouseout="showJob('cristian')">
            <h1 id="cristian-name">Cristian Martinez Guerrero</h1>
            <img src="{{ asset('img/cristian-serio.jpg') }}" alt="Cristian Martinez Guerrero" onmouseover="playmusic('audio-cristian', '{{ asset('img/cristian.png') }}', 'grayscale(0%)')" onmouseout="stopmusic('audio-cristian', '{{ asset('img/cristian-serio.jpg') }}', 'grayscale(100%)')" onclick="openVideo('myModal-cristian', '{{ asset('audio/cristian.mp4') }}')">
            <p id="cristian-job">CEO</p>
        </a>
        <div id="myModal-cristian" class="modal">
            <div class="modal-content">
                <video controls autoplay muted>
                    <source src="{{asset('audio/cristian.mp4') }}" type="video/mp4">
                </video>
            </div>
        </div>
        <audio id="audio-cristian">
            <source src="{{asset('audio/cristian.mp3') }}" type="audio/mp3">
        </audio>
        <a href="{{ route('about-cristian') }}">👁️</a>

    </div>
    <script>
        const btn = document.querySelector('.openModalBtn');

        function showHobby(member) {
            if (member === 'gerard') {
                document.getElementById(`${member}-job`).innerText = 'Hobby: Fumar';
            }
            if (member === 'cristian') {
                document.getElementById(`${member}-job`).innerText = 'Hobby: Jugar al fútbol';
            }
        }

        function showJob(member) {
            document.getElementById(`${member}-job`).innerText = 'CEO';
        }

        function playmusic(audioId, imgSrc, filter) {
            var audio = document.getElementById(audioId);
            audio.play();
            changeImage(imgSrc, filter);
        }

        function stopmusic(audioId, imgSrc, filter) {
            var audio = document.getElementById(audioId);
            audio.pause();
            changeImage(imgSrc, filter);
        }

        function changeImage(src, filter) {
            const img = event.target;
            img.src = src;
            img.style.filter = filter;
        }

        function openVideo(modalId, videoSrc) {
            const modal = document.getElementById(modalId);
            const video = modal.querySelector('video');

            video.src = videoSrc;

            modal.style.display = 'flex';
        }

        function closeVideo(modalId) {
            const modal = document.getElementById(modalId);
            const video = modal.querySelector('video');
            video.pause();
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target.className === 'modal') {
                closeVideo(event.target.id);
            }
        };


    </script>


    <style>
        .team-container {
            margin-top: 50px;
            width: 100%;
            display: flex;
            flex-wrap:wrap;
            justify-content: center;
            margin-bottom: 40px;
        }

        .team-member-gerard, .team-member-cristian {
            display: inline-block;
            margin: 50px;
            text-align: center;
            cursor: pointer;
        }

        .team-member-gerard img, .team-member-cristian img {
            filter: grayscale(100%);
            width: 400px;
            height: 400px;
            border-radius: 50%;
            transition: transform 0.3s ease-in-out;
        }

        .team-member-gerard p, .team-member-cristian p {
            margin: 5px 0;
            font-weight: bold;
        }

        .team-member-gerard img:hover {
            transform: scaleX(-1);
            z-index: 1;
        }

        .team-member-cristian img:hover {
            animation: rotate360 1.5s linear;
            z-index: 1;
        }

        @keyframes rotate360 {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(1080deg); }
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 9999; 
        }

        .modal-content {
            max-width: 80%;
            max-height: 80%;
        }

        #openModalBtn {
            cursor: pointer;
            text-decoration: none;
        }

    </style>
</x-app-layout>

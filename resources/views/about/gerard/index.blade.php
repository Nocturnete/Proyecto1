<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-black text-5xl md:text-4xl lg:text-4xl lg:mt-3 dark:text-white">
            {{ __('Gerard') }}
        </h2>
    </x-slot>

    <div class="team-container">
        <a class="openModalBtn team-member" onmouseover="showHobby('gerard')" onmouseout="showJob('gerard')">
            <h1 id="gerard-name">Gerard Diaz Calafell</h1>
            <img src="{{ asset('img/gerard-serio.png') }}" alt="Gerard Diaz Calafell" onmouseover="playmusic(), changeImage('{{ asset('img/gerard.jpeg') }}', 'grayscale(0%)')" onmouseout="stopmusic(), changeImage('{{ asset('img/gerard-serio.png') }}', 'grayscale(100%)')">
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
    </div>
    <div>
        <a href="{{ route('about') }}" class="mt-5">Volver</a>
    </div>
    <script>
        const modal = document.getElementById('myModal-gerard');
        const btn = document.querySelector('.openModalBtn');
        const audio = document.getElementById('audio-gerard');

        function showHobby(member) {
            document.getElementById(`${member}-job`).innerText = 'Hobby: Fumar';
        }

        function showJob(member) {
            document.getElementById(`${member}-job`).innerText = 'CEO';
        }

        function playmusic() {
            audio.play();
        }

        function stopmusic() {
            audio.pause();
        }

        function changeImage(src, filter) {
            const img = event.target;
            img.src = src;
            img.style.filter = filter;
        }

        btn.onclick = function() {
            modal.style.display = 'flex';
        };

        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
                stopmusic();
            }
        };
    </script>


    <style>
        .team-container {
            margin-top: 50px;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .team-member {
            display: inline-block;
            margin: 50px;
            text-align: center;
            cursor: pointer;
        }

        .team-member img {
            filter: grayscale(100%);
            width: 400px;
            height: 400px;
            border-radius: 50%;
            transition: transform 0.3s ease-in-out;
        }

        .team-member p {
            margin: 5px 0;
            font-weight: bold;
        }

        .team-member img:hover {
            transform: scaleX(-1);
            z-index: 1;
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
        }

        .modal-content {
            max-width: 80%;
            max-height: 80%;
        }

        /* Estils per al botó que obre el modal */
        #openModalBtn {
            cursor: pointer;
            text-decoration: none;
        }

    </style>
</x-app-layout>
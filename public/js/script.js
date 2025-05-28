// Função para alterar o tema
function toggleTheme() {
    const currentTheme = localStorage.getItem('theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

    // Atualizar o tema no localStorage
    localStorage.setItem('theme', newTheme);

    // Aplicar o novo tema
    applyTheme(newTheme);
}

// Função para aplicar o tema baseado no valor do localStorage
function applyTheme(theme) {
    const body = document.body;

    if (theme === 'dark') {
        body.id = 'dark'; // Define o id 'dark' no body
    } else {
        body.id = ''; // Remove o id 'dark' do body
    }
}

// Verifica e aplica o tema armazenado ao carregar a página
document.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme') || 'light'; // Definir 'light' como padrão
    applyTheme(savedTheme);

    // Adiciona o evento de clique ao botão
    const toggleButton = document.getElementById('toggle-mode');
    toggleButton.addEventListener('click', toggleTheme);
});
 

// Dropdown

document.addEventListener('click', function(event) {
    const allDetails = document.querySelectorAll('details');
    allDetails.forEach(details => {
        if (details.hasAttribute('open') && !details.contains(event.target)) {
            details.removeAttribute('open');
        }
    });
});

// DradOrDrop 

function draggable() {
    return {
      x: 100,
      y: 100,
      offsetX: 0,
      offsetY: 0,
      isDragging: false,

      init() {
        // escuta eventos globais de mouseup e mousemove
        document.addEventListener('mousemove', (e) => this.drag(e));
        document.addEventListener('mouseup', () => this.endDrag());
      },

      startDrag(event) {
        this.isDragging = true;
        this.offsetX = event.clientX - this.x;
        this.offsetY = event.clientY - this.y;
      },

      drag(event) {
        if (this.isDragging) {
          this.x = event.clientX - this.offsetX;
          this.y = event.clientY - this.offsetY;
        }
      },

      endDrag() {
        this.isDragging = false;
      }
    };
  }


  // Mideia

document.addEventListener('DOMContentLoaded', () => {
    function formatTime(seconds) {
        const m = Math.floor(seconds / 60).toString().padStart(2, '0');
        const s = Math.floor(seconds % 60).toString().padStart(2, '0');
        return `${m}:${s}`;
    }

    // VIDEO
    const video = document.getElementById('videoPlayer');
    const videoBtn = document.getElementById('playPauseVideo');
    const videoProgress = document.getElementById('videoProgress');
    const videoTime = document.getElementById('videoTime');
    const videoVolume = document.getElementById('videoVolume');

    if (video) {
        videoBtn.addEventListener('click', () => {
            if (video.paused) {
                video.play();
                videoBtn.innerHTML = '<i class="fa fa-pause"></i>';
            } else {
                video.pause();
                videoBtn.innerHTML = '<i class="fa fa-play"></i>';
            }
        });

        video.addEventListener('timeupdate', () => {
            videoProgress.value = (video.currentTime / video.duration) * 100;
            videoTime.textContent = `${formatTime(video.currentTime)} / ${formatTime(video.duration)}`;
        });

        videoProgress.addEventListener('input', () => {
            video.currentTime = (videoProgress.value / 100) * video.duration;
        });

        videoVolume.addEventListener('input', () => {
            video.volume = videoVolume.value;
        });
    }

      // AUDIO
    const audio = document.getElementById('audioPlayer');
    const audioBtn = document.getElementById('playPauseAudio');
    const audioProgress = document.getElementById('audioProgress');
    const audioTime = document.getElementById('audioTime');
    const audioVolume = document.getElementById('audioVolume');

    if (audio) {
        audioBtn.addEventListener('click', () => {
            if (audio.paused) {
                audio.play();
                audioBtn.innerHTML = '<i class="fa fa-pause"></i>';
            } else {
                audio.pause();
                audioBtn.innerHTML = '<i class="fa fa-play"></i>';
            }
        });

        audio.addEventListener('timeupdate', () => {
            audioProgress.value = (audio.currentTime / audio.duration) * 100;
            audioTime.textContent = `${formatTime(audio.currentTime)} / ${formatTime(audio.duration)}`;
        });

        audioProgress.addEventListener('input', () => {
            audio.currentTime = (audioProgress.value / 100) * audio.duration;
        });

        audioVolume.addEventListener('input', () => {
            audio.volume = audioVolume.value;
        });
    }
});
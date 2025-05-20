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

// DradOrDro 

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
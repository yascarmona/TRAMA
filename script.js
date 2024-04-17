document.addEventListener('DOMContentLoaded', function () {
    var currentIndex = 1;
    var images = document.querySelectorAll('.carousel img');
    var interval = setInterval(nextImage, 4000); // Troca de imagem a cada 4 segundos

    // Pré-carregar todas as imagens
    images.forEach(function (image) {
        new Image().src = image.src;
    });

    function slideToLeft() {
        var currentImage = images[currentIndex];
        var nextIndex = (currentIndex + 1) % images.length;
        var nextImage = images[nextIndex];

        currentImage.style.transition = 'transform 1s ease-in-out';
        currentImage.style.transform = 'translateX(-100%)';

        setTimeout(function () {
            currentImage.style.display = 'none'; // Esconde a imagem atual após a transição
            currentImage.style.transition = ''; // Remove a transição
            currentImage.style.transform = ''; // Remove a transformação
            nextImage.style.display = 'block'; // Exibe a próxima imagem após a transição
            nextImage.style.transition = ''; // Remove a transição da próxima imagem
            currentIndex = nextIndex; // Atualiza o índice atual
        }, 1000);
    }

    function nextImage() {
        slideToLeft();
    }

    // Parar o intervalo quando o mouse passa sobre o carrossel
    document.querySelector('.carousel').addEventListener('mouseenter', function () {
        clearInterval(interval);
    });

    // Retomar o intervalo quando o mouse sai do carrossel
    document.querySelector('.carousel').addEventListener('mouseleave', function () {
        interval = setInterval(nextImage, 4000);
    });

    // Adicionando o evento de clique ao ícone de hambúrguer
    document.querySelector('.hamburger-menu').addEventListener('click', function () {
        document.querySelector('ul').classList.toggle('show'); // Ajuste aqui
        this.classList.toggle('change');
    });
});

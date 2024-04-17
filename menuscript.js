// Adicionando o evento de clique ao ícone de hambúrguer
document.querySelector('.hamburger-menu').addEventListener('click', function () {
    document.querySelector('ul').classList.toggle('show'); 
    this.classList.toggle('change');
});

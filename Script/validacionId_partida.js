function validacion() {

    const crearPartida = document.getElementById('crearPartida');
    const unirsePartida = document.getElementById('unirme');
    const id_partida = document.getElementById('id_partida');
    const id_partidaError = document.getElementById('id_partidaError');

    id_partida.addEventListener('blur', function(event) {
        if (id_partida.value == '') {
            id_partidaError.classList.add('active');
            showError();
        } else {
            id_partidaError.textContent = '';
            id_partidaError.classList.remove('active');
        }
    });



    crearPartida.addEventListener('click', function(event) {
        console.log(id_partida.value);
        if (id_partida.value == '') {
            showError();
            event.preventDefault();
        }
    });

    unirsePartida.addEventListener('click', function(event) {
        if (id_partida.value == '') {
            showError();
            event.preventDefault();
        }
    });

    function showError() {
        //if (id_partida.validity.valueMissing) {
        id_partidaError.textContent = 'Debe introducir un código para la partida.';
        //}
    }
}
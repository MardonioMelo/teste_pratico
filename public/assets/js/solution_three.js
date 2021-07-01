$(document).ready(function () {

    const j_tab_matriz = $("#j_tab_matriz")
    const j_tab_matriz_impar = $("#j_tab_matriz_impar")
    const j_tab_matriz_par = $("#j_tab_matriz_par")

    //Computar matriz
    $('#j_gerar_matriz').on("click", function (event) {

        let n_max = $("[name=n_max]")
        let valid = true

        if (n_max.val() === "" || Number(n_max.val().replace(".","")) <= 5) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops!!!',
                text: 'Informe um número qualquer maior que 5 para gerar a matriz.'
            })
            valid = false
        }

        if (valid) {
            $.ajax({
                type: "POST",
                url: "three/matriz",
                data: { "n_max": n_max.val() },
                dataType: "JSON",
                success: function (response) {
                    if (response.result) {

                        //Imprimir valores da matriz
                        j_tab_matriz.html('');
                        response.error.matriz.forEach(function (value, index) {
                            j_tab_matriz.append(lineTab(index, value))
                        })

                        //Imprimir valores ímpares da matriz
                        j_tab_matriz_impar.html('');
                        response.error.matriz_impar.forEach(function (value, index) {
                            j_tab_matriz_impar.append(lineTab(index, value))
                        })

                        //Imprimir valores pares da matriz
                        j_tab_matriz_par.html('');
                        response.error.matriz_par.forEach(function (value, index) {
                            j_tab_matriz_par.append(lineTab(index, value))
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!!!',
                            text: "Não foi possível gerar a matriz."
                        })
                    }
                }
            });
        }

        return false
    })

    //Função para povoar linha padrão da tabela
    function lineTab(index, num) {
        return '<tr>' +
            '<td class="table-active">' + (Number(index)+1) + '</td>' +
            '<td>' + num[0] + '</td>' +
            '<td>' + num[1] + '</td>' +
            '<td>' + num[2] + '</td>' +
            '<td>' + num[3] + '</td>' +
            '<td>' + num[4] + '</td>' +
            '</tr>'
    }

})
$(document).ready(function () {

    //Computar matriz
    $('#j_gerar_matriz').on("click", function (event) {

        let n_matriz = $("[name=n_matriz]")
        let valid = true

        if (n_matriz.val() === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Oops!!!',
                text: 'Informe um número qualquer para gerar a matriz.'
            })
            valid = false
        }

        if (valid) {
            $.ajax({
                type: "POST",
                url: "three/matriz",
                data: { "n_matriz": n_matriz.val() },
                dataType: "JSON",
                success: function (response) {
                    if (response.result) {

                       
                       
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

})
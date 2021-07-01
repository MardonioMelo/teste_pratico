$(document).ready(function () {

    const j_history = $('#j_history')

    //Cadastro de alturas
    $('#j_create').on("click", function (event) {

        let chico = $("[name=chico]")
        let juca = $("[name=juca]")
        let valid = true

        if (chico.val() === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Oops!!!',
                text: 'Informe a altura do Chico.'
            })
            valid = false
        }

        if (juca.val() === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Oops!!!',
                text: 'Informe a altura do Juca.'
            })
            valid = false
        }

        if (valid) {
            $.ajax({
                type: "POST",
                url: "one/create",
                data: { "chico": chico.val(), "juca": juca.val() },
                dataType: "JSON",
                success: function (response) {
                    if (response.result) {

                        if ($('#j_history td').length === 0) {
                            $(j_history).html('')
                        }

                        j_history.prepend(lineHistory(response.result, chico.val(), juca.val(), response.estimativa)).fadeIn('slow');
                        chico.val('')
                        juca.val('')
                        deleteCadastro()

                        Swal.fire({
                            icon: 'success',
                            title: 'Sucesso!',
                            text: response.error
                        })

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!!!',
                            text: response.error
                        })
                    }
                }
            });
            
        }

        return false
    })

    //Atualizar lista
    $('#j_refresh').on("click", function (event) {
        readHistory(10, 0)
    })

    //Excluir cadastros
    function deleteCadastro() {

        $(".j_delete").on("click", function () {

            let cad = Number($(this)[0].dataset.id)

            if (cad > 0) {
                $.ajax({
                    type: "POST",
                    url: "one/delete",
                    data: { "cad": cad },
                    dataType: "JSON",
                    success: function (response) {
                        if (response.result) {

                            $('#tr_' + cad).remove();

                            Swal.fire({
                                icon: 'success',
                                title: 'Sucesso!',
                                text: response.error
                            })

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops!!!',
                                text: response.error
                            })
                        }
                    }
                });
            }
        })
    }

    //html de uma linda da tabela do histórico 
    function lineHistory(num, chico, juca, estimativa) {
        return "<tr id='tr_" + num + "'>" +
            "<th scope='row'>" + num + "</th>" +
            "<td>" + chico + " m</td>" +
            "<td>" + juca + " m</td>" +
            "<td>" + estimativa + " anos</td>" +
            "<td class='bd-example'>" +
            "<button type='button' data-id='" + num + "' class='btn btn-outline-danger btn-sm j_delete'><i class='fa fa-trash'></i> Excluir</button>" +
            "</td>" +
            "</tr>";
    }

    //html de uma linda da tabela do histórico 
    function lineHistoryEmpty(msg) {
        return "<tr class='text-center'><th scope='row' colspan='5' >" + msg + "</th></tr>";
    }

    //Consultar histórico de estimativas
    function readHistory(limit, offset) {
        let lines;
        $(j_history).html(lineHistoryEmpty('<i class="fa fa-spin fa-2x fa-sync"></i>'));
        $.ajax({
            type: "POST",
            url: "one/read",
            data: { "limit": limit, "offset": offset },
            dataType: "JSON",
            success: function (response) {
                if (response.result) {
                    let order_arr = response.result.sort();
                    order_arr.forEach(function (value) {
                        lines += lineHistory(
                            value.altura_id,
                            cmToMetro(value.altura_chico),
                            cmToMetro(value.altura_juca),
                            value.altura_estimativa
                        )
                    })
                    setTimeout(function () {
                        $(j_history).html(lines).fadeIn("Slow")
                        deleteCadastro()
                    }, 1000);

                } else {
                    $(j_history).html(lineHistoryEmpty(response.error))
                }
            }
        });
    }

    //Formata cm para metro
    function cmToMetro(c) {
        return String(c / 100).replace(".", ",")
    }

    readHistory(10, 0)
})
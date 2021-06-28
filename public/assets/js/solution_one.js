
$('#j_create').on("click", function (event) {

    var chico = $("[name=chico]").val()
    var juca = $("[name=juca]").val()
    var valid = true
    var j_history = $('#j_history')

    if (chico === "") {

        Swal.fire({
            icon: 'warning',
            title: 'Oops!!!',
            text: 'Informe a altura do Chico.'
        })
        valid = false
    }

    if (juca === "") {

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
            data: { "chico": chico, "juca": juca },
            dataType: "JSON",
            success: function (response) {

                if (response.result) {

                    j_history.append(lineHistory(response.result, chico, juca, response.estimativa))

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

function lineHistory(num, chico, juca, estimativa) {
    return "<tr>" +
        "<th scope='row'>" + num + "</th>" +
        "<td>" + chico + "cm</td>" +
        "<td>" + juca + "cm</td>" +
        "<td>" + estimativa + " anos</td>" +
        "</tr>";
}
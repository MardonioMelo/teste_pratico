$(document).ready(function () {

    // ---------Dados simulando uma API---------//
    const data_api = {
        "user": [
            {
                "id": 1,
                "name": "Marcelo Silva",
                "type": 1
            },
            {
                "id": 2,
                "name": "Rui Prado",
                "type": 1
            },
            {
                "id": 3,
                "name": "Ísis Alves",
                "type": 1
            },
            {
                "id": 4,
                "name": "Ramyla Raquel",
                "type": 2
            },
            {
                "id": 5,
                "name": "Mardônio Melo",
                "type": 2
            },
            {
                "id": 6,
                "name": "Marilene Lima",
                "type": 2
            }
        ],
        "type": [
            {
                "id": 1,
                "desc": "Professor",
                "loan_time": 10
            },
            {
                "id": 2,
                "desc": "Aluno",
                "loan_time": 3
            }
        ],
        "book": [
            {
                "id": 1,
                "title": "Código limpo: Hab. práticas do Agile Software",
                "img": "cod-limpo.jpg"
            },
            {
                "id": 2,
                "title": "Test-Driven Development",
                "img": "livro-tdd.jpeg"
            },
            {
                "id": 3,
                "title": "A Bíblia Sagrada",
                "img": "biblia.jpg"
            }
        ]
    };

    // --------------- App ------------------ //

    //Inputs
    const j_type_select = $("#j_type_select")
    const j_user_select = $("#j_user_select")
    const j_book_select = $("#j_book_select")
    const j_gerar_recibo = $("#j_gerar_recibo")
    //Recibo
    const j_recibo_type = $("#j_recibo_type")
    const j_recibo_user = $("#j_recibo_user")
    const j_recibo_book = $("#j_recibo_book")
    const j_recibo_loan_time = $("#j_recibo_loan_time")
    const j_recibo_date = $("#j_recibo_date")
    const j_recibo_img = $("#j_recibo_img")


    j_type_select.on("change", function () {
        loadUser(j_type_select.val())
    })

    j_gerar_recibo.on("click", function () {
        let check = true

        if (j_type_select.val() == null) {
            Swal.fire({
                icon: 'error',
                title: 'Oops!!!',
                text: "Selecione o tipo de usuário para gerar o recibo!"
            })
            check = false
        }

        if (j_user_select.val() == null) {
            Swal.fire({
                icon: 'error',
                title: 'Oops!!!',
                text: "Selecione o usuário para gerar o recibo!"
            })
            check = false
        }

        if (j_book_select.val() == null) {
            Swal.fire({
                icon: 'error',
                title: 'Oops!!!',
                text: "Selecione o livro para gerar o recibo!"
            })
            check = false
        }

        if (check) {

            let dataAtual = new Date();
            let dia = dataAtual.getDate();
            let mes = (dataAtual.getMonth() + 1);
            let ano = dataAtual.getFullYear();
            let horas = dataAtual.getHours();
            let minutos = dataAtual.getMinutes();
            let data_emp = ("00" + dia).slice(-2)  + "/" + ("00" + mes).slice(-2) + "/" + ano + " " + ("00" + horas).slice(-2) + ":" + ("00" + minutos).slice(-2) + "h."

            j_recibo_date.html(data_emp)

            data_api.book.forEach(function (value) {
                if (j_book_select.val() == value.id) {
                    j_recibo_book.html(value.title)
                    j_recibo_img.attr("src", j_recibo_img[0].dataset.path + value.img)
                }
            })

            data_api.user.forEach(function (value) {
                if (j_user_select.val() == value.id) {
                    j_recibo_user.html(value.name)
                }
            })

            data_api.type.forEach(function (value) {
                if (j_type_select.val() == value.id) {
                    j_recibo_type.html(value.desc)

                    let d = new Date();                      
                    d.setDate(d.getDate() + value.loan_time);

                    let dia = d.getDate();
                    let mes = (d.getMonth() + 1);
                    let ano = d.getFullYear();

                    j_recibo_loan_time.html( ("00" + dia).slice(-2)  + "/" + ("00" + mes).slice(-2) + "/" + ano)
                }
            })

            window.scrollTo($("#j_div_print").offset());

        }

        return false
    })


    //Função para carregar os tipos de usuário
    function loadTypeUser(types) {
        let options = " <option selected disabled>Selecione</option>"

        types.forEach(function (value) {
            options += '<option value="' + value.id + '">' + value.desc + '</option>';
        })
        j_type_select.html(options)
    }

    //Função para carregar os tipos de usuário
    function loadUser(types_id) {
        let options = " <option selected disabled>Selecione</option>"

        data_api.user.forEach(function (value) {
            if (types_id == value.type) {
                options += '<option value="' + value.id + '">' + value.name + '</option>';
            }
        })
        j_user_select.html(options)
    }

    //Função para carregar os tipos de usuário
    function loadBook(books) {
        let options = " <option selected disabled>Selecione</option>"

        books.forEach(function (value) {
            options += '<option value="' + value.id + '">' + value.title + '</option>';
        })
        j_book_select.html(options)
    }


    //Init
    loadTypeUser(data_api.type)
    loadBook(data_api.book);
})
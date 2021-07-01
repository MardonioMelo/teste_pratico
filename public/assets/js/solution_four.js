$(document).ready(function () {

    const j_fibonacci_seq = $("#j_fibonacci_seq")
    const j_fibonacci_text = $("#j_fibonacci_text")
    const j_fibonacci_send = $("#j_fibonacci_send")
    const j_fibonacci_text_desc = $("#j_fibonacci_text_desc")

    //Check numbers Fibonacci
    j_fibonacci_send.on("click", function (event) {

        let seq_numbers = $("[name=n_numbers]")
        let valid = true

        if (seq_numbers.val() === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Oops!!!',
                text: 'Informe um mais números separados por virgula para verificar se fazem parte da sequência Fibonacci.'
            })
            valid = false
        }

        if (valid) {
            $.ajax({
                type: "POST",
                url: "four/fibonacci",
                data: { "seq_numbers": seq_numbers.val() },
                dataType: "JSON",
                success: function (response) {
                    if (response.result) {
                        //Imprimir os números válidos                 
                        j_fibonacci_seq.html(response.error.seq)
                        //Imprimir o texto                 
                        j_fibonacci_text.html(response.error.text)
                        //Imprimir o texto de descrição                
                        j_fibonacci_text_desc.html(response.error.text_desc)

                    } else {
                        //Imprimir os números válidos                 
                        j_fibonacci_seq.html("")
                        //Imprimir o texto                 
                        j_fibonacci_text.html(response.error.text)
                        //Imprimir o texto de descrição                
                        j_fibonacci_text_desc.html("")
                    }
                }
            });
        }

        return false
    })
})
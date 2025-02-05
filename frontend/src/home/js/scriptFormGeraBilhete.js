$(document).ready(function () {
    // Envia o formulário de login com AJAX
  
    $("#bilheteForm").submit(function (event) {
       
        event.preventDefault(); 
        var name = $("#nome").val();
        var quantidadeDezenas = $("#quantidadeDezenas").val();
        var quantidadeBilhete = $("#quantidadeBilhete").val();
       
        if (!name || !quantidadeDezenas || !quantidadeBilhete) {
            mostrarMensagem("⚠️ Por favor, preencha todos os campos.", "#fff3cd", "#856404", "#ffeeba");
            return;
        }

        
        $.ajax({
            url: "http://localhost:8080/index.php/api/generate_ticket", // URL da API de login
            method: "POST",
            dataType: "json", 
            contentType: "application/json", 
            data: JSON.stringify({
                tripulante: name,
                quantidade_dezenas: quantidadeDezenas,
                quantidade_bilhetes: quantidadeBilhete,
            }),
            success: function (data) {
             
                console.log('Retorno da api',data);
                if (data.status === 200) {
                    $("#nome").val('');
                    $("#quantidadeDezenas").val('');
                    $("#quantidadeBilhete").val('');

                    mostrarMensagem("🎉 Bilhete gerado com sucesso!", "#d4edda", "#155724", "#c3e6cb");
                   
                } else {
                  
                    $("#nome").val('');
                    $("#quantidadeDezenas").val('');
                    $("#quantidadeBilhete").val('');
                }
            },
            error: function (xhr, status, error) {
                mostrarMensagem("❌ Erro ao conectar com a API. Tente novamente.", "#f8d7da", "#721c24", "#f5c6cb");
            }
        });
    });
});

function mostrarMensagem(mensagem, bgColor, textColor, borderColor) {
    $("#mensagemSucesso").hide().html(mensagem).css({
        "background": bgColor,
        "color": textColor,
        "border": `1px solid ${borderColor}`
    }).fadeIn();

    // Esconde a mensagem após 5 segundos
    setTimeout(function () {
        $("#mensagemSucesso").fadeOut();
    }, 3000);
}
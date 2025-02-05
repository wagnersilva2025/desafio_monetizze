$(document).ready(function () {
    // Envia o formulário de login com AJAX
    $("#login-form").submit(function (event) {
        event.preventDefault(); // Evita o envio normal do formulário

        // Obtém os dados do formulário
        var name = $("#login-name").val();
        var password = $("#login-password").val();

        // Verifica se os campos estão preenchidos
        if (!name || !password) {
            alert("Por favor, preencha todos os campos.");
            return;
        }

        // Envia os dados via AJAX
        $.ajax({
            url: "http://localhost:8080/index.php/api/user_auth", // URL da API de login
            method: "POST",
            dataType: "json", // O tipo de resposta esperada é JSON
            contentType: "application/json", // O conteúdo enviado será em JSON
            data: JSON.stringify({
                name: name,
                password: password
            }),
            success: function (data) {
                // Processa a resposta da API
                console.log('Retorno da api',data);
                if (data.status === 200) {
                  
                    mostrarMensagem("✅ Login bem-sucedido! Redirecionando...", "#d4edda", "#155724", "#c3e6cb");
                            setTimeout(() => { window.location.href = "src/home"; }, 2000);
                } else {
                    alert(data); // Exibe a mensagem de erro
                }
            },
            error: function (xhr, status, error) {
                // Caso haja algum erro na requisição
                alert("Erro ao conectar com a API. Tente novamente.");
            }
        });
    });
});
function mostrarMensagem(mensagem, bgColor, textColor, borderColor) {
    $("#mensagem").hide().html(mensagem).css({
        "background": bgColor,
        "color": textColor,
        "border": `1px solid ${borderColor}`
    }).fadeIn();

    setTimeout(() => { $("#mensagem").fadeOut(); }, 5000);
}
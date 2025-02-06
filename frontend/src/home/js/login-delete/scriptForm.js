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
            dataType: "text", // O tipo de resposta esperada é JSON
            contentType: "application/json", // O conteúdo enviado será em JSON
            data: JSON.stringify({
                name: name,
                password: password
            }),
            success: function (data) {
                // Processa a resposta da API
                console.log('Retorno da api',data);
                if (data.status === 200) {
                    alert(data.message); // Login bem-sucedido
                    // Aqui você pode redirecionar o usuário ou armazenar um token
                    window.location.href = "/dashboard"; // Exemplo de redirecionamento
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

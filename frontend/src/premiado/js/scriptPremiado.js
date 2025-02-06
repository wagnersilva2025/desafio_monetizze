$(document).ready(function () {
   
    getAllBilhetes();
});

function getAllBilhetes() {
    $.ajax({
        url: "http://localhost:8080/index.php/api/list_winner", 
        method: "GET",
        dataType: "json",
        success: function (data) {
            console.log('Retorno da API:', data);

            if (data.status === 200) {
                const tabelaBody = $(".tabela tbody"); 
                tabelaBody.empty(); 
               let iconePremiado = '🏆';
                $("#tabela").show();
                data.data.forEach((bilhete, index) => {
                   
                    let row = `
                        <tr>
                            <td>${bilhete.id}</td>
                            <td>${iconePremiado}${bilhete.dezenas}</td>
                            <td>${bilhete.tripulante}</td>
                            <td>Sorteado</td>
                        </tr>
                    `;
                    tabelaBody.append(row);
                });
            } else {
                mostrarMensagem("❌ Nenhum bilhete encotrado.", "#f8d7da", "#721c24", "#f5c6cb");
               
            }
        },
        error: function (xhr, status, error) {
            alert("Erro ao conectar com a API. Tente novamente.");
        }
    });
}

function mostrarMensagem(mensagem, bgColor, textColor, borderColor) {
    $("#mensagemSucesso").hide().html(mensagem).css({
        "background": bgColor,
        "color": textColor,
        "border": `1px solid ${borderColor}`
    }).fadeIn();

    setTimeout(function () {
        $("#mensagemSucesso").fadeOut();
    }, 3000);
}
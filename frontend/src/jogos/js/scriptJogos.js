$(document).ready(function () {
 
    getAllBilhetes();
});

function getAllBilhetes() {
    $.ajax({
        url: "http://localhost:8080/index.php/api/all_bets", 
        method: "GET",
        dataType: "json",
        success: function (data) {
            console.log('Retorno da API:', data);

            if (data.status === 200) {
                const tabelaBody = $(".tabela tbody"); 
                tabelaBody.empty(); 
                $("#tabela").show();
                let iconePremiado = '';
                data.data.forEach((bilhete, index) => {
                    let textoPremiado = '';
                    let textoStatus = 'Aguardando';
                   if(bilhete.premiado == 1){
                    textoStatus = "Bilhete premiado";
                    iconePremiado = '🏆';
                   }
                   if(bilhete.premiado != 1 && bilhete.sorteio_id != null){
                    textoStatus = "Sorteio efetuado";
                    iconePremiado = '';
                   }
                    let row = `
                        <tr>
                            <td>${bilhete.id}</td>
                            <td>${iconePremiado}${bilhete.dezenas}</td>
                            <td>${bilhete.tripulante}</td>
                            <td>${textoStatus}</td>
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
$(document).ready(function () {
    
    $(".btn").click(function () {
        $(".spinner").show(); 
        $.ajax({
            url: "http://localhost:8080/index.php/api/drawWinner", 
            method: "GET",
            dataType: "json",
            success: function (response) {
                $(".spinner").hide(); 
                if (response.status === 200) {
                    let numeros = response.numeros_sorteados.join(", ");
                    let vencedor = response.bilhete_vencedor;
                    let idSorteio = response.id_sorteio
                    alert(idSorteio);
                    fromToBets(idSorteio);
                    let vencedorHTML = `
                        <h2>🏆 Bilhete Premiado 🏆</h2>
                        <p class="numerosSorteados">🎟️ Números Sorteados: ${numeros}</p>
                        <p class="vencedor">👤 Ganhador: ${vencedor.tripulante}</p>
                        <p class="vencedor">📌 ID do Bilhete: ${vencedor.id}</p>
                         <p class="vencedor">👤 Números no bilhete: ${response.bilhete_vencedor.dezenas}</p>
                    `;

                    $(".containerData").html(vencedorHTML).fadeIn();
                } else {
                    $(".containerData").html(`<h2>Não existe aposta para o sorteio! 🎟️</h2><span><a href="http://localhost:8081/src/home">Gerar Bilhete</a></span>`).fadeIn();
                }
            },
            error: function () {
                $(".spinner").hide(); 
                alert("Erro ao conectar com a API. Tente novamente.");
            }
        });
    });

});

function fromToBets(idSorteio){

    $.ajax({
        url: "http://localhost:8080/index.php/api/list_bets_prize_draw", // Atualize com o endpoint correto
        method: "POST",
        dataType: "json",
        data: JSON.stringify({
            idsorteio: idSorteio,
        }),
        success: function (data) {
            console.log('Retorno da API:', data);

            if (data.status === 200) {
                const tabelaBody = $(".tabela tbody"); // Seleciona o <tbody>
                tabelaBody.empty(); // Limpa o conteúdo da tabela antes de preencher
                $("#tabela").show();
    
                let numeroSorteado = data.data[0].dezenas_sorteada.split(",").map(num => num.trim());
                data.data.forEach((bilhete, index) => {
                    let numeroBilhete = bilhete.dezenas.split(",").map(num => num.trim());
                    let iconePremiado = '';
                    let textoStatus = 'Aguardando';
                   if(bilhete.premiado == 1){
                    textoStatus = "Bilhete premiado";
                    iconePremiado = '🏆';
                   }
                   if(bilhete.premiado != 1 && bilhete.sorteio_id != null){
                    textoStatus = "Sorteio efetuado"
                   }

                   let dezenasHTML = numeroBilhete.map(num => {
                    let classe = numeroSorteado.includes(num) ? "sorteado" : "naosorteado";
                    return `<span class="${classe}">${num}</span>`;
                    }).join(", "); // Junta os spans separados por vírgula
                    let row = `
                        <tr>
                            <td>${bilhete.id}</td>
                            <td>${iconePremiado}${dezenasHTML}</td>
                            <td>${bilhete.tripulante}</td>
                            <td>${textoStatus}</td>
                        </tr>
                    `;
                    tabelaBody.append(row);
                });
            } else {
                mostrarMensagem("❌ Nenhum bulhete encotrado.", "#f8d7da", "#721c24", "#f5c6cb");
               
            }
        },
        error: function (xhr, status, error) {
            alert("Erro ao conectar com a API. Tente novamente.");
        }
    });
}

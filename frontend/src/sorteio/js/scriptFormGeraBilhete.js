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

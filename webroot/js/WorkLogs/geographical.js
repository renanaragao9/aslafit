function formatarCep(input) {
    let cep = input.value.replace(/\D/g, "");
    if (cep.length > 5) {
        cep = cep.replace(/^(\d{5})(\d{1,3})/, "$1-$2");
    }
    input.value = cep;
}

async function buscarPorCep(cep) {
    const errorSpan = document.getElementById("cep-error");
    errorSpan.style.display = "none";
    errorSpan.textContent = "";
    cep = cep.replace(/\D/g, "");
    if (cep.length !== 8) {
        errorSpan.textContent = "CEP inválido. Formato esperado: 00000-000";
        errorSpan.style.display = "block";
        return;
    }
    try {
        const viaCepResponse = await fetch(
            `https://viacep.com.br/ws/${cep}/json/`
        );
        const viaCepData = await viaCepResponse.json();
        if (viaCepData.erro) {
            errorSpan.textContent = "CEP não encontrado.";
            errorSpan.style.display = "block";
            return;
        }
        const endereco = `${viaCepData.logradouro}, ${viaCepData.bairro}, ${viaCepData.localidade} - ${viaCepData.uf}`;
        document.getElementById("log_address").value = endereco;
        const agora = new Date();
        document.getElementById("log_date").value = agora
            .toISOString()
            .slice(0, 10);
        document.getElementById("log_time").value = agora
            .toTimeString()
            .slice(0, 5);
        const encodedAddress = encodeURIComponent(endereco);
        const nominatimResponse = await fetch(
            `https://nominatim.openstreetmap.org/search?q=${encodedAddress}&format=json&limit=1`
        );
        const result = await nominatimResponse.json();
        if (result.length > 0) {
            document.getElementById("latitude").value = parseFloat(
                result[0].lat
            ).toFixed(6);
            document.getElementById("longitude").value = parseFloat(
                result[0].lon
            ).toFixed(6);
        } else {
            document.getElementById("latitude").value = "";
            document.getElementById("longitude").value = "";
        }
    } catch (error) {
        errorSpan.textContent = "Erro ao buscar endereço.";
        errorSpan.style.display = "block";
        console.error("Erro ao buscar dados por CEP:", error);
    }
}

function registrarPontoGPS() {
    if (!navigator.geolocation) {
        alert("Geolocalização não é suportada por este navegador.");
        return;
    }
    navigator.geolocation.getCurrentPosition(
        async (position) => {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            document.getElementById("latitude").value = lat.toFixed(6);
            document.getElementById("longitude").value = lon.toFixed(6);
            const agora = new Date();
            document.getElementById("log_date").value = agora
                .toISOString()
                .slice(0, 10);
            document.getElementById("log_time").value = agora
                .toTimeString()
                .slice(0, 5);
            try {
                const response = await fetch(
                    `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`
                );
                const data = await response.json();
                document.getElementById("log_address").value =
                    data.display_name || "Endereço não encontrado";
            } catch (error) {
                console.error("Erro ao buscar endereço:", error);
                document.getElementById("log_address").value =
                    "Erro ao obter endereço";
            }
        },
        (error) => {
            const errorSpan = document.getElementById("cep-error");
            errorSpan.textContent =
                "Erro ao obter localização: " + error.message;
            errorSpan.style.display = "block";
        },
        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0,
        }
    );
}

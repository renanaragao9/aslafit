function openImageModal(src, title = "Visualização da imagem") {
    document.getElementById("modalImage").src = src;
    document.getElementById("imageModalTitle").textContent = title;
    $("#reusableImageModal").modal("show");
}

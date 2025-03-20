function openImageModal(imageUrl) {
    document.getElementById("modalImage").src = imageUrl;
    $("#imageModal").modal("show");
}

function openGifModal(gifUrl) {
    document.getElementById("modalGif").src = gifUrl;
    $("#gifModal").modal("show");
}

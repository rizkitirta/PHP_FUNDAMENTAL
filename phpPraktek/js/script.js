const tombolCari = document.querySelector('.tombol-cari');
const keyword = document.querySelector('.keyword');
const container = document.querySelector('.container');


keyword.addEventListener('keyup', function()  {
	fetch('ajax/ajax_cari.php?keyword=' + keyword.value)
	.then((response) => response.text())
	.then((response) => (container.innerHTML = response))
});

function previewImage() {

	const gambar = document.querySelector('.gambar');
	const imgPreview = document.querySelector('.img-preview');

	const oFReader = new FileReader();
	oFReader.readAsDataURL(gambar.files[0]);

	oFReader.onload = function (oFREvent) {
		imgPreview.src = oFREvent.target.result;
	};
}

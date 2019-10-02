const school_yn = document.getElementById("school_yn");
const pendamping = document.getElementById("pendamping");

school_yn.addEventListener("click", function () {
	pendamping.classList.toggle("display-none");
});

const agree = document.getElementById("agree");
const daftar = document.getElementById("daftar");

agree.addEventListener("click", function () {
	daftar.disabled = !daftar.disabled;
});

function tambahPeserta() {
	let table = document.getElementById("peserta");
	let rowCount = table.rows.length;
	let row = table.insertRow(rowCount);
	let cell1 = row.insertCell(0);
	let cell2 = row.insertCell(1);
	let cell3 = row.insertCell(2);
	let cell4 = row.insertCell(3);
	let cell5 = row.insertCell(4);
	cell1.innerHTML = "<input type='text' name='jenjangA[]' class='form-control' placeholder='Masukkan Jenjang Pendidikan' style='text-transform:uppercase;'>";
	cell2.innerHTML = "<input type='text' name='namaA[]' class='form-control' placeholder='Masukkan Nama Universitas'>";
	cell3.innerHTML = "<input type='text' name='namaJ[]' class='form-control' placeholder='Masukkan Jurusan'>";
	cell4.innerHTML = "<input type='text' name='namaK[]' class='form-control' placeholder='Masukkan Nama Kota'>";
	cell5.innerHTML = "<input type='text' name='nilai[]' class='form-control desimal' placeholder='Masukkan Nilai Akhir'>";
}

let no_peserta = document.getElementById("no_peserta"),
	count = 1;
// no_peserta.onclick = function () {
// 	count += 1;
// 	no_peserta.innerHTML = "Click me: " + count;
// };

function tambahPeserta2() {
	const peserta = document.getElementById("peserta");
	count += 1;
	if (count <= 12) {
		peserta.innerHTML += '' +
			'<div class="col-lg-4 p-2">' +

			'<div class="card p-2">' +
			'<p class="text-center text-gray-900 m-0 pb-2">Peserta ' + count + '</p>' +
			'<div class="custom-file mb-1 hover">' +
			'<input type="file" class="custom-file-input" id="image[]" name="image[]" accept="image/*">' +
			'<label for="image[]" class="custom-file-label">Pas foto</label>' +
			'</div>' +
			'<div class="custom-file">' +
			'<input type="file" class="custom-file-input" id="card[]" name="card[]" accept="image/*">' +
			'<label for="card[]" class="custom-file-label">Kartu pelajar/KTP</label>' +
			'</div>' +
			'<div class="form-group row mb-0 pt-2">' +
			'<div class="col-sm-3 text-gray-900 mb-sm-0 mt-1">' +
			'<label for="name[]">Nama</label>' +
			'</div>' +
			'<div class="col-sm-9 text-gray-900">' +
			'<input type="text" class="form-control" id="name[]" name="name[]">' +
			'</div>' +
			'</div>' +
			'</div>' +

			'</div>';
	}
}

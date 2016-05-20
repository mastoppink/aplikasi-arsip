// JavaScript Document
function reqLogin(){
	var nip = $('#nip').val();
	var password = $('#pass').val()
	
	
	if(nip == "" || password=="")
	{
		$('#msg').html('Form Tidak Lengkap.');
		$('#nip').focus();
		
		$("#msg").show();
		
		setTimeout(function(){
      	$("#msg").hide();        
  		}, 5000);
	}
	else
	{
		$.ajax({
			type: 'POST',
			url:"httpResponse/loginProses.php",
			data:{ user : nip, pass: password},
			success: function(data){
				if(data=='ok'){
					window.location.replace("/newarsip/main.php");
				}else
				{
					$('#msg').html(data);
					$('#nip').focus();
					
					$("#msg").show();
					
					setTimeout(function(){
					$("#msg").hide();        
					}, 5000);
				}
			}
		});
	}
}

// Ajax Masukan Berkas
function mbLeft(){
	$.ajax({
			url:"httpResponse/masukanBerkas/kiri.php",
			beforeSend: function(){
				$('#load').show();
				},
			success: function(data){
				$('#load').hide();
				$('#leftContent').removeData();
				$('#leftContent').html(data);
			}
	});
}

function mbRight(){
	$.ajax({
			url:"httpResponse/masukanBerkas/kanan.php",
			beforeSend: function(){
				$('#load').show();
				},
			success: function(data){
				$('#load').hide();
				$('#rightContent').removeData();
				$('#rightContent').html(data);
			}
	});
}


function pilihRak(id)
{
	$.ajax({
			method: "POST",
			url:"httpResponse/masukanBerkas/kanan.php",
			data: {
				opt: '1', shelfId: id},
			beforeSend: function(){
				$('#load').show();
				},
			success: function(data){
				$('#load').hide();
				$('#rightContent').removeData();
				$('#rightContent').html(data);
			}
	});
}

function pilihBox(id)
{
	$.ajax({
			method: "POST",
			url:"httpResponse/masukanBerkas/kanan.php",
			data: {
				opt: '2', boxId: id},
			beforeSend: function(){
				$('#load').show();
				},
			success: function(data){
				$('#load').hide();
				$('#rightContent').removeData();
				$('#rightContent').html(data);
			}
	});
}


// END Ajax Masukan Berkas

//Ajax Peminjaman
function pemLeft(){
	$.ajax({
			url:"httpResponse/peminjaman/kiri.php",
			beforeSend: function(){
				$('#load').show();
				},
			success: function(data){
				$('#load').hide();
				$('#leftContent').removeData();
				$('#leftContent').html(data);
			}
	});
}

function pemRight(){
	$.ajax({
			url:"httpResponse/peminjaman/kanan.php",
			beforeSend: function(){
				$('#load').show();
				},
			success: function(data){
				$('#load').hide();
				$('#rightContent').removeData();
				$('#rightContent').html(data);
			},
			error: function(xhr, status){
				$('#load').hide();
				$('#rightContent').html(status);
			}
	});
}




//END peminjaman

// Ajax Pencarian
function peLeft(){
	$.ajax({
			url:"httpResponse/pencarian/kiri.php",
			beforeSend: function(){
				$('#load').show();
				},
			success: function(data){
				$('#load').hide();
				$('#leftContent').removeData();
				$('#leftContent').html(data);
			}
	});
}

function peRight(){
	$.ajax({
			url:"httpResponse/pencarian/kanan.php",
			beforeSend: function(){
				$('#load').show();
				},
			success: function(data){
				$('#load').hide();
				$('#rightContent').removeData();
				$('#rightContent').html(data);
			},
			error: function(xhr, status){
				$('#load').hide();
				$('#rightContent').html(status);
			}
	});
}

function hasilCari()
{
	var searchValue = $('#searchVal').val();
	$('#rightContent').removeData();
	$('#rightContent').load("httpResponse/pencarian/kanan.php",{searchVal: searchValue});
	
}

//END AJax Pencarian

// AJax Lihat Rak
function lrLeft(){
	$.ajax({
			url:"httpResponse/lihatRak/kiri.php",
			beforeSend: function(){
				$('#load').show();
				},
			success: function(data){
				$('#load').hide();
				$('#leftContent').removeData();
				$('#leftContent').html(data);
			}
	});
}

function lrRight(){
	$.ajax({
			url:"httpResponse/lihatRak/kanan.php",
			beforeSend: function(){
				$('#load').show();
				},
			success: function(data){
				$('#load').hide();
				$('#rightContent').removeData();
				$('#rightContent').html(data);
			},
			error: function(xhr, status){
				$('#load').hide();
				$('#rightContent').html(status);
			}
	});
}


// END Lihat Rak

// Ajax Alat

function alLeft(){
	$.ajax({
			url:"httpResponse/alat/kiri.php",
			beforeSend: function(){
				$('#load').show();
				},
			success: function(data){
				$('#load').hide();
				$('#leftContent').removeData();
				$('#leftContent').html(data);
			}
	});
}

function alRight(){
	$.ajax({
			url:"httpResponse/alat/kanan.php",
			beforeSend: function(){
				$('#load').show();
				},
			success: function(data){
				$('#load').hide();
				$('#rightContent').removeData();
				$('#rightContent').html(data);
			},
			error: function(xhr, status){
				$('#load').hide();
				$('#rightContent').html(status);
			}
	});
}

function tampilkanManajemenUser()
{
	$('#rightContent').load('httpResponse/alat/kanan.php',{opt: "1"});
}
function tampilkanManajemenRak()
{
	$('#rightContent').load('httpResponse/alat/kanan.php',{opt: "2"});
}
function tampilkanManajemenBerkas()
{
	$('#rightContent').load('httpResponse/alat/kanan.php',{opt: "3"});
}


function masukanUser()
{
	
	var idVal = $('#nipNew').val();
	var namaVal = $('#namaNew').val();
	var passwordVal = $('#passwordNew').val();
	if(idVal == '' || namaVal == '' || passwordVal =='')
	{
		tampilkanFormUser();
	}
	else
	{
	
	  $.post("httpResponse/alat/handler.php",{opt: "4", nip: idVal, nama: namaVal, pass: passwordVal}).done(function(data){
		  if(data=='Berhasil')
		  {
			  tampilkanManajemenUser();
		  }
		  else
		  {
		  $('#myModalBody,#myModalLabel,#myModalFooter').removeData();
		  $('#myModalBody').html(data);
		  $('#myModalLabel').html("Informasi");
		  $('#myModalFooter').html("");
		  $('#myModal').modal();
		  }
	  });
	
	}
}

function tampilkanFormUser()
{
	var isiForm = "\
	<form>\
    	<div class='form-group'>\
        	<label for='nipNew'>NIP / Username</label>\
            <input type='text' class='form-control' id='nipNew' autocomplete='off' placeholder='Masukan NIP(9)'>\
        </div>\
        <div class='form-group'>\
        	<label for='namaNew'>Nama User</label>\
            <input type='text' class='form-control' id='namaNew' autocomplete='off' placeholder='Masukan Nama User'>\
        </div>\
        <div class='form-group'>\
        	<label for='passwordNew'>Password</label>\
            <input type='password' class='form-control' id='passwordNew' autocomplete='off' placeholder='Masukan Password'>\
        </div>\
    </form>";
	var tombolSubmit = "<input type='button' class='btn btn-default' value='Simpan' onClick='masukanUser();' data-dismiss='modal'>\
	<input type='button' data-dismiss='modal' value='Cancel' class='btn btn-danger'>";
	
	$('#myModalBody,#myModalLabel,#myModalFooter').removeData();
	$('#myModalBody').html(isiForm);
	$('#myModalLabel').html("Formulir Pendaftaran");
	$('#myModalFooter').html(tombolSubmit);
	$('#myModal').modal();
	
	
}


function toggleUser(id)
{
	$.post('httpResponse/alat/handler.php',{opt: '2',nip: id}).done(tampilkanManajemenUser());
	
}

function hapusUser(id)
{
	$.post('httpResponse/alat/handler.php',{opt: '3',nip: id}).done(tampilkanManajemenUser());
}

function alertHapus(id)
{
	$('#myModalBody,#myModalLabel,#myModalFooter').removeData();
	$('#myModalBody').html("Apakah Anda Yakin ?");
	$('#myModalLabel').html("Konfirmasi");
	$('#myModalFooter').html("<input type='button' class='btn btn-primary' onclick='hapusUser("+id+")' value='Yakin' data-dismiss='modal'> \
	<input type='button' value='Tidak' data-dismiss='modal' class='btn btn-danger'>");
	$('#myModal').modal();
}

function tampilkanFormEditUser(idVal)
{

	var isiForm = "\
	<form>\
    	<div class='form-group'>\
        	<label for='nipNew'>NIP / Username</label>\
            <input type='text' class='form-control' id='nipNew' autocomplete='off' value='"+idVal+"' disabled>\
        </div>\
        <div class='form-group'>\
        	<label for='namaNew'>Nama User</label>\
            <input type='text' class='form-control' id='namaNew' value='' placeholder='Masukan Nama User'>\
        </div>\
        <div class='form-group'>\
        	<label for='passwordNew'>Password</label>\
            <input type='password' class='form-control' id='passwordNew' placeholder='Kosongkan Jika Tidak Diubah'>\
        </div>\
    </form>";
	var tombolSubmit = "<input type='button' class='btn btn-default' value='Simpan' onClick='updateUser("+idVal+")' data-dismiss='modal'>\
	<input type='button' data-dismiss='modal' value='Cancel' class='btn btn-danger'>";
	
	
	$('#myModalBody,#myModalLabel,#myModalFooter').removeData();
	$('#myModalBody').html(isiForm);
	$('#myModalLabel').html("Edit User");
	$('#myModalFooter').html(tombolSubmit);
	$.post('httpResponse/alat/handler.php',{opt: "5",nip: idVal}).done(function(data){
	 $('#namaNew').attr("Value",data);
	});
	$('#myModal').modal();
}

function updateUser(id)
{
	var namaVal = $('#namaNew').val();
	var passVal = $('#passwordNew').val();
	$.post('httpResponse/alat/handler.php',{opt: "6",nip: id,nama: namaVal, pass: passVal}).done(tampilkanManajemenUser());
}

//END Ajax Alat

// Utility

function isiJenisBerkas(el){
	var namaJ = $(el).attr('value');
	var id = $(el).attr('id');
	
	$('#idJenisBerkas').attr('value',id);
	$('#jenisBerkas').attr('value',namaJ);
}


function maskingForm(id){
		
	var cek = $('#jenisBerkas').val();
	$('#npwp').mask('000000000-000.000');
	
	if(cek == '...'){
		$('#myModalBody,#myModalLabel,#myModalFooter').removeData();
		$('#myModalBody').html("Silakan pilih jenis berkas terlebih dahulu.");
		$('#myModalLabel').html("Peringatan.");
		$('#myModalFooter').html("");
		$('#myModal').modal();
	}	
	
}

function isiNamaWp(id)
{
	var id2 = id.replace(/\-|\./gi,"");	
	$.ajax({
			method: "POST",
			url:"httpResponse/util.php",
			data: {
				opt: '1', npwp: id2},
			success: function(data){
				if(data == '')
				{
					$('#namaWp').focus();
				}
				else
				{
				$('#namaWp').attr('value',data);
				}
			}
	});
	
}

function isiTerkait(){
	var id2 = $('#npwp').val().replace(/\-|\./gi,"");
	var jenisId = $('#idJenisBerkas').val();
	if(id2 == '')
	{
		$('#terkait').removeData();
		$('#terkait').html('tidak ditemukan.');
	}
	$.ajax({
			method: "POST",
			url:"httpResponse/util.php",
			data: {
				opt: '2', npwp: id2, jenis: jenisId},
			success: function(data){
				$('#terkait').removeData();
				$('#terkait').html(data + " <input type='button' class='btn btn-info btn-xs' onclick='tampilkanBerkasDummy()' value='+'/>");
				
			}
	});
}

function masukanBerkas()
{
	var idVal = $('#boxId').val();
	var noSuratVal = $('#nomorSurat').val();
	var jenisSuratVal = $('#idJenisBerkas').val();
	var npwpVal = $('#npwp').val();
	var npwpVal = npwpVal.replace(/\-|\./gi,"");
	var terkaitVal = $('#terkaitVal').val();	
	$.ajax({
			method: "POST",
			url:"httpResponse/masukanBerkas/subContent/prosesMasukBerkas.php",
			data: {
				boxId: idVal, 
				noSurat: noSuratVal,
				jenis: jenisSuratVal, 
				npwp: npwpVal,
				terkait: terkaitVal 
				},
			success: function(data){
				if(data == 'Berhasil')
				{
				pilihBox(idVal);
				}
				else
				{
					$('#myModalBody,#myModalLabel,#myModalFooter').removeData();
					$('#myModalBody').html(data);
					$('#myModalLabel').html("Peringatan.");
					$('#myModalFooter').html("");
					$('#myModal').modal();
				}
			}
	});

}

function tambahRak()
{
	
	var maxVal = $('#jumlahBoxMax').val();
	if (maxVal == '')
	{
		tampilkanTambahRak();
	}
	else{
		
	$.ajax({
		method: "POST",
		url : "httpResponse/alat/handler.php",
		data: {
			maks: maxVal,
			opt: '11'},
		success: function(data){
			if(data == "Berhasil")
			{
				 tampilkanManajemenRak();
			}
			else
			{
				tampilkanTambahRak();
				//alert(data);	
			}
		}
	});
	}
			
}

function editRak(idRak)
{
	maksVal = $('#jumlahBoxMax').val();
	idVal = idRak;
	$.ajax({
		method: "POST",
		url:"httpResponse/alat/handler.php",
		data : {
			opt: "10",
			id : idVal,
			maks : maksVal},
		success: function(data){
			if(data == "Berhasil")
			{
				tampilkanManajemenRak();
			}
			else
			{
				tampilkanEditRak(idVal);
				$('#jumlahBoxMax').attr('placeholder', data);
				
			}
		}
	});
}

function masukanDummy()
{
	var noSuratVal = $('#noSuratDummy').val();
	var jenisVal = $('#idJenisBerkas').val();
	if(jenisVal == "2" || jenisVal == "3"){ jenisVal = "1";}else{jenisVal = "3"}
	var npwpVal = $('#npwp').val();
	var npwpVal = npwpVal.replace(/\-|\./gi,"");
	
	$.ajax({
		method: "POST",
		url: "httpResponse/masukanBerkas/subContent/prosesBerkasDummy.php",
		data: {
			noSurat: noSuratVal,
			jenis: jenisVal,
			npwp: npwpVal},
		success: function(data){
			isiTerkait();
		}
		
	});
	
	
}

function tampilkanTambahRak()
{
	var data = "\
	<label for='jumlahBoxMax'>Jumlah Box Maksimal</label>\
	<input type='text' class='form-control' id='jumlahBoxMax'>";
	
	$('#myModalBody,#myModalLabel,#modalFooter').removeData();
	$('#myModalLabel').html("Detail Rak");
	$('#myModalBody').html(data);
	$('#myModalFooter').html("<input type = 'button' class = 'btn btn-default' Value='Proses' onclick='tambahRak()' data-dismiss='modal'>");
	$('#myModal').modal();
}

function tampilkanEditRak(idRak)
{
	var data = "\
	<label for='jumlahBoxMax'>Jumlah Box Maksimal</label>\
	<input type='text' class='form-control' id='jumlahBoxMax'>";
	
	$('#myModalBody,#myModalLabel,#modalFooter').removeData();
	$('#myModalLabel').html("Detail Rak");
	$('#myModalBody').html(data);
	$('#myModalFooter').html("<input type = 'button' class = 'btn btn-default' Value='Proses' onclick='editRak("+idRak+")' data-dismiss='modal'>");
	$('#myModal').modal();
}



function tampilkanBerkasDummy()
{
	var jenisBerkas = $('#jenisBerkas').val();
	var nomorSurat = $('#nomorSurat').val();
	var npwp = $('#npwp').val();
	var namaWp = $('#namaWp').val();
	
	
	if(jenisBerkas == '...' || nomorSurat == '' || npwp == '' || namaWp == '')
	{
		$('#myModalBody,#myModalLabel,#myModalFooter').removeData();
		$('#myModalBody').html("Silakan lengkapi formulir terlebih dahulu.");
		$('#myModalLabel').html("Peringatan.");
		$('#myModalFooter').html("");
		$('#myModal').modal();
	}
	else
	{
	$('#myModalBody,#myModalLabel,#modalFooter').removeData();
	$('#myModalLabel').html("Masukan Nomor Surat.");
	$('#myModalBody').html("<input type='text' class='form-control' id='noSuratDummy'>");
	$('#myModalFooter').html("<input type = 'button' class = 'btn btn-default' onclick='masukanDummy()' Value='Proses' data-dismiss='modal'>");
	$('#myModal').modal();
	
	  if(jenisBerkas == 'STEGURAN' || jenisBerkas == 'SPAKSA')
	  {
		  $('#noSuratDummy').mask('00000/000/00/000/00');
	  }
	  else
	  {
		 $('#noSuratDummy').mask('SS-00000/SSS.00/SS.0000/0000');
	  }
	}
}


function validasiFormMasukanBerkas()
{
		
	var jenisBerkas = $('#jenisBerkas').val();
	var nomorSurat = $('#nomorSurat').val();
	var npwp = $('#npwp').val();
	var namaWp = $('#namaWp').val();
	
	if(jenisBerkas == '...' || nomorSurat == '' || npwp == '' || namaWp == '')
	{
		$('#myModalBody,#myModalLabel,#myModalFooter').removeData();
		$('#myModalBody').html("Silakan lengkapi formulir terlebih dahulu.");
		$('#myModalLabel').html("Peringatan.");
		$('#myModalFooter').html("");
		$('#myModal').modal();
	}
	else
	{
		masukanBerkas();
	}
	
}


function getTabelContent($id)
{
	var idVal = $('#boxId').val();
	$.ajax({
			method: "POST",
			url:"httpResponse/masukanBerkas/subContent/tabelContent.php",
			data: {
				boxId: idVal
				},
			success: function(data){
				$('#tabelContent').html(data);
				
			}
	});

}

function showPinjamBerkas()
{
	$.ajax({
			method: "POST",
			url:"httpResponse/peminjaman/form1.php",
			data: {
				opt : "1"
				},
			success: function(data){
				$('#rightContent').html(data);
				
			}
	});
}

function showKembalikanBerkas()
{
	$.ajax({
			method: "POST",
			url:"httpResponse/peminjaman/form2.php",
			data: {
				opt : "2"
				},
			success: function(data){
				$('#rightContent').html(data);
				
			}
	});
}


function modalShow()
{
	$('#myModal').modal();
}

function sembunyikanTerkait(elem)
{
	var id = $(elem).attr('id');
	
	if(id == "2" || id == "3" || id == "4")
	{
		$('.terkait').show();
	}
	else
	{
		$('.terkait').hide();
	}
}

function masukanJenisBerkas() //masih salah
{
	var jenisBerkasVal = $('#formJenisBerkas').val();
	var shortJBVal = $('#formShortJB').val();
	var boxId = $('#boxId').val();
	if(jenisBerkasVal == '' || shortJBVal == '')
	{
		tampilkanTambahJenisBerkas();
	}
	else
	{
		$.ajax({
			method: "POST",
			url: "httpResponse/alat/handler.php",
			data: {
				opt: "12",
				namaSurat: jenisBerkasVal,
				namaTabel: shortJBVal },
			success: function(data){
				if(data == "Berhasil")
				{
				 tampilkanManajemenRak();
				}
				else
				{
					
					$('#myModalBody,#myModalLabel,#myModalFooter').removeData();
					$('#myModalLabel').html("Peringatan");
					$('#myModalBody').html("Terjadi Kesalahan Saat Menambah Jenis Berkas Baru");
					$('#myModalFooter').html("");
					$('#myModal').modal();
				
				}
			}
		
		});
	}
	
}

function tampilkanTambahJenisBerkas()
{
	
	$('#myModalBody,#myModalLabel,#myModalFooter').removeData();
	$('#myModalBody').html("\
	Jenis Berkas<br>\
	<input type='text' placeholder='Masukan Jenis Berkas Baru' class='form-control' id='formJenisBerkas'><br>\
	Nama Pendek<br>\
	<input type='text' placeholder='Masukan Nama Pendek Jenis Berkas' class='form-control' id='formShortJB'>\
	");
	$('#myModalLabel').html("Tambah Jenis Berkas.");
	$('#myModalFooter').html("<input type='button' value='Proses' onclick='masukanJenisBerkas();' data-dismiss='modal' class='btn btn-default'>\
	<input type='button' value='Batal' class='btn btn-default' data-dismiss='modal'>");
	$('#myModal').modal();
}

function getChecked()
{
	var terkaitId = '';
	$("input:checkbox[name=ss]:checked").each(function() {
           terkaitId  = terkaitId + ","  + $(this).val() ;
        });
		
	$('#terkaitVal').val(terkaitId);
}

function hapusBerkas(noSuratVal)
{
	var idVal = $('#boxId').val();
	//$.post("httpResponse/masukanBerkas/handler.php",{opt: "1", noSurat: noSuratVal}).done();
	$.ajax({
		method: "POST",
		url: "httpResponse/masukanBerkas/handler.php",
		data:{
			opt: "1",
			noSurat: noSuratVal},
		success: function(data){
		  if(data == "Berhasil")
		  {
			  pilihBox(idVal);
		  }
		  else
		  {
			  $('#myModalBody,#myModalLabel,#myModalFooter').removeData();
			  $('#myModalLabel').html("Peringatan");
			  $('#myModalBody').html("Gagal Menghapus, Silakan coba beberapa saat lagi.");
			  $('#myModalFooter').html("");
			  $('#myModal').modal();
		  }
		
		}
	});

}

function alertHapusBerkas(noSuratVal)
{
	var tombol = "\
	<button type='button' class='btn btn-default' onclick=hapusBerkas(this.value) data-dismiss='modal'  id='yakinHapusBerkas' value=''>Yakin</button>\
	<input type='button' class='btn btn-default' data-dismiss='modal' value='Tidak'>"
	
	$('#myModalBody,#myModalLabel,#myModalFooter').removeData();
	$('#myModalLabel').html("Peringatan");
	$('#myModalBody').html("Apakah anda yakin akan menghapus berkas ini?");
	$('#myModalFooter').html(tombol);
	$('#yakinHapusBerkas').attr("value",noSuratVal);
	$('#myModal').modal();
	
}

function prosesPinjam()
{
	var namaVal = $('#namaVal').val();
	var noSuratVal = $('#noSurat').val();
	if(namaVal == '' || noSuratVal == '')
	{
		$('#myModalBody,#myModalLabel,#myModalFooter').removeData();
		$('#myModalLabel').html("Peringatan");
		$('#myModalBody').html("Formulir belum diisi, Silakan lengkapi terlebih dahulu.");
		$('#myModalFooter').html("");
		$('#myModal').modal();
		exit();
	}
	
	$.ajax({
			method: "POST",
			url: "httpResponse/peminjaman/handler.php",
			data: {
				opt: "3",
				peminjam: namaVal,
				noSurat: noSuratVal },
			success: function(data){
				if(data == "Berhasil")
				{
				 showPinjamBerkas();
				 $('#namaVal').attr('value',"");
				 $('#noSurat').attr('value',"");
				 
				}
				else
				{
					$('#myModalBody,#myModalLabel,#myModalFooter').removeData();
					$('#myModalLabel').html("Peringatan");
					$('#myModalBody').html(data);
					$('#myModalFooter').html("");
					$('#myModal').modal();
				}
			}
		
		});
	
}

function cariBerkas(id)
{
	$('#hasilCariP').load("httpResponse/peminjaman/handler.php",{opt: "2", searchVal: id});
}

function isiFieldBerkasP(noSurat)
{
	$('#noSurat').attr("value",noSurat);
}

function tampilkanCariBerkas()
{
	var inputNama = "<input type='text' class='form-control' onkeyup='cariBerkas(this.value)' placeholder='Masukan NPWP atau No. Surat...'><br>";
	var content = "<div>\
	<table class='table table-bordered'>\
	<thead><tr><th>No Surat</th><th>NPWP</th><th>Jenis Surat</th><th>Opsi</th></tr></thead><tbody id='hasilCariP'></tbody></table></div>";
	
	$('#myModalBody,#myModalLabel,#myModalFooter').removeData();
	$('#myModalLabel').html("Cari Berkas");
	$('#myModalBody').html(inputNama+content);
	$('#myModalFooter').html("");
	$('#myModal').modal();
}

function prosesKembaliBerkas()
{
	var noSuratVal = $('#noSurat').val();
	if(noSuratVal == '')
	{
		$('#myModalBody,#myModalLabel,#myModalFooter').removeData();
		$('#myModalLabel').html("Peringatan");
		$('#myModalBody').html("Formulir belum diisi, Silakan lengkapi terlebih dahulu.");
		$('#myModalFooter').html("");
		$('#myModal').modal();
		exit();
	}
	
	$.ajax({
			method: "POST",
			url: "httpResponse/peminjaman/handler.php",
			data: {
				opt: "5",
				noSurat: noSuratVal },
			success: function(data){
				if(data == "Berhasil")
				{
				 showKembalikanBerkas();
				 $('#noSurat').attr('value',"");
				 
				}
				else
				{
					
					$('#myModalBody,#myModalLabel,#myModalFooter').removeData();
					$('#myModalLabel').html("Peringatan");
					$('#myModalBody').html(data);
					$('#myModalFooter').html("");
					$('#myModal').modal();

				}
			}
		
		});
	
}



function cariBerkasDipinjam(id)
{
	$('#hasilCariP').load("httpResponse/peminjaman/handler.php",{opt: "4", searchVal: id});
}

function isiFieldBerkasP(noSurat)
{
	$('#noSurat').attr("value",noSurat);
}

function tampilkanCariBerkasKembali()
{
	var inputNama = "<input type='text' class='form-control' onkeyup='cariBerkasDipinjam(this.value)' placeholder='Masukan NPWP atau No. Surat...'><br>";
	var content = "<div>\
	<table class='table table-bordered'>\
	<thead><tr><th>No Surat</th><th>NPWP</th><th>Jenis Surat</th><th>Opsi</th></tr></thead><tbody id='hasilCariP'></tbody></table></div>";
	
	$('#myModalBody,#myModalLabel,#myModalFooter').removeData();
	$('#myModalLabel').html("Cari Berkas");
	$('#myModalBody').html(inputNama+content);
	$('#myModalFooter').html("");
	$('#myModal').modal();
}

function editJenis(idVal)
{
	var namaSuratVal = $('#namaSuratVal').val();
	var namaTabelVal = $('#namaTabelVal').val();

	$.ajax({
		type: "POST",
		url: "httpResponse/alat/handler.php",
		data: {
			id: idVal,
			namaSurat: namaSuratVal,
			namaTabel: namaTabelVal,
			opt: "13"
		},
		success: function(data){
			if(data == "berhasil")
			{
				tampilkanManajemenRak();
			}
			else
			{
				$('#myModalBody,#myModalLabel,#myModalFooter').removeData();
				$('#myModalLabel').html("Error.");
				$('#myModalBody').html("Gagal Mengedit Jenis Berkas. Silakan coba beberapa saat lagi.");
				$('#myModalFooter').html("");
				$('#myModal').modal();
			}
		}
	});
}

function tampilkanEditJenis(id)
{
	var arr = id.split('|');

	var idVal = arr[0];
	var namaSuratOld = arr[1];
	var namaTabelOld = arr[2];

	var form = "\
	<label>Jenis Berkas</label>\
	<input type = 'text' id = 'namaSuratVal' class='form-control' value='"+namaSuratOld+"'>\
	<label>Alias</label>\
	<input type = 'text' id ='namaTabelVal' class='form-control' value='"+namaTabelOld+"'>";
	var tombolSubmit = "<button type = 'button' class='btn btn-default' data-dismiss = 'modal' value ='"+idVal+"' onClick='editJenis(this.value)'>Proses</button>";


	$('#myModalBody,#myModalLabel,#myModalFooter').removeData();
	$('#myModalLabel').html("Edit Jenis Berkas");
	$('#myModalBody').html(form);
	$('#myModalFooter').html(tombolSubmit);
	$('#myModal').modal();


}

function downloadExcel()
{
	window.open("httpResponse/exportExcel.php");
}

function buangGetParam(key, source){
	var rtn = source.split("?")[0];
	var param;
	var params_arr = [];
	var queryString = (source.indexOf("?") != -1) ? source.split("?")[1] : "";

	if(queryString != ""){
		params_arr = queryString.split("&");

		for(var i = params_arr.length-1;i>=0; i -= 1){
			param = params_arr[i].split("=")[0];
			if (param == key) {
				params_arr.splice(i,1);
			}			
		}
		rtn = rtn + "?" + params_arr.join("&");
	}
	
	return source;
}
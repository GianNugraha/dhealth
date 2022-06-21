@extends('template/base')
@extends('template/stylesheet')
@section('title','Pembuatan Resep')
@section('container')
<div class="container mt-4">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
<li class="breadcrumb-item"><a href="{{url('/daftar')}}">Daftar Pesanan Obat</a></li>
<li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
</ol>
</nav>
</div>
<div class="container">
  @if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong>{{ $message }}</strong>
</div>
@endif


@if ($errors->any())
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	Please check the form below for errors
</div>
@endif
<div class="row">
<div class="col-md-12 mt-3">
<h3>Form Pembuatan Resep</h3>
<form action="{{url('/resep/store_resep')}}" method="post">
@csrf
<div class="form-group">
<label for="angkatan">Nama Resep</label>
<input class="form-control" type="text" name="nama_resep" id="nama_resep" placeholder="Nama Resep">
</div>
<div class="form-group">
  <label for="sel1">Pilih Obat : </label>
  <select id="select-obat" name="obatalkes_id[]" multiple="multiple">
    @foreach($obat as $i => $item)
    <option value="{{$item->obatalkes_id}}">{{$item->obatalkes_nama}}</option>
    @endforeach
  </select>
</div>
<div class="form-group" id="newModule">
  
</div>
<div class="form-group">
  <label for="sel1">Pilih Signa : </label>
  <select class="form-control" id="select-signa" name="signa_id">
    @foreach($signa as $i => $item)
    <option value="{{$item->signa_id}}">{{$item->signa_nama}}</option>
    @endforeach
  </select>
</div>
<br/>
<div class="form-group float-right">
<button class="btn btn-lg btn-danger" type="reset">Reset</button>
<input type="button" class="btn  btn-lg btn-primary" name="open" value="Selanjutnya" id="kirim" data-toggle="modal" data-target="#modal">
</div>
<div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalSatuanKerjaLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">      
        <div class="form-group">
        <h4 class="modal-title" id="myModalLabel">Silahkan Masukan Jumlah Tiap Obat</h4>
        </div>  
        <div class="form-group">
        <label for="Nama"><b>Nama Resep : </b></label>
        <span id="modal-nama-resep"></span>
        </div>
        <div class="form-group">
        <label for="Nama"><b>Sigma Resep : </b></label>
        <span id="modal-signa"></span>
        </div>
        <div class="form-group">
          <table id="modal_popup" class="table table-stripped">
            <thead class="thead-primary">
            <tr>
            <th class="text-center">No</th>
            <th>Nama Obat</th>
            <th>Jumlah Obat</th>
            </tr>
            </thead>
            <tbody id="body-modal">
            </tbody>
          </table>
        
        </div>        
      </div>
      <div class="modal-footer">
        <button type="submit" id="btnSatuan" class="btn btn-primary" >Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>        
      </div>
    </div>
  </div>
</div>
</form>
</div>
</div>
</div>
@endsection
@push('after_scripts')
{{-- chartjs links --}}
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function(){
  $("#prevShow").click(function(){
    $("#prev").hide();
  });
});
</script>

<link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/js/tom-select.complete.min.js"></script>
<script>  
  new TomSelect("#select-obat",{
        create: false,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
</script>
<script>
  var signa ="";
  var arr_obat = [];
  var arr_idobat = [];


  $('#select-obat').on('change', function() {
      // namaobat = $(this).find(":selected").text();
      // nama_obat.push(namaobat);
      var id_obat = [];
      var nama_obat = [];
      for (var option of document.getElementById('select-obat').options)
      {
          if (option.selected) {
              id_obat.push(option.value);
              nama_obat.push(option.text);
          }
      }
    
      arr_obat = nama_obat;
      arr_idobat = id_obat;
  });
  
  $('#select-signa').on('change', function() {
      signa = $(this).find(":selected").text();
      document.getElementById('modal-signa').innerHTML = signa;
  });
  $( "#kirim" ).click(function() {
    var banyakdata = arr_obat.length;
    let i;
    for(i=0; i<banyakdata; i++){
      var no = i+1;
      var nama = arr_obat[i];
      var baris_baru = "<tr>"+
                  "<td class='text-center'>"+no+"</td>" +
                  "<td><p class='pxsmall text-left uppercase font-bold'>"+nama+"</p></td>"+
                  "<td><input class='form-control' style='width:60px' type='text' name='qty_obat[]' id='qty_obat' required></td>"+
                  "</tr>";
      $("#body-modal").append(baris_baru);
    }

    document.getElementById('modal-nama-resep').innerHTML = document.getElementById('nama_resep').value;
  });

  $(document).ready(function(){
    $('#show').click(function() {
      $('.details').toggle("slide");
    });
  });
</script>

@endpush
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
<h3>Form Pembuatan Obat</h3>
<form action="{{url('/obat/store_obat')}}" method="post">
  @csrf
  <div class="form-group">
    <label for="sel1">Pilih Obat : </label>
    <select id="select-obat" name="obat" >
      <option value="">Pilih Obat</option>
      @foreach($obat as $i => $item)
      <option value="{{$item->obatalkes_id}}">{{$item->obatalkes_nama}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="sel1">Pilih Signa : </label>
    <select class="form-control" name="signa" id="select-signa">
      <option disabled selected>----</option>
      @foreach($signa as $i => $item)
      <option value="{{$item->signa_id}}">{{$item->signa_nama}}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group">
  <label for="angkatan">Banyaknya Obat</label>
  <input class="form-control" type="number" required name="jumlah_obat" id="jumlah_obat" value="{{ old('jumlah_obat') }}" placeholder="Jumlah Banyaknya Obat" >
  </div>
  <div class="form-group float-right">
  <button class="btn btn-lg btn-danger" type="reset">Reset</button>
  <input type="button" class="btn  btn-lg btn-primary" name="open" value="Kirim" id="kirim" data-toggle="modal" data-target="#modal">
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
        <h4 class="modal-title" id="myModalLabel">Apakah Data sudah sesuai?</h4>
        </div>  
        <div class="form-group">
          <table class="table table-stripped">
            <thead class="thead-primary">
            <tr>
            <th class="text-center">No</th>
            <th>Nama Obat</th>
            <th>Jumlah Obat</th>
            <th>Signa</th>
            </tr>
            </thead>
            <tbody>
              <tr>
                  <td class="text-center">1)</td>
                  <td><p class="pxsmall text-left uppercase font-bold " id="modal-namaobat"></p></td>
                  <td><p class="pxsmall text-left uppercase font-bold " id="modal-jumlah_obat"></p></td>
                  <td><p class="pxsmall text-left uppercase font-bold " id="modal-signa"></p></td>
              </tr>
            </tbody>
          </table>
          {{-- untuk nama obat nya --}}
          <input class="form-control" type="hidden" name="nama_obat" id="nama_obat" value="">
        
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
var namaobat ="";
var signa ="";
$('#select-obat').on('change', function() {
    namaobat= $(this).find(":selected").text();
    var idobat = $(this).find(":selected").val();
    $.ajax({  //create an ajax request to display.php
          type: "GET",
          url: "getObatById/"+idobat,       
          success: function (data) {
            console.log(data);
          }
        });
});

$('#select-signa').on('change', function() {
    signa= $(this).find(":selected").text();
});
$( "#kirim" ).click(function() {
  document.getElementById('modal-jumlah_obat').innerHTML = document.getElementById('jumlah_obat').value;
  document.getElementById('modal-namaobat').innerHTML = namaobat;
  document.getElementById('modal-signa').innerHTML = signa;
  $("#nama_obat").val(namaobat);
});
</script>
@endpush
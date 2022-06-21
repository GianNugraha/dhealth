@extends('template/base')
@section('title','Daftar Pesanan Obat')
@section('container')
<div class="container mt-4">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
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
<div class="my-4 col-12">
<h1 class="float-left">Daftar Pesanan Obat</h1>
<a class="btn btn-primary float-right mt-2 nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Tambah Pesanan 
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a href="{{url('/obat/create')}}" class="dropdown-item" >Obat</a>
          <a href="{{url('/resep/create')}}" class="dropdown-item" >Resep</a>
        </div>
<!-- <a class="btn btn-primary float-right mt-2" href="{{url('/tambah')}}" role="button">Tambah Pesanan</a> -->
</div>
<div class="col-12">
<table class="table table-stripped">
<thead class="thead-primary">
<tr>
<th class="text-center">No</th>
<th>Nama Obat</th>
<th>Signa</th>
<th>Jenis</th>
<th>Pemesan</th>
<th>Action</th>
</tr>
</thead>
<tbody>
    @foreach($obat as $i => $item)
    <tr > 
        <td class="text-center">{{$i+1}}</td>
        <td>{{$item->nama_pesanan}}</td>
        <td>{{$item->signa_nama}}</td>
        @if($item->is_resep == 0)
        <td>Obat Biasa</td>
        @else
        <td>Resep / Racikan Obat</td>
        @endif
        <td>{{$item->fullname}}</td>
        <td><a href="{{url('pesanan/getPesananById/'.$item->pesanan_id)}}">lihat detail</a></td>
    </tr>
    @endforeach
</tbody>
</table>
</div>
</div>
</div>
@endsection
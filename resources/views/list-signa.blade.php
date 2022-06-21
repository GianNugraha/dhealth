@extends('template/base')
@section('title','Daftar Signa Obat')
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
<div class="row">
<div class="my-4 col-12">
<h1 class="float-left">Daftar Signa Obat</h1>
</div>
<div class="col-12">
<table class="table table-stripped">
<thead class="thead-primary">
    <tr>
        <th class="text-center">No</th>
        <th>Kode Signa</th>
        <th>Nama Signa</th>
    </tr>
</thead>
<tbody>
    @foreach($signa as $i => $item)
    <tr>
        <td class="text-center">{{$i+1}}</td>
        <td>{{$item->signa_kode}}</td>
        <td>{{$item->signa_nama}}</td>
       
    </tr>
    @endforeach
</tbody>
</table>
</div>
</div>
</div>
@endsection
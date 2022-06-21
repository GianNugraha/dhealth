@extends('template/base')
@section('title','Home')
@section('container')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-10 mt-4">
            <h1>Selamat Datang di E-Prescription </h1>
        </div>
        <div class="col-5 mt-2">
            <h6>Silahkan pilih tindakan yang akan anda lakukan</h6>
        </div>
    </div>
    <div class="row row-cols-4">
        <div class="card mt-4 ml-4 shadow-sm p-3 mb-5 bg-white rounded" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Pesan Obat mu</h5>
                <a class="btn btn-primary float-left mt-2" href="{{url('/obat/create')}}" role="button">Sekarang</a>
            </div>
        </div>
        <div class="card mt-4 ml-4 shadow-sm p-3 mb-5 bg-white rounded" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Buat Obat Racikan</h5>
                <a class="btn btn-primary float-left mt-2" href="{{url('/resep/create')}}" role="button">Disini</a>
            </div>
        </div>
        <div class="card mt-4 ml-4 shadow-sm p-3 mb-5 bg-white rounded" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Daftar Pesanan Obat Anda</h5>
                <a class="btn btn-primary float-left mt-2" href="{{url('/daftar')}}" role="button">Lihat</a>
            </div>
        </div>
        <div class="card mt-4 ml-4 shadow-sm p-3 mb-5 bg-white rounded" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Daftar Obat</h5>
                <a class="btn btn-primary float-left mt-2" href="{{url('/obat/getObat')}}" role="button">Lihat</a>
            </div>
        </div><div class="card mt-4 ml-4 shadow-sm p-3 mb-5 bg-white rounded" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Signa Obat</h5>
                <a class="btn btn-primary float-left mt-2" href="{{url('/signa/getSigna')}}" role="button">Lihat</a>
            </div>
        </div>

</div>
</div>
</body>
</html>
@endsection
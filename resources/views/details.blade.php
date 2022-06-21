@extends('template/base')
@section('title','Detail Pesanan Obat')
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
            <h1 class="float-left">Detail Pesanan Obat</h1>
        </div>
        @if( $detail[0]->is_resep === 0 )
            <div class="col-12">
                <table class="table table-stripped">
                    <thead class="thead-primary">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Obat</th>
                            <th>Signa</th>
                            <th>Jenis</th>
                            <th>Pemesan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr > 
                            <td class="text-center">{{1}}</td>
                            <td>{{$detail[0]->nama_pesanan}}</td>
                            <td>{{$detail[0]->signa_nama}}</td>
                            <td>Obat Biasa</td>
                            <td>{{$detail[0]->fullname}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
        <div class=" col-12">
            <label for="Nama"><b>Nama Resep : </b></label>
            <span >{{$detail[0]->nama_pesanan}}</span>
            <!-- <h1 class="float-left">Detail Pesanan Obat</h1> -->
        </div>
            <br/>
        <div class="col-12">
            <label for="Nama"><b>Signa : </b></label>
            <span >{{$detail[0]->signa_nama}}</span>
            <!-- <h1 class="float-left">Detail Pesanan Obat</h1> -->
        </div>
            <div class="col-12">
                <table class="table table-stripped">
                    <thead class="thead-primary">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Obat</th>
                            <th>Jumlah Obat</th>
                            <th>Pemesan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detail as $i => $item)
                        <tr > 
                            <td class="text-center">{{$i+1}}</td>
                            <td>{{$item->namaobat}}</td>
                            <td>{{$item->qty_obat}}</td>
                            <td>{{$item->fullname}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
    </div>
</div>
@endsection
@extends('backpack::layout')
@section('css')

@endsection
@section('content')

<div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header-heading"><span class="fa fa-circle text-success page-header-heading-icon"></span>{{$client->name}}<small>User Profile</small></h1>
                <p class="page-header-description">{{$client->name}} <strong>{{$client->status}}</strong>.</p>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    
    <div class="row">
        <div class="col-xs-12 col-lg-9 col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="fa fa-clipboard"></span>&nbsp;&nbsp;{{$client->name}} Details
                </div>
                <div class="panel-body">
                    <div class="profile-details">
                        <div class="profile-details-profile-picture">
                            {{-- <img src="http://www.stickpng.com/assets/images/585e4bcdcb11b227491c3396.png" alt="{{ $client->name }}"> --}}
                        </div>
                        <div class="profile-details-info">
                            <h2 class="profile-details-info-name">{{$client->name}} <small>Technician at Megatrik</small></h2>
                            <p class="profile-details-info-summary">Biodata {{$client->name}}:</p>
                            <ul class="profile-details-info-contact-list">
                                <li class="profile-details-info-contact-list-item">
                                    <div class="form-group">
                                        <label class="label label-default">Nama : </label>
                                        <p class="form-control">{{$client->name}}</p>
                                        <label class="label label-default">Jenis Kelamin : </label>
                                        <p class="form-control">{{$client->biodata->gender}}</p>
                                         <label class="label label-default">Tanggal Lahir : </label>
                                        <p class="form-control">{{$client->biodata->date_of_birth}}</p>
                                         <label class="label label-default">CP : </label>
                                        <p class="form-control">{{$client->biodata->cp}}</p>
                                         <label class="label label-default">Tanggal Daftar : </label>
                                        <p class="form-control">{{$client->created_at}}</p>
                                        
                                    </div>
                                    
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="fa fa-info-circle"></span>&nbsp;&nbsp;Informasi Pribadi
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Pendidikan Terakhir</th>
                            <td>{{$client->biodata->last_education}}</td>
                        </tr>
                        <tr>
                            <th>Profesi</th>
                            <td>{{$client->biodata->profession}}</td>
                        </tr>
                        <tr>
                            <th>Keahlian</th>
                            <td>{{$client->biodata->skill}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="col-xs-12 col-lg-3 col-md-5">
            
            <div class="panel panel-default margin-top-15">
                <div class="panel-heading">
                    Statistik Teknisi
                </div>

                <ul class="list-group">
                    <li class="list-group-item"><span class="fa fa-comment"></span>&nbsp;&nbsp;<strong>7,918</strong> Pelanggan yang ditangani</li>
                    <li class="list-group-item"><span class="fa fa-thumbs-up"></span>&nbsp;&nbsp;<strong>5,123</strong> Like</li>
                    <li class="list-group-item"><span class="fa fa-thumbs-down"></span>&nbsp;&nbsp;<strong>2,812</strong> Dislike</li>
                    <li class="list-group-item"><span class="fa fa-eye"></span>&nbsp;&nbsp;<strong>2019-9-9</strong> Terakhir aktif</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')

@endsection
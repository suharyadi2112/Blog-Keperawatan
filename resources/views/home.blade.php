@extends('adminlte::page')

@section('title', 'Dashboard - RSUD Raja Ahmad Tabib')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-file"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Dokumen</span>
                    <span class="info-box-number">
                        {{$dokumen->count()}}
                    </span>
                </div>

            </div>

        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-info"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Informasi</span>
                    <span class="info-box-number">{{$informasi->count()}}</span>
                </div>

            </div>

        </div>


        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-camera"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Dokumentasi</span>
                    <span class="info-box-number"> {{$dokumentasi->count()}}</span>
                </div>

            </div>

        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">User</span>
                    <span class="info-box-number">{{$user->count()}}</span>
                </div>

            </div>

        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop

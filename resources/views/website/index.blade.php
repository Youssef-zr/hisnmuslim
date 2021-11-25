@extends('website.layouts.master')

@section('content')

<div class="container py-5" >
    <div class="row">
        <!-- --------- content vueJs --------- -->
        <div class="col-sm-12 col-xl-10 px-xl-0 mb-3 -0">
            <router-view></router-view>
        </div>
    </div>

    <!-- --------- sidebar --------- -->
    <sidebar><sidebar/>
</div>

@endsection
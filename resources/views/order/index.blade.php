@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ trans('Order') }}<small>{{ trans('This is your order list') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ backpack_url() }}">Megatrik</a></li>
        <li class="active">{{ trans('List') }}</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="container">
    	<div class="row">
	        <div class="table-responsive">
	        	<table class="dataTable table table-striped">
	        		<thead>
	        			<tr>
	        				<td>No</td>
							<td>Nama Pelanggan</td>
							<td>Email</td>
							<td>Umur</td>
							<td>jenis Kelamin</td>
							<td>Alamat</td>
							<td>Contact Person</td>
							<td>Jasa</td>
							<td>Material</td>
							<td>Teknisi yang Menangani</td>
							<td>Status</td>
							<td>Action</td>
	        			</tr>
	        		</thead>
	        	</table>
	        </div>
	    </div>
    </div>
@endsection

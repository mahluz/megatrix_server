@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ trans('client') }}<small>{{ trans('This is your client list') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ backpack_url() }}">Megatrik</a></li>
        <li class="active">{{ trans('List') }}</li>
      </ol>
    </section>
@endsection

@section('content')
<div class="container-fluid">
	<a href="{{url('admin/client/create')}}"><button type="button" class="btn btn-primary">Tambah client</button></a>
	<div class="table-responsive">
		{{-- {{dd($client)}} --}}
		<table class="dataTable table table-striped">
			<thead>
				<tr>
					<td>No</td>
					<td>Nama</td>
					<td>Email</td>
					<td>Password</td>
					<td>Aksi</td>
				</tr>
			</thead>
			<tbody>
				@foreach ($client as $index => $ini)
					{{-- expr --}}
					<tr>
						<td>{{$index+1}}</td>
						<td>{{$ini->name}}</td>
						<td>{{$ini->email}}</td>
						<td>{{$ini->password}}</td>
						<td>
							<a href="{{ url('admin/client/edit/'.$ini->id) }}"><button type="button" class="btn btn-warning">Edit</button></a>
							<button type="button" class="btn btn-info" onclick="event.preventDefault();document.getElementById('biodata{{$ini->id}}').submit()">Lihat Biodata</button>
							<form id="biodata{{$ini->id}}" method="post" action="{{url('admin/client/biodata')}}">
								<input type="hidden" name="id" value="{{$ini->id}}">
								{{csrf_field()}}
							</form>
							{{-- <button type="button" class="btn btn-warning" onclick="event.preventDefault();document.getElementById('edit{{$ini->id}}').submit()">Edit</button>
							<form id="edit{{$ini->id}}" method="post" action="{{url('client/client/edit')}}">
								<input type="hidden" name="id" value="{{$ini->id}}">
								{{csrf_field()}}
							</form> --}}
							<button type="button" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('delete{{$ini->id}}').submit()">Hapus</button>
							<form id="delete{{$ini->id}}" method="post" action="{{url('admin/client/delete')}}">
								<input type="hidden" name="id" value="{{$ini->id}}">
								{{csrf_field()}}
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

	</div>

</div>
@endsection
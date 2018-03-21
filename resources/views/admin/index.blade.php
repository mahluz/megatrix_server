@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ trans('Admin') }}<small>{{ trans('This is your admin list') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ backpack_url() }}">Megatrik</a></li>
        <li class="active">{{ trans('List') }}</li>
      </ol>
    </section>
@endsection

@section('content')
<div class="container-fluid">
	<a href="{{url('admin/admin/create')}}"><button type="button" class="btn btn-primary">Tambah Admin</button></a>
	<div class="table-responsive">
		{{-- {{dd($admin)}} --}}
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
				@foreach ($admin as $index => $ini)
					{{-- expr --}}
					<tr>
						<td>{{$index+1}}</td>
						<td>{{$ini->name}}</td>
						<td>{{$ini->email}}</td>
						<td>{{$ini->password}}</td>
						<td>
							<a href="{{ url('admin/admin/edit/'.$ini->id) }}"><button type="button" class="btn btn-warning">Edit</button></a>
							<button type="button" class="btn btn-info" onclick="event.preventDefault();document.getElementById('biodata{{$ini->id}}').submit()">Lihat Biodata</button>
							<form id="biodata{{$ini->id}}" method="post" action="{{url('admin/admin/biodata')}}">
								<input type="hidden" name="id" value="{{$ini->id}}">
								{{csrf_field()}}
							</form>
							{{-- <button type="button" class="btn btn-warning" onclick="event.preventDefault();document.getElementById('edit{{$ini->id}}').submit()">Edit</button>
							<form id="edit{{$ini->id}}" method="post" action="{{url('admin/admin/edit')}}">
								<input type="hidden" name="id" value="{{$ini->id}}">
								{{csrf_field()}}
							</form> --}}
							<button type="button" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('delete{{$ini->id}}').submit()">Hapus</button>
							<form id="delete{{$ini->id}}" method="post" action="{{url('admin/admin/delete')}}">
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
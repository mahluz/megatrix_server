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
							<td>Tanggal Lahir</td>
							<td>jenis Kelamin</td>
							<td>Provinsi</td>
							<td>Kabupaten</td>
							<td>Kecamatan</td>
							<td>Desa</td>
							<td>Alamat</td>
							<td>Contact Person</td>
							<td>Jasa yang diminta</td>
							<td>Material</td>
							<td>Teknisi yang Menangani</td>
							<td>Status</td>
							<td>Action</td>
	        			</tr>
	        		</thead>
	        		<tbody>
	        		@foreach ($order as $index => $ini)
	        			<tr>
	        				<td>{{ $index+1 }}</td>
	        				<td>{{ $ini->client->name }}</td>
	        				<td>{{ $ini->client->email }}</td>
	        				<td>{{ $ini->client->biodata->date_of_birth }}</td>
	        				<td>{{ $ini->client->biodata->gender }}</td>
	        				<td>{{ $ini->client->biodata->province }}</td>
	        				<td>{{ $ini->client->biodata->regency }}</td>
	        				<td>{{ $ini->client->biodata->district }}</td>
	        				<td>{{ $ini->client->biodata->village }}</td>
	        				<td>{{ $ini->address }}</td>
	        				<td>{{ $ini->client->biodata->cp }}</td>
	        				<td>{{ $ini->service->service }}</td>
	        				<td>
	        					<input type="text" data-role="tagsinput" class="tagsinput" value="
	        					@foreach ($ini['order_materials'] as $material)
	        						{{ $material->material->material }},
	        					@endforeach
	        					" disabled>
	        				</td>
	        				<td>
	        					@if ($ini->technician_id == 1)
	        						<button type="button" class="btn btn-primary" onclick="toggleModal('{{ $ini->id }}','{{ $ini->client->biodata->province }}','{{ $ini->client->biodata->regency }}','{{ $ini->client->biodata->district }}','{{ $ini->client->biodata->village }}')">Layani</button>
	        					@else
	        						<button type="button" class="btn btn-info" onclick="event.preventDefault();document.getElementById('detail{{ $ini->id }}').submit();">Lihat Teknisi</button>
	        						<form method="post" action="{{ url('admin/order/technicianDetail') }}" id="detail{{ $ini->id }}">
	        							<input type="hidden" name="technician_id" value="{{ $ini->technician_id }}">
	        							{{ csrf_field() }}
	        						</form>
	        					@endif
	        				</td>
	        				<td>{{ $ini->status }}</td>
	        				<td>
	        					<button type="button" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('delete{{ $ini->id }}').submit();">Tolak</button>
	        					<form method="post" id="delete{{ $ini->id }}" action="{{ url('admin/order/delete') }}">
	        						<input type="hidden" name="id" value="{{ $ini->id }}">
	        						{{ csrf_field() }}
	        					</form>
	        				</td>
	        			</tr>
	        		@endforeach
	        		</tbody>
	        	</table>
	        </div>
	    </div>
    </div>

	{{-- every modal placed here --}}
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <form class="form" method="post" action="{{ url('admin/order/setTechnician') }}">
	      	<div class="form-group">
	      		<label class="label label-default">Teknisi yang terdekat</label>
	      		<div id="technician-menu">
	      			
	      		</div>
	      	</div>
	      	<input type="hidden" name="order_id" id="order_id" value="">
	      	{{ csrf_field() }}
	      	<button type="submit" class="btn btn-default btn-block">Submit</button>
	      </form>
	    </div>

	  </div>
	</div>

@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function(){

	});
	$(".tagsinput").tagsinput({
		freeInput:false,
	});

	function toggleModal(order_id,province,regency,district,village){
		var order = {
			order_id:order_id,
			province:province,
			regency:regency,
			district:district,
			village:village
		};

		$.ajax({
			method:"post",
			url:"{{ url('admin/order/getTechnician') }}",
			data:order
		}).done(function(result){
			console.log(result);
			$("#technician-menu").html("");
			$("#technician-menu").html("<select name='technician_id' class='form-control' id='technician-list'></select>");
			$.each(result,function(key,i){
				$("#technician-list").append("<option value='"+this.id+"'>"+this.name+"</option>");
			});
			$("#order_id").val(order.order_id);

		}).fail(function(error){
			// console.log(error);
		});

		console.log(order);
		$("#myModal").modal();
	}
</script>
@endsection
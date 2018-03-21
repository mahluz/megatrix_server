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
<div class="container-fluid" ng-app="create" ng-controller="AdminController">
	<div class="panel panel-primary">
		<div class="panel-heading">
			Formulis Pembaharuan Data
		</div>
		<div class="panel-body">
			<form class="form" method="post" action="{{url('admin/technician/update')}}">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="label label-primary">Name</label>
							<input type="text" class="form-control" name="name" value="{{ $technician->name }}" required>
						</div>
						<div class="form-group">
							<label class="label label-primary">Email</label>
							<input type="email" class="form-control" name="email" value="{{ $technician->email }}" required>
						</div>
						<div class="form-group">
							<label class="label label-primary">Password</label>
							<input type="password" class="form-control" name="password" required>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="label label-primary">Jenis Kelamin</label>
							<select class="form-control" name="gender" required>
								<option value="Laki-laki">Laki-laki</option>
								<option value="Perempuan">Perempuan</option>
							</select>
						</div>
						<div class="form-group">
							<label class="label label-primary">Nomor Telepon</label>
							<input type="number" class="form-control" name="cp" value="{{ $technician->biodata->cp }}" required>
						</div>
						<div class="form-group">
							<label class="label label-primary">Tanggal lahir</label>
							<input type="date" class="form-control" name="date_of_birth" value="{{ $technician->biodata->date_of_birth }}" required>
						</div>
						<div class="form-group" ng-if="provinces != null">
							<label class="label label-primary">Provinsi</label>
							<select class="form-control" name="province" ng-change="regency()" ng-model="todos.province" required>
								<option ng-repeat="province in provinces" value="@{{province.name}}">@{{province.name}}</option>
							</select>
						</div>
						<div class="form-group" ng-if="regencies != null">
							<label class="label label-primary">Kabupaten</label>
							<select class="form-control" name="regency" ng-change="district()" ng-model="todos.regency" required>
								<option ng-repeat="regency in regencies" value="@{{regency.name}}">@{{regency.name}}</option>
							</select>
						</div>
						<div class="form-group" ng-if="districts != null">
							<label class="label label-primary">Kecamatan</label>
							<select class="form-control" name="district" ng-change="village()" ng-model="todos.district" required>
								<option ng-repeat="district in districts">@{{district.name}}</option>
							</select>
						</div>
						<div class="form-group" ng-if="villages != null">
							<label class="label label-primary">Desa</label>
							<select class="form-control" name="village" ng-model="todos.village" required>
								<option ng-repeat="village in villages">@{{village.name}}</option>
							</select>
						</div>
						<div class="form-group">
							<label class="label label-primary">Alamat Rumah</label>
							<input type="text" class="form-control" name="home_address" value="{{ $technician->biodata->home_address }}" required>
						</div>
						<div class="form-group">
							<label class="label label-primary">Pendidikan Terakhir</label>
							<input type="text" class="form-control" name="last_education" value="{{ $technician->biodata->last_education }}" required>
						</div>
						<div class="form-group">
							<label class="label label-primary">Profesi</label>
							<input type="test" class="form-control" name="profession" value="{{ $technician->biodata->profession }}" required>
						</div>
						<div class="form-group">
							<label class="label label-primary">Skill</label>
							<input type="text" class="form-control" name="skill" value="{{ $technician->biodata->skill }}" required>
						</div>
					</div>
				</div>
				<input type="hidden" name="id" value="{{ $technician->id }}">
				{{csrf_field()}}
				<button type="submit" class="btn btn-success btn-block">Submit</button>
			</form>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	console.log("angular is here!");
	var create = angular.module('create',[]);

	create.controller('AdminController',['$scope','$http',function($scope,$http){
		$scope.todos = [];
		$scope.init = function(){
			$http.post("{{url('api/getProvince')}}").then(result=>{
				$scope.provinces = result.data.result;
			});
		}

		$scope.regency = function(){
			$http.post("{{url('api/getRegency')}}",{province:$scope.todos.province}).then(result=>{
				$scope.regencies = result.data.result;
			});
		}

		$scope.district = function(){
			$http.post("{{url('api/getDistrict')}}",{regency:$scope.todos.regency}).then(result=>{
				$scope.districts = result.data.result;
			});
		}

		$scope.village = function(){
			$http.post("{{url('api/getVillage')}}",{district:$scope.todos.district}).then(result=>{
				$scope.villages = result.data.result;
			});
		}


		$scope.init();
	}]);

</script>
@endsection
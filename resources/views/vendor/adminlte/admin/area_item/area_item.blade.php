@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<section class="content-header">
    <h1>Area item
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="{{ url('/admin_config/area_item')}}">Configuracion</a></li>
        <li class="active"><a href="#">Area item</a></li>
    </ol>
</section>
<br>

	<div class="container-fluid spark-screen">
		<div class="row">

			<div class="row">
				<a href="{{ url('/admin_config/area_item/create') }}" >
					 <div class="col-md-1">
							 <span class="info-box-icon bg-aqua"><i class="fa fa-plus"></i></span>
					 </div>
				</a>
			</div><br>

		@if(session()->has('message'))
		 <div class="alert alert-success alert-dismissible">
							 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							 <h4><i class="icon fa fa-check"></i> Correcto!</h4>
							 {{session()->get('message')}}
						 </div>
		@endif

		<div class="box">
             <div class="box-header">
               <h3 class="box-title">area_item</h3>
             </div>
             <!-- /.box-header -->
             <div class="box-body">
               <table id="example" class="table table-bordered table-striped">
                 <thead>
                 <tr>
									 <th>#</th>
                   <th>Nombre</th>

                 </tr>
                 </thead>
                 <tbody>
								 @foreach ($area_items as $area_item)
                 <tr>
										 <td>{{$area_item->id}}</td>
	                   <td><a href="{{url('admin_config/area_item/'.$area_item->id)}}" >{{$area_item->name}}</td>
										 <td><a href="{{url('admin_config/area_item/'.$area_item->id.'/edit')}}" >
											  <i class="fa fa-fw fa-edit"></i>Editar</a>
										 </td>
										 <td>{{$area_item->created_at->diffForHumans()}}</td>
								 </tr>
								 @endforeach

                 </tfoot>
               </table>
             </div>
             <!-- /.box-body -->
           </div>


		</div>
	</div>
@endsection

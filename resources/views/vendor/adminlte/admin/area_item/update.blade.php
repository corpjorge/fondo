@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')

<section class="content-header">
    <h1>Editar
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
		<li><a href="{{ url('admin_config/area_item')}}">Configuracion</a></li>
			  <li><a href="{{ url ('admin_config/area_item')}}">Area item</a></li><!-- ____Lugar ___ -->
        <li class="active"><a href="#">Editar</a></li>
    </ol>
</section>

<br>
	<div class="container-fluid spark-screen">
		<div class="row">

			<!-- Boton atras-->
			@include('adminlte::admin.area_item.atras')



		<div class="">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Actualizar</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

						{!! Form::open(['url' => 'admin_config/area_item/'.$area_item->id, 'method' => 'PUT']) !!}

							@if (count($errors) > 0)
			            <div class="alert alert-danger">
			                <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
			                <ul>
			                    @foreach ($errors->all() as $error)
			                        <li>{{ $error }}</li>
			                    @endforeach
			                </ul>
			            </div>
			        @endif

							@if(session()->has('message'))
						 	 <div class="alert alert-success alert-dismissible">
						 						 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						 						 <h4><i class="icon fa fa-check"></i> Correcto!</h4>
						 						 {{session()->get('message')}}
						 					 </div>
						  @endif


              <div class="box-body">

								<div class="form-group">
									<label for="name">Nombre</label>
									<input style="color:#555555" type="text" class="form-control" id="name" name="name" placeholder="Nombre">
								</div>


								{{-- <div class="form-group">
								 <label>Usuario</label>
									 <select style="color:#555555" name="usuario" class="form-control">
										 	<option value="{{AAAAAAAAAAAAAAAAAAAA->id}}">{{AAAAAAAAAAAAAAAAAAAA->name}}</option>
										 @foreach (AAAAAAAAAAAAAAAAAAAA as AAAAAAAAAAAAAAAAAAAA)
								 		 	<option style="color:#555555" value="{{AAAAAAAAAAAAAAAAAAAA->id}}">{{AAAAAAAAAAAAAAAAAAAA->name}}</option>
								 		 @endforeach
									 </select>
							 </div> --}}




              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>

           {!! Form::close() !!}}

          </div>

		</div>






		</div>
	</div>
@endsection

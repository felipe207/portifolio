@section('title', 'Portifolios')
@extends('layouts.default')

@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb float-xl-right">
		<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item active"><a href="javascript:;">Portifolio
        </a></li>
	</ol>

	<h1 class="page-header">Portifolio
    </h1>

	<div class="row">
		<div style="width: 100vw">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Lista de Portifolio
                    </h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                        data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                        data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                        data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                        data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
				</div>
				{{-- @include('controle.includes.alert.mensagem') --}}
				<div class="panel-body">
					<div class="btn-group mr-5">
                        <div class="d-flex align-items-center justify-content-center mr-10 mb-3">
                            <a href="{{ route ('controle.portifolio.form') }}"
                            class="btn p-l-40 p-r-40 btn-sm label label-green">
                                Cadastrar
                            </a>
                        </div>
                    </div>
					<table id="data-table-combine"
                    class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th width="30%">Imagem Grande</th>
                                <th width="30%">Imagem Pequena</th>
                                <th width="50%">Título</th>
                                <th width="10%">Subtítulo</th>
                                <th width="50%">Descrição</th>
                                <th width="10%">Cliente</th>
                                <th width="10%">Categoria</th>
								<th width="30%">Opções</th>
							</tr>
						</thead>
						<tbody>
                            @if (isset($portifolios))

                            @foreach ($portifolios as $portifolio)
                            <tr class="odd gradeX">
                                <td width="1%">
                                    <img src="{{ route('imagem.render', 'portifolios/p/' . $portifolio->big_image) }}"
                                    alt="{{ $portifolio->title ?? '' }}">  
                                </td>
                                <td width="1%">
                                    <img src="{{ route('imagem.render', 'portifolios/p/' . $portifolio->small_image) }}"
                                    alt="{{ $portifolio->title ?? '' }}">  
                                </td>
                                <td>
                                    {{ $portifolio->title }}
                                </td>
                                <td>
                                    {{ $portifolio->sub_title }}
                                </td>
                                <td>
                                    {{ $portifolio->description }}
                                </td>
                                <td>
                                    {{ $portifolio->client }}
                                </td>
                                <td>
                                    {{ $portifolio->category }}
                                </td>
                               

                                <td>
                                    <a class="btn btn-primary btn-sm"
                                    href="{{ route('controle.portifolio.form', $portifolio->id) }}">
                                        <i class="fa fa-edit"></i>
                                        Editar
                                    </a>

                                    <a class="btn btn-danger btn-sm"
                                    href="{{ route('controle.portifolio.delete', $portifolio->id) }}">
                                        <i class="fa fa-trash-alt"></i>
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                            @else
                                <tr data-id="empty">
                                    <td colspan="7" class="text-center text-muted p-t-30 p-b-30">
                                        <div class="m-b-10"><i class="fas fa-image fa-4x  "></i></div>
                                        <div>Não há portifolios cadastrados</div>
                                    </td>
                                </tr>
                            @endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
{{--
@component('controle.includes.component.alert-comfirm-delete')
@endcomponent --}}

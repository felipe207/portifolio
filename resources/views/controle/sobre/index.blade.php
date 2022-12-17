@section('title', 'sobres')
@extends('layouts.default')

@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb float-xl-right">
		<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item active"><a href="javascript:;">sobres</a></li>
	</ol>

	<h1 class="page-header">sobres</h1>

	<div class="row">
		<div style="width: 100vw">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Lista de sobres</h4>
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
				@include('controle.includes.alert.mensagem')
				<div class="panel-body">
					<div class="btn-group mr-5">
                        <div class="d-flex align-items-center justify-content-center mr-10 mb-3">
                            <a href="{{ route ('controle.home.sobre.form') }}"
                            class="btn p-l-40 p-r-40 btn-sm label label-green">
                                Cadastrar
                            </a>
                        </div>
                    </div>
					<table id="data-table-combine"
                    class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th width="30%">sobre</th>
                                <th width="50%">link</th>
                                <th width="10%">Ativo</th>
								<th width="30%">Opções</th>
							</tr>
						</thead>
						<tbody>
                            @if ($sobres->count())

                            @foreach ($sobres as $sobre)
                            <tr class="odd gradeX">
                                <td width="1%">
                                    <img src="{{ route('imagem.render', 'sobres/p/' . $sobre->sobre) }}"
                                    alt="{{ $sobre->titulo ?? '' }}">
                                </td>
                                <td>
                                    {{ $sobre->link }}
                                </td>
                                <td>
                                    {{ $sobre->ativo }}
                                </td>

                                <td>
                                    <a class="btn btn-primary btn-sm"
                                    href="{{ route('controle.home.sobre.form', $sobre->id) }}">
                                        <i class="fa fa-edit"></i>
                                        Editar
                                    </a>

                                    <a class="btn btn-danger btn-sm"
                                    href="{{ route('controle.home.sobre.delete', $sobre->id) }}">
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
                                        <div>Não há sobres cadastrados</div>
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

@section('title', 'Cadastrar banners')
@extends('layouts.default')

@section('content')
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        {{-- <li class="breadcrumb-item active"><a href="javascript:;">{{ isset($banner) ? 'Atualização de banner' : 'Cadastro de banner'}}</a></li> --}}
    </ol>

    <h1 class="page-header">Banners</h1>

    <div class="row">
        <div style="width: 100vw">

            <div class="panel panel-inverse">
                <div class="panel-heading">

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

                <div class="panel-body">
                    {{-- {{ $msg ?? '' }} --}}

                    @if (isset($banner->id))
                        {!! Form::model($banner,
                        ['route' => ['controle.home.banner.update',$banner->id],
                         'files' => true,
                        // 'method' => 'PUT'
                        ]) !!}
                    @else
                        {!! Form::model(null, ['route' => 'controle.home.banner.create',
                        'files' => true]) !!}
                    @endif


                    @if (isset($banner))

                    <div class="row mb-4">
                        <img src="{{ route('imagem.render', 'banners/g/' . $banner->banner) }}"
                        alt="{{ $banner->titulo ?? '' }}">
                    </div>
                    @endif

                    <div class="row">

                        <div class="form-group w-75 col-md-3">
                            <label for="banner">Banner -
                                <i> Tamanho ideal <b>1117x389</b></i>
                            </label>
                            <input type="file" accept="image/png, image/jpeg"
                            name="banner" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group w-75 col-md-3">
                            <label for="link">Link</label>
                            {!! Form::text('link', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group w-75 col-md-1">
                            <label for="ativo">Ativo</label>
                            @if (isset($banner))
                            {!! Form::checkbox('ativo', 1, $banner->ativo ?
                             true : false) !!}
                            @else
                            {!! Form::checkbox('ativo', 1, false) !!}
                            @endif
                            {{-- <input type="checkbox" name="ativo" class="form-control"> --}}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary m-r-5">Salvar</button>

                    <a href="{{ route('controle.home.banner.index') }}"
                    class="btn btn-sm btn-default">Cancelar</a>

                    {!! Form::close() !!}

                </div> <!-- panel-body -->

            </div>

        </div>
    </div>
@endsection

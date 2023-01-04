@section('title', 'Cadastrar portifolios')
@extends('layouts.default')

@section('content')
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        {{-- <li class="breadcrumb-item active"><a href="javascript:;">{{ isset($portifolio) ? 'Atualização de portifolio' : 'Cadastro de portifolio'}}</a></li> --}}
    </ol>

    <h1 class="page-header">portifolios</h1>

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
                    @if (isset($portifolio->id))
                        {!! Form::model($portifolio,
                        ['route' => ['controle.portifolio.update',$portifolio->id],
                         'files' => true,
                        ]) !!}
                    @else
                        {!! Form::model(null, ['route' => 'controle.portifolio.create',
                        'files' => true]) !!}
                    @endif


                    @if (isset($portifolio->big_image))

                    <div class="row mb-4">
                        <img src="{{ route('imagem.render', 'portifolios/g/' . $portifolio->big_image) }}"
                        alt="{{ $portifolio->titulo ?? '' }}">
                    </div>
                    @endif

                    @if (isset($portifolio->small_image))

                    <div class="row mb-4">
                        <img src="{{ route('imagem.render', 'portifolios/g/' . $portifolio->small_image) }}"
                        alt="{{ $portifolio->titulo ?? '' }}">
                    </div>
                    @endif

                    <div class="row">

                        <div class="form-group w-75 col-md-3">
                            <label for="big_image">Imagem Grande</label>
                            {{ Form::file('big_image',['class'=>'form-control',
                            'accept'=>'image/png, image/jpeg']) }}
                        </div>
                        <div class="form-group w-75 col-md-3">
                            <label for="big_image">Imagem Grande</label>
                            {{ Form::file('small_image',['class'=>'form-control',
                            'accept'=>'image/png, image/jpeg']) }}
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group w-75 col-md-3">
                            <label for="title">Título</label>
                            {!! Form::text('title', null, ['class' => 'form-control']) !!}
                        </div>
                    
                        <div class="form-group w-100 col-md-3">
                            <label for="sub_title">Subtítulo</label>
                            {!! Form::text('sub_title', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group w-75 col-md-3">
                            <label for="category">Categoria</label>
                            {!! Form::text('category', null, ['class' => 'form-control']) !!}
                        </div>
                    
                        <div class="form-group w-100 col-md-3">
                            <label for="client">Cliente</label>
                            {!! Form::text('client', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="row">
                       
                        <div class="form-group w-75 col-md-3">
                            <label for="description">Descrição</label>
                            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                        </div>
                    
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary m-r-5">Salvar</button>

                    <a href="{{ route('controle.portifolio.index') }}"
                    class="btn btn-sm btn-default">Cancelar</a>

                    {!! Form::close() !!}

                </div> <!-- panel-body -->

            </div>

        </div>
    </div>
@endsection

@php
    $sidebarClass = !empty($sidebarTransparent) ? 'sidebar-transparent' : '';
@endphp

<style>
    .page-sidebar-minified .sidebar-minify-btn i:before {
        content: '\f101' !important;
    }

    #sidebar {
        background: #2d353c;
    }

    .sidebar .nav>li.active>a {
        background: #242b30 !important;
    }

    .nav>li>a i {
        background: 0 0 !important;
        /* color: rgba(255,255,255,.6) !important; */
    }

    .nav>li>a:hover i {
        color: #fff !important;
    }

    /* .nav>li.active>a i {
            color: #0A7A75 !important;
        } */
    .nav>li.expand i {
        color: #fff !important;
    }

    /* a:focus, a:hover {
            color: white !important;
        } */
</style>

<div id="sidebar" class="sidebar">
    <div data-scrollbar="true" data-height="100%">
        <ul class="nav">
            <li class="nav-profile"
                style="background-image: url({{ asset('storage/background_image/' . $config->config['layout']['background_image']) }})">
                <a href="{{ route('dashboard') }}">
                    <div class="image">
                        @if (isset(Auth::user()->imagem))
                            <img src="{{ route('imagem.render', 'user/p/' . Auth::user()->imagem) }}"
                                alt="{{ Auth::user()->name }}" />
                        @else
                            <img src="{{ asset('assets/img/user/user-12.jpg') }}" alt="" />
                        @endif
                    </div>
                    <div class="info">
                        {{ Auth::user()->name }}
                    </div>
                </a>
            </li>
        </ul>

        <ul class="nav">
            <li class="nav-header">Navegação</li>

            <li class="has-sub {{ activeMenu('dashboard') }}">
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            @can('Visualizar usuário')
                <li class="has-sub {{ activeMenu(['controle.usuario', 'controle.roles']) }}">
                    <a href="javascript:;">
                        <b class="caret"></b>
                        <i class="fa fa-lock"></i>
                        <span>Controle de Acesso</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="has-sub {{ activeMenu('controle.usuario') }}">
                            <a href="{{ route('controle.usuario.index') }}">
                                <i class="fas fa-user"></i>
                                <span>Usuários</span>
                            </a>
                        </li>
                        <li class="has-sub {{ activeMenu('controle.roles') }}">
                            <a href="{{ route('controle.roles.index') }}">
                                <i class="fas fa-user-friends"></i>
                                <span>Grupo de usuários</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('Alterar config')
                <li class="has-sub ">
                    <a href="{{ route('controle.main.index') }}">
                        <i class="fas fa-cog"></i>
                        <span>Main</span>
                    </a>
                </li>
            @endcan

            @can('Alterar config')
                <li class="has-sub ">
                    <a href="{{ route('controle.servico.index') }}">
                        <i class="fas fa-cog"></i>
                        <span>Serviço</span>
                    </a>
                </li>
            @endcan

            @can('Alterar config')
                <li class="has-sub ">
                    <a href="{{ route('controle.portifolio.index') }}">
                        <i class="fas fa-cog"></i>
                        <span>Portifólio</span>
                    </a>
                </li>
            @endcan

            @can('Alterar config')
                <li class="has-sub">
                    <a href="{{ route('controle.sobre.index') }}">
                        <i class="fas fa-cog"></i>
                        <span>Sobre</span>
                    </a>
                </li>
            @endcan

            @can('Alterar config')
                <li class="has-sub {{ activeMenu('controle.config') }}">
                    <a href="{{ route('controle.config.edit') }}">
                        <i class="fas fa-cog"></i>
                        <span>Configurações</span>
                    </a>
                </li>
            @endcan

            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                        class="fa fa-angle-double-left"></i></a></li>
        </ul>
    </div>
</div>

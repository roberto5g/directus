<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="/"><i class="icon-speedometer"></i> Dashboard </a>
            </li>



            @if (Auth::user()->tipo == 'administrador')
                <li class="nav-title">
                    menu administrativo
                </li>

                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('om')}}"><i class="fa fa-university"></i>
                            Organização Militar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{route('usuario')}}"><i class="fa fa-user"></i>
                            Usuário</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="{{route('pergunta')}}"><i class="fa fa-tasks"></i>
                            Perguntas</a>
                    </li>

                </ul>

            @endif
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>

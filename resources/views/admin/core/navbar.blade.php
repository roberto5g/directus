<script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
<script src="{{ asset('js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/vendor/jquery.validate.js') }}"></script>
<header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <a class="nav-link" href="/">Siresp 12ªRM -  {{ auth()->user()->om->sigla }}</a>
        </li>

    </ul>
    <ul class="nav navbar-nav ml-auto">


        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle nav-link" id="menu_user">

                <img src="{{ asset('img/tela_inicial/12rm.png') }}" class="img-avatar"> Menu do Usuário
            </a>
            <div class="dropdown-menu dropdown-menu-right escondido" id="menu">

                <div class="text-center">
                    <strong>

                        {{ auth()->user()->om->sigla }}


                    </strong>
                </div>

                <div class="dropdown-header text-center">
                    <strong>Opções</strong>
                </div>
                <a class="dropdown-item" href=""><i
                            class="fa fa-user"></i> Dados Pessoais</a>

                <a href="#" class="dropdown-item" id="senha_modal"><i
                            class="fa fa-lock"></i> Alterar Senha</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="fa fa-sign-out"></i>
                    Sair
                </a>

            </div>
        </li>


    </ul>

    <span class="separaicon"></span>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</header>


<!-- Modal de alterar senha -->
<div class="modal fade" id="senhaModal" tabindex="-1" role="dialog" aria-labelledby="senhaModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="senhaModalLabel">Altere a sua senha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="updatesenha" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="alert alert-simples">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="password_edit">Senha</label>
                                    <input type="password" id="password_edit" name="password_edit" class="form-control"
                                           placeholder="Senha">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="password_confirmation_edit">Repita a Senha</label>
                                    <input type="password" id="password_confirmation_edit"
                                           name="password_confirmation_edit"
                                           class="form-control"
                                           placeholder="Repita a Senha">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <button class="btn btn-outline-secondary btn-block" data-dismiss="modal">
                                    Cancelar
                                </button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-block btn-secondary">
                                    Editar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<script>
    $('#menu_user').on('click', function () {
        $('#menu').fadeToggle();
    });

    $('#senha_modal').on('click', function (e) {

        $('#senhaModal').modal('show')

    })


    $(document).ready(function () {

        $('#updatesenha').validate({
            onkeyup: function (element) {
                $(element).valid();
                console.log($(element).valid())
            },
            rules: {
                password_edit: {
                    required: true,
                    minlength: 8,

                },
                password_confirmation_edit: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password_edit"
                },
            },
            messages: {
                password_edit: {
                    required: "Por favor, informe uma senha.",
                    minlength: "Sua senha deve conter no mínimo 8 caracteres."
                },
                password_confirmation_edit: {
                    required: "Por favor, informe uma senha.",
                    minlength: "Sua senha deve conter no mínimo 8 caracteres.",
                    equalTo: "As senhas não conferem."
                }
            },
            submitHandler: function (form) {
                let user_id = $('#user_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/admin/gerencia/updatesenha/usuario/' + user_id,
                    data: $('#updatesenha').serialize(),

                    success: function (data) {
                        toastr.success('Senha alterado com sucesso!', 'Sucesso!', {timeOut: 3000});
                        $('.modal').modal('hide');
                    },
                    error: function (data) {
                        toastr.error('Não foi possível editar senha!', 'Erro!', {timeOut: 3000});
                    }
                });
            }
        })

    })
    var div = $("#menu_user"); // seleciona a div específica
    $("body").on("click", function (e) {
        if (div.has(e.target).length || e.target == div[0])
            return;

        $('#menu').fadeOut();
    });


</script>
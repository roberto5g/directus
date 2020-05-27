<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->

    <title>Directus - 12ª RM</title>

    <!-- Icons -->
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/simple-line-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.loadingModal.css') }}" rel="stylesheet"/>

    <!-- Main styles for this application -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Styles required by this views -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">

    <script type="text/javascript">
        var isIE = /*@cc_on!@*/false || !!document.documentMode;
        if(isIE == true){
            window.location.href = 'http://directus.12rm.eb.mil.br/errors/400'
        }
    </script>
</head>

<body class="app flex-row align-items-center papelparede">

<div class="container-fluid">


    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">

            {{--form de login--}}
            <div class="card form_login">
                <div class="card-body">

                    {{--cabeçalho--}}
                    <div class="row">
                        <div class="col text-center">
                            <h4>Directus 12ª RM</h4>
                        </div>
                    </div>

                    {{--imagem--}}
                    <div class="row">
                        <div class="col text-center">
                            <img src="img/tela_inicial/logo_login.png" class="logo">
                        </div>
                    </div>

                    <br>

                    {{--login--}}
                    <div class="login">
                        <div class="row">
                            <div class="col">
                                <div class="alert alert-secondary">
                                    <h3 class="text-center"><span>Entre na sua Conta</span></h3>
                                    <form method="POST" action="{{ route('login') }}">
                                        {{ csrf_field() }}
                                        @if ($errors->has('email'))
                                            <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                        @endif

                                        <div class="input-group mb-3">
                                            <span class="input-group-addon"><i class="icon-user"></i></span>
                                            <input type="text" name="username" value="{{ old('username') }}"
                                                   class="form-control"
                                                   required
                                                   autofocus placeholder="Informe seu usuário">
                                        </div>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif

                                        <div class="input-group mb-4">
                                            <span class="input-group-addon"><i class="icon-lock"></i></span>
                                            <input type="password" name="password" class="form-control"
                                                   placeholder="Informe sua Senha"
                                                   required>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rodape">
            @include('static.footer')
        </div>
    </div>
</div>


<!-- Bootstrap and necessary plugins -->
<script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
<script src="{{ asset('js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/vendor/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/vendor/jquery.maskMoney.min.js') }}"></script>
<script src="{{ asset('js/vendor/jquery.validate.js') }}"></script>
<script src="{{ asset('js/vendor/toastr.min.js') }}"></script>
<script src="{{ asset('js/vendor/jquery.loadingModal.js') }}"></script>
<script src="{{ asset('js/app.js')}}"></script>
<script>

    // validate signup form on keyup and submit
    $(document).ready(function () {
        $('.modal').on('hidden.bs.modal', function () {
            $('body').loadingModal('destroy');

            $('input').each(function () {
                $('#cadastro, #recuperar_senha').trigger("reset");
                $(this).removeClass('error');
            });
            var cadastro = $('#cadastro').validate();
            var recuperar_senha = $('#recuperar_senha').validate();
            cadastro.resetForm();
            recuperar_senha.resetForm();


            $('#enviar_email').removeClass('escondido').addClass('aparecer');
            $('.conteudo_erro').val('')
            $('#erro_enviar_email').removeClass('aparecer').addClass('escondido');
        });

        $('.cpf').mask('000.000.000-00', {reverse: true});

        $("#cadastro").validate({
            onkeyup: function (element) {
                $(element).valid();
            },
            errorClass: "error",
            rules: {
                cpf: {
                    cpf: true,
                    required: true,
                    remote: {
                        url: "/admin/gerencia/verificacpf/cadastro",
                        type: "get"
                    }
                },
                nome: "required",
                nome: {
                    required: true,
                    minlength: 10
                },
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "/admin/gerencia/verificaemail/cadastro",
                        type: "get"
                    }
                }
            },
            messages: {
                cpf: {
                    required: "Por favor, informe o seu CPF.",
                    cpf: 'CPF inválido.'
                },
                email: {
                    required: "Por favor, informe o seu email."
                },
                nome: "Por favor, informe o seu nome completo.",
                nome: {
                    required: "Por favor, informe o seu nome.",
                    minlength: "Seu nome deve conter no mínimo 10 caracteres."
                },
                password: {
                    required: "Por favor, informe uma senha.",
                    minlength: "Sua senha deve conter no mínimo 8 caracteres."
                },
                password_confirmation: {
                    required: "Por favor, informe uma senha.",
                    minlength: "Sua senha deve conter no mínimo 8 caracteres.",
                    equalTo: "As senhas não conferem."
                }
            }
        });

        $("#recuperar_senha").validate({
            onkeyup: function (element) {
                $(element).valid();
            },
            errorClass: "error",
            rules: {
                cpf: {
                    cpf: true,
                    required: true,
                    remote: {
                        url: "/admin/gerencia/verificacpf/recuperar",
                        type: "get"
                    }
                },

                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "/admin/gerencia/verificaemail/recuperar",
                        type: "get"
                    }
                }
            },
            messages: {
                cpf: {
                    required: "Por favor, informe o seu CPF.",
                    cpf: 'CPF inválido.'
                },
                email: {
                    required: "Por favor, informe o seu email."
                }
            },
            submitHandler: function (form) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/candidato/gerencia/recuperar/senha',
                    data: $('#recuperar_senha').serialize(),
                    beforeSend: function () {
                        loadingEmail();
                    },
                    complete: function () {
                        $('body').loadingModal('destroy');
                    },
                    success: function (data) {

                        if (data) {
                            $('body').loadingModal('destroy');
                            toastr.success('Email enviado com sucesso!', 'Sucesso!', {timeOut: 3000});
                            $('.modal').modal('hide');
                        } else {
                            $('.conteudo_erro').val('');
                            toastr.error('Email não confere com o CPF informado!', 'Ocorreu um Erro!', {timeOut: 3000});
                            $('#enviar_email').removeClass('aparecer').addClass('escondido');
                            $('.conteudo_erro').html('<p>Email não confere com o CPF informado!</p>');
                            $('#erro_enviar_email').removeClass('escondido').addClass('aparecer');
                        }

                    },
                    error: function (data) {
                        // alert de erro
                        $('.conteudo_erro').val('');
                        toastr.error('Não foi possível enviar email!', 'Ocorreu um Erro!', {timeOut: 3000});
                        $('body').loadingModal('destroy');
                        $('#enviar_email').removeClass('aparecer').addClass('escondido');
                        $('.conteudo_erro').html('<p>Não foi possível enviar um email para <b>'+$('#recuperar_email').val()+'</b>.</p><p>Por favor, entre em contato com <b>sa@sistt.eb.mil.br</b>, e informe o ocorrido.</p>');
                        $('#erro_enviar_email').removeClass('escondido').addClass('aparecer');
                    },
                });

            }
        });

    })

    $('#novo').on('click', function (e) {
        e.preventDefault();
        $('#email').val('');
        $('#email').removeClass('is-invalid');
        $('#ModalNovoCadastro').modal('show');
    });
    $('#recupera_senha').on('click', function (e) {
        e.preventDefault();
        $('#ModalRecuperaSenha').modal('show');
    });


    function loadingEmail() {
        $('body').loadingModal({
            position: 'auto',
            text: 'Aguarde enquanto tentamos enviar o email...',
            color: '#fff',
            opacity: '0.7',
            backgroundColor: 'rgb(0,0,0)',
            animation: 'doubleBounce'
        });
    }

</script>
</body>
</html>
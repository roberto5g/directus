@extends('admin.layout.master')
@section('content')
    @if (Request::session()->has('sucesso'))
        <span id="sucesso" class="disable">{!! Request::session()->get('sucesso')!!}</span>
    @endif
    @if(Request::session()->has('error'))
        <span id="error" class="disable">{!! Request::session()->get('error')!!}</span>
    @endif
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-secondary preto">
                            <div class="row">
                                <div class="col branco text-center">
                                    <h3><i class="fa fa-lock"></i> <span class="audiowide">Redefinição de senha</span>
                                        <i
                                                class="fa fa-lock"></i></h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mb-0 pb-0">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <p>Prezado <b>usuário</b>, por favor preencha os campos abaixo para
                                            redefiniir sua senha.</p>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col">
                                        <form id="alterar_senha_usuario" action="/redefinir/senha/usuario"
                                              method="POST">
                                            {{ csrf_field() }}

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <input type="password" id="password" name="password"
                                                               class="form-control"
                                                               placeholder="Senha"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <input type="password" id="password_confirmation"
                                                               name="password_confirmation" class="form-control"
                                                               placeholder="Repita a Senha">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <button type="submit" class="btn btn-block btn-success">Redefinir
                                                        senha
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>


@endsection
@section('myscript')
    <script>
        $('.logout').addClass('escondido');

        $("#alterar_senha_usuario").validate({
            onkeyup: function (element) {
                $(element).valid();
            },
            errorClass: "error",
            rules: {

                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                },
            },
            messages: {
                password: {
                    required: "Por favor, informe uma senha.",
                    minlength: "Sua senha deve conter no mínimo 6 caracteres."
                },
                password_confirmation: {
                    required: "Por favor, informe uma senha.",
                    minlength: "Sua senha deve conter no mínimo 6 caracteres.",
                    equalTo: "As senhas não conferem."
                }
            }
        });

    </script>
@endsection
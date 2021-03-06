@extends('admin.layout.master')
@section('content')

    <div class="administradores_page">
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="text-center">
                    <div class="alert alert-simples">
                        <h3><i class="fa fa-users"></i> <span class="audiowide">Cadastros de Usuários</span></h3>
                    </div>
                </div>

                <form id="form_cadastrar_usuario" method="POST">
                    <div class="alert alert-simples">

                        {{--Nome completo--}}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">

                                    <label for="nome">Nome Completo</label>
                                    <input type="text" class="form-control caixa_alta" id="nome"
                                           aria-describedby="nomeHelp" name="nome"
                                           placeholder="Insira o nome completo do administrador" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">

                                    <label for="tipo">Tipo</label>
                                    <select class="form-control required"
                                            name="tipo" id="tipo">
                                        <option value="">Selecione um tipo</option>
                                        <option value="administrador">Administrador do sistema</option>
                                        <option value="gerente">Controle de pergunas</option>
                                        <option value="usuario">Usuário</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{--login--}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="login">Login</label>
                                    <input type="text" class="form-control" id="username"
                                           aria-describedby="loginHelp" name="username"
                                           placeholder="Insira o login" required>
                                </div>
                            </div>
                            {{--OM--}}

                            <div id="om" class="col">
                                <div class="form-group">
                                    <label for="om_id" class="preto">Organização Militar</label>
                                    <select class="form-control form_select2 required"
                                            name="om_id" id="om_id">
                                    </select>
                                </div>
                            </div>

                        </div>


                        {{--Senha--}}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">

                                    <label for="password">Senha</label>
                                    <input type="password" id="password" name="password" class="form-control"
                                           placeholder="Informe uma senha"
                                           required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">

                                    <label for="password_confirmation">Repita a Senha</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                           class="form-control"
                                           placeholder="Repita a senha">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <button class="btn btn-block btn-secondary">
                                    Cadastrar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="espacobaixo10"></div>


                <div class="alert alert-simples">
                    <div class="table-responsive">
                        <table id="usuario_table"
                               class="table table-sm table-hover table-bordered table-striped dataTable no-footer">
                            <thead>
                            <tr>
                                <th class="text-center">Nome</th>
                                <th class="text-center">Login</th>
                                <th class="text-center">Organização Militar</th>
                                <th class="text-center">Sigla</th>
                                <th class="text-center">Tipo</th>
                                <th class="text-center">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--modal de editar administrador --}}
    <div class="modal fade" id="ModalEditaAdministrador" role="dialog"
         aria-labelledby="ModalEditaAdministradorTitle" aria-hidden="true">
        <div class="modal-dialog modal-xg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEditaAdministradorTitle">Editar Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{--modal body--}}
                <div class="modal-body">


                    <form id="form_edita_usuario" method="POST">
                        <input type="hidden" id="adm_id" name="adm_id">
                        <div class="alert alert-simples">

                            {{--Nome completo--}}
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">

                                        <label for="nome_edita">Nome Completo</label>
                                        <input type="text" class="form-control caixa_alta" id="nome_edita"
                                               aria-describedby="nome_editaHelp" name="nome"
                                               placeholder="Insira o nome completo do administrador" required>

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">

                                        <label for="tipo_edita">Tipo</label>
                                        <select class="form-control required"
                                                name="tipo" id="tipo_edita">

                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{--login e cpf--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label for="username_edita">Login</label>
                                        <input type="text" class="form-control" id="username_edita"
                                               aria-describedby="login_editaHelp" name="username"
                                               placeholder="Insira o login" required>
                                    </div>
                                </div>

                                {{--OM--}}

                                <div id="om_edita" class="col">
                                    <div class="form-group">
                                        <label for="om_id_edita" class="preto">Organização Militar</label>
                                        <select class="form-control form_select2 required"
                                                name="om_id" id="om_id_edita">
                                        </select>

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

    {{--modal de reseta senha--}}
    <div class="modal fade" id="ModalResetaSenha" tabindex="-1" role="dialog"
         aria-labelledby="ModalResetaSenhaTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalResetaSenhaTitle">Resetar Senha</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{--modal body--}}
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <p>
                            Você deseja resetar a senha do : <b><span class="adm_nome"></span></b>
                        </p>

                        <p>
                            Com isso, ele deverá usar o login cadastrado como senha de acesso.
                        </p>


                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="button"
                                    class="btn btn-danger btn-block resetarSenha">
                                Resetar
                            </button>
                        </div>
                        <div class="col">
                            <button type="button"
                                    class="btn btn-outline-secondary btn-block"
                                    data-dismiss="modal">Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--modal de remover --}}
    <div class="modal fade" id="ModalRemover" tabindex="-1" role="dialog"
         aria-labelledby="ModalRemoverTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalRemoverTitle">Remover Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{--modal body--}}
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <p>
                            Você deseja realmente remover o : <b><span class="mob_nome"></span></b>
                        </p>

                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="button"
                                    class="btn btn-danger btn-block remover">
                                Remover
                            </button>
                        </div>
                        <div class="col">
                            <button type="button"
                                    class="btn btn-outline-secondary btn-block"
                                    data-dismiss="modal">Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('myscript')

    <script>

        $(document).ready(function () {
            // reseta modal

            $('.modal').on('hidden.bs.modal', function () {

                $('input').each(function () {

                    $(this).not('[name=_token]').val('');
                    $(this).removeClass('error');
                });
                $('.error').each(function () {
                    $(this).removeClass('error').addClass('disable');
                })
            })

            $('#usuario_table').DataTable({
                "processing": true,
                "serverSide": true,
                "autoWidth": false,
                "ajax": "/admin/gerencia/getdata/usuario",
                'order': [0, 'desc'],
                'columnDefs': [
                    {
                        "targets": [0, 1, 2, 3, 4,5], // your case first column
                        "className": "text-center",
                    },
                    {
                        "width": "10%", "targets": 0
                    },
                    {
                        "width": "30%", "targets": 1
                    },
                    {
                        "width": "20%", "targets": 2
                    },
                    {
                        "width": "20%", "targets": 2
                    },
                    {
                        "width": "15%", "targets": 4
                    },
                    {
                        "targets": 4,
                        render: function (data) {
                            let tipos = ['administrador', 'gerente', 'usuario'];
                            let tipos_view = ['Administrador do sistema', 'Controle de perguntas', 'Usuário'];
                            for (var i = 0; i < tipos.length; i++) {
                                if (tipos[i] == data) {
                                    if (data == 'administrador') {
                                        return '<h6><span class="badge badge-danger">' + tipos_view[i] + '</span></h6>';
                                    } else if (data == 'gerente') {
                                        return '<h6><span class="badge badge-success">' + tipos_view[i] + '</span></h6>';
                                    } else {
                                        return '<h6><span class="badge badge-secondary">' + tipos_view[i] + '</span></h6>';
                                    }

                                }
                            }

                        }
                    },
                    {
                        "width": "10%", "targets": 5
                    },
                    {
                        "targets": [5],
                        "orderable": false
                    },
                ],

                "columns": [
                    {"data": "nome"},
                    {"data": "username"},
                    {"data": "om.nome"},
                    {"data": "om.sigla"},
                    {"data": "tipo"},
                    {"data": "action"},
                ]
            });

        })

        $('#tipo').on('change', function () {
            if ($(this).valid()) {
                if ($(this).val() != 'usuario') {
                    $('#om').removeClass('enable').addClass('disable');
                } else {
                    $('#om').removeClass('disable').addClass('enable');
                }
            }
        });

        $('#tipo_edita').on('change', function () {
            if ($(this).valid()) {
                if ($(this).val() != 'usuario') {
                    $('#om_edita').removeClass('enable').addClass('disable');
                } else {
                    $('#om_edita').removeClass('disable').addClass('enable');
                }
            }
        });

        function editarSenha(adm) {
            $('#ModalResetaSenha').modal('show')
            $('.adm_nome').text($('#senha_' + adm).data('nome'));
            $('.resetarSenha').attr('onClick', 'senha(' + adm + ');');
        }

        function senha(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '/admin/gerencia/reseta/usuario/' + id,
                success: function (data) {
                    // alert de sucesso
                    toastr.success('Senha resetada com sucesso!', 'Sucesso!', {timeOut: 3000});
                    $('#ofmobilizador_table').DataTable().ajax.reload(null, false); //faz o reaload da view datatable mas mantem a pagina atual

                    $('.modal').modal('hide');
                },
                error: function (data) {
                    toastr.error('Não foi possível resetar senha!', 'Erro!', {timeOut: 3000});
                }
            });
        }


        function remover(adm) {
            $('#ModalRemover').modal('show');
            $('.mob_nome').text($('#remover_' + adm).data('nome'));
            $('.remover').attr('onClick', 'removerAdm(' + adm + ');');
        }

        function removerAdm(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '/admin/gerencia/remove/usuario/' + id,
                success: function (data) {
                    // alert de sucesso
                    toastr.success('Usuario removido com sucesso!', 'Sucesso!', {timeOut: 3000});
                    $('#usuario_table').DataTable().ajax.reload(null, false); //faz o reaload da view datatable mas mantem a pagina atual

                    $('.modal').modal('hide');
                },
                error: function (data) {
                    toastr.error('Não foi possível remover!', 'Erro!', {timeOut: 3000});
                }
            });
        }


        $('#om_id').select2({}).on("change", function (e) {
            $(this).valid()
            let elements = $("[aria-labelledby='select2-om_id-container']");

            if ($(this).valid()) {
                elements.removeClass('error');
            } else {
                elements.addClass('error');
            }
        });

        $('#om_id_edita').select2({}).on("change", function (e) {
            $(this).valid()
            let elements = $("[aria-labelledby='select2-om_id_edita-container']");

            if ($(this).valid()) {
                elements.removeClass('error');
            } else {
                elements.addClass('error');
            }
        });


        $('.form_select2').select2({
            theme: 'bootstrap4',
            width: 'style',
        });

        $('#form_cadastrar_usuario').validate({
            onkeyup: function (element) {
                $(element).valid();
            },
            errorClass: "error",
            errorPlacement: function (error, element) {
                var elem = $(element);
                if (elem.hasClass("select2-hidden-accessible")) {
                    element = $("#select2-" + elem.attr("id") + "-container").parent();
                    error.insertAfter(element);
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element, errorClass, validClass) {
                var elem = $(element);
                if (elem.hasClass("select2-offscreen")) {
                    $("#s2id_" + elem.attr("id") + " ul").addClass(errorClass);
                } else {
                    elem.addClass(errorClass);
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                var elem = $(element);
                if (elem.hasClass("select2-offscreen")) {
                    $("#s2id_" + elem.attr("id") + " ul").removeClass(errorClass);
                } else {
                    elem.removeClass(errorClass);
                }
            },
            rules: {
                nome: {
                    required: true,
                    minlength: 3
                },
                tipo: {
                    required: true,
                },

                om_id: {
                    required: true,
                    depends: function () {
                        let elements = $("[aria-labelledby='select2-om_id-container']");
                        if ($('#om_id').val() === '') {
                            elements.addClass('error');
                        } else {
                            elements.removeClass('error');
                        }
                    }
                },
                password: {
                    required: true,
                    minlength: 3
                },
                password_confirmation: {
                    required: true,
                    minlength: 3,
                    equalTo: "#password"
                },
                username: {
                    required: true,
                    remote: {
                        url: "/admin/gerencia/verificalogin/cadastro",
                        type: "get"
                    }
                }
            },
            messages: {

                username: {
                    required: "Por favor, informe o login."
                },
                om_id: {
                    required: "Por favor, informe uma Organização militar."
                },
                tipo: {
                    required: "Por favor, informe um tipo para o usuário."
                },
                nome: {
                    required: "Por favor, informe o nome.",
                    minlength: "O nome deve conter no mínimo 3 caracteres."
                },
                password: {
                    required: "Por favor, informe uma senha.",
                    minlength: "A senha deve conter no mínimo 8 caracteres."
                },
                password_confirmation: {
                    required: "Por favor, informe uma senha.",
                    minlength: "A senha deve conter no mínimo 8 caracteres.",
                    equalTo: "As senhas não conferem."
                }
            },
            submitHandler: function (form) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/admin/gerencia/cadastra/usuario',
                    data: $('#form_cadastrar_usuario').serialize(),

                    success: function (data) {

                        toastr.success('Oficial usuario cadastrado com sucesso!', 'Sucesso!', {timeOut: 3000});
                        $('#usuario_table').DataTable().ajax.reload(null, false); //faz o reaload da view datatable mas mantem a pagina atual

                        $('#form_cadastrar_usuario')[0].reset();

                        $('#om_id').val('').trigger('change');
                        $("[aria-labelledby='select2-om_id-container']").removeClass('error');
                        $('#om_id-error').removeClass('error').addClass('disable');

                    },
                    error: function (data) {
                        toastr.error('Não foi possível cadastrar usuário!', 'Erro!', {timeOut: 3000});
                    }
                });
            }
        });

        om('om_id');


        function om(om, om_id) {
            $.getJSON('/admin/gerencia/om/lista', function (data) {
                $('#' + om).empty();
                $('#' + om).append("<option value=''>Selecione uma opção</option>");

                if (om == 'om_id_edita') {
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].id == om_id) {
                            $('#' + om).append('<option value="' + data[i].id + '" selected>' + data[i].sigla + '</option>');
                        } else {
                            $('#' + om).append('<option value="' + data[i].id + '">' + data[i].sigla + '</option>');
                        }
                    }
                } else {
                    for (var i = 0; i < data.length; i++) {
                        $('#' + om).append('<option value="' + data[i].id + '">' + data[i].sigla + '</option>');
                    }
                }

            });
        }

        function editarAdmin(id) {

            $('#ModalEditaAdministrador').modal('show');
            $('#adm_id').val(id);

            $('#nome_edita').val($('#edita_' + id).data('nome'));
            $('#username_edita').val($('#edita_' + id).data('login'));
            let tipo = $('#edita_' + id).data('tipo');


            if (tipo != 'usuario') {
                $('#om_edita').removeClass('enable').addClass('disable');
            } else {
                $('#om_edita').removeClass('disable').addClass('enable');
            }


            $('#tipo_edita').empty();
            let tipos = ['administrador', 'gerente', 'usuario'];
            let tipos_view = ['Administrador do sistema', 'Controle de perguntas', 'Usuário'];
            for (var i = 0; i < tipos.length; i++) {
                if (tipos[i] == tipo) {
                    $('#tipo_edita').append('<option value="' + tipos[i] + '" selected>' + tipos_view[i] + '</option>');
                } else {
                    $('#tipo_edita').append('<option value="' + tipos[i] + '">' + tipos_view[i] + '</option>');
                }
            }

            om('om_id_edita', $('#edita_' + id).data('om_id'))

        }


        $('#form_edita_usuario').validate({
            onkeyup: function (element) {
                $(element).valid();
            },
            errorClass: "error",
            errorPlacement: function (error, element) {
                var elem = $(element);
                if (elem.hasClass("select2-hidden-accessible")) {
                    element = $("#select2-" + elem.attr("id") + "-container").parent();
                    error.insertAfter(element);
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element, errorClass, validClass) {
                var elem = $(element);
                if (elem.hasClass("select2-offscreen")) {
                    $("#s2id_" + elem.attr("id") + " ul").addClass(errorClass);
                } else {
                    elem.addClass(errorClass);
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                var elem = $(element);
                if (elem.hasClass("select2-offscreen")) {
                    $("#s2id_" + elem.attr("id") + " ul").removeClass(errorClass);
                } else {
                    elem.removeClass(errorClass);
                }
            },
            rules: {
                nome: {
                    required: true,
                    minlength: 3
                },
                tipo: {
                    required: true,
                },

                om_id: {
                    required: true,
                    depends: function () {
                        let elements = $("[aria-labelledby='select2-om_id_edita-container']");
                        if ($('#om_id_edita').val() === '') {
                            elements.addClass('error');
                        } else {
                            elements.removeClass('error');
                        }
                    }
                },
                login: {
                    required: true,
                    remote: {
                        url: "/admin/gerencia/verificalogin/editar",
                        type: "get",
                        data: {
                            login: function () {
                                return $('#username_edita').val();
                            },
                            adm_id: function () {
                                return $('#adm_id').val();
                            }
                        },
                    }
                }
            },
            messages: {
                username: {
                    required: "Por favor, informe o login."
                },
                om_id: {
                    required: "Por favor, informe uma Organização militar."
                },
                nome: {
                    required: "Por favor, informe o nome.",
                    minlength: "O nome deve conter no mínimo 3 caracteres."
                },
                tipo: {
                    required: "Por favor, informe um tipo para o usuário."
                },
            },
            submitHandler: function (form) {

                let adm_id = $('#adm_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/admin/gerencia/edita/usuario/' + adm_id,
                    data: $('#form_edita_usuario').serialize(),

                    success: function (data) {

                        console.log(data)
                        toastr.success('Usuário editado com sucesso!', 'Sucesso!', {timeOut: 3000});
                        $('#usuario_table').DataTable().ajax.reload(null, false); //faz o reaload da view datatable mas mantem a pagina atual

                        $('#form_edita_usuario')[0].reset();

                        $('#om_id_edita').val('').trigger('change');
                        $("[aria-labelledby='select2-om_id_edita-container']").removeClass('error');
                        $('#om_id_edita-error').removeClass('error').addClass('disable');

                        $('.modal').modal('hide');
                    },
                    error: function (data) {
                        toastr.error('Não foi possível editar Usuário!', 'Erro!', {timeOut: 3000});
                    }
                });
            }
        });

        $('#cpf').mask('000.000.000-00', {reverse: true});
        $('#cpf_edita').mask('000.000.000-00', {reverse: true});
        $('#identidade_mil').mask('000000000-0', {reverse: true});
        $('.phone-mask').mask('(00) 0000-00009');
        $('.phone-mask').blur(function (event) {
            if ($(this).val().length == 15) { // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
                $(this).mask('(00) 00000-0009');
            } else {
                $(this).mask('(00) 0000-00009');
            }
        });

    </script>
@endsection

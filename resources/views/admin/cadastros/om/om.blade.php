@extends('admin.layout.master')
@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="text-center">
                <div class="alert alert-simples">
                    <h3><i class="fa fa-users"></i> <span class="audiowide">Gerenciamento de Organização Militar</span>
                    </h3>
                </div>
            </div>

            {{--formulario--}}
            <div class="row">
                {{-- formulario --}}
                <div class="col-md-4">
                    <form id="form_nova_om" method="post">
                        <div class="alert alert-simples">

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="nome">Nome da Organização Militar</label>
                                        <input type="text" class="form-control formatar_nome" id="nome"
                                               aria-describedby="nomeHelp" name="nome"
                                               placeholder="Insira o nome da Organização Militar" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="sigla">Sigla da Organização Militar</label>
                                        <input type="text" class="form-control" id="sigla"
                                               aria-describedby="siglaHelp" name="sigla"
                                               placeholder="Insira a sigla da Organização Militar" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-block btn-secondary">
                                        Cadastrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- tabela --}}
                <div class="col">
                    <div class="alert alert-simples">
                        <div class="table-responsive">
                            <table id="om_table" class="table table-sm table-hover table-bordered table-striped dataTable no-footer">
                                <thead>
                                <tr>
                                    <th class="text-center">Nome</th>
                                    <th class="text-center">Sigla</th>
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
    </div>

    {{--Modal de editar organização militar--}}
    <div class="modal fade" id="ModalEditaOrganizacaoMilitar" role="dialog"
         aria-labelledby="ModalEditaOrganizacaoMilitarTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEditaOrganizacaoMilitarTitle">Edição de Organização Militar</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{--modal body--}}
                <div class="modal-body">


                    <form id="form_edita_om" method="post">
                        <div class="alert alert-simples">
                            <input type="hidden" id="om_id">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="nome_edita">Nome da Organização Militar</label>
                                        <input type="text" class="form-control formatar_nome" id="nome_edita"
                                               aria-describedby="nome_editaHelp" name="nome"
                                               placeholder="Insira o nome da Organização Militar" required>
                                        <small id="nome_editaHelp" class="form-text text-muted">Nome da Organização, ex:
                                            "Comando da 12ª Região Militar".
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sigla_Edita">Sigla da Organização Militar</label>
                                        <input type="text" class="form-control" id="sigla_edita"
                                               aria-describedby="sigla_editaHelp" name="sigla"
                                               placeholder="Insira a sigla da Organização Militar" required>
                                        <small id="sigla_editaHelp" class="form-text text-muted">Sigla da Organização, ex:
                                            "CMDO 12ªRM".
                                        </small>
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

    {{--Modal de inativa organização militar--}}
    <div class="modal fade" id="ModalInativaOrganizacaoMilitar" tabindex="-1" role="dialog"
         aria-labelledby="ModalInativaOrganizacaoMilitarTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalInativaOrganizacaoMilitarTitle">Inativar Organização Militar</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{--modal body--}}
                <div class="modal-body">
                    <div class="alert alert-simples">
                        <div class="form-group">
                            Ao Remover uma Organização Militar, todos as informações se
                            tornarão inúteis para o sistema.<br>
                        </div>
                        <div class="alert alert-danger">
                            <p class="text-center">
                                Você realmente deseja remover a Organização Militar:<br>

                                <span class="om_nome"></span>?
                            </p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="button"
                                    class="btn btn-danger btn-block botao_remove">
                                <i class="fa fa-exclamation-triangle blink"></i>
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
            // necessário para o funcionamento do select
            $('.form_select2').select2({
                theme: 'bootstrap4',
                width: 'style',
            });

            $('.modal').on('hidden.bs.modal', function () {
                $('input').each(function () {
                    $(this).not('[name=_token]').val('');
                    $(this).removeClass('error');
                });
                $('.error').each(function () {
                    $(this).removeClass('error').addClass('disable');
                })

            })

        })

        $('#om_table').DataTable({
            "processing": true,
            "serverSide": true,
            "autoWidth": false,
            "ajax": "/admin/gerencia/lista/om",
            'order': [0, 'desc'],
            'columnDefs': [
                {
                    "targets": [0, 1,2], // your case first column
                    "className": "text-center",
                },
                {
                    "width": "70%", "targets": 0
                },
                {
                    "width": "10%", "targets": 1
                },
                {
                    "width": "10%", "targets": 2
                },
                {
                    "targets": 2,
                    "orderable": false
                },
            ],
            "columns": [
                {"data": "nome"},
                {"data": "sigla"},
                {"data": "action"},
            ]
        });



        $('#form_nova_om').validate({
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
                sigla: {
                    required: true,
                    minlength: 3
                },
            },
            messages: {
                nome: {
                    required: "Por favor, informe o nome da Om.",
                    minlength: "O nome deve conter no mínimo 3 caracteres."
                },
                sigla: {
                    required: "Por favor, informe a sigla da Om.",
                    minlength: "O sigla deve conter no mínimo 3 caracteres."
                },

            },
            submitHandler: function (form) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/admin/gerencia/cadastro/om',
                    data: $('#form_nova_om').serialize(),

                    success: function (data) {

                        toastr.success('Organização Militar cadastrada com sucesso!', 'Sucesso!', {timeOut: 3000});
                        $('#om_table').DataTable().ajax.reload(null, false); //faz o reaload da view datatable mas mantem a pagina atual

                        $('input').each(function () {
                            $(this).not('[name=_token]').val('');
                            $(this).removeClass('error');
                        });
                        $('.error').each(function () {
                            $(this).removeClass('error').addClass('disable');
                        })

                    },
                    error: function (data) {
                        toastr.error('Não foi possível cadastrar área!', 'Erro!', {timeOut: 3000});
                    }
                });
            }
        });

        // edita organização militar
        function editaOm(id) {
            $('#ModalEditaOrganizacaoMilitar').modal('show')
            $('#om_id').val(id);
            $.getJSON('/admin/gerencia/edita/om/' + id, function (om) {

                $('#nome_edita').val(om.nome);
                $('#sigla_edita').val(om.sigla);

            })
        }

        // form de editar organização militar

        $('#form_edita_om').validate({
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
                sigla: {
                    required: true,
                    minlength: 3
                },
            },
            messages: {
                nome: {
                    required: "Por favor, informe o nome da Om.",
                    minlength: "O nome deve conter no mínimo 3 caracteres."
                },
                sigla: {
                    required: "Por favor, informe a sigla da Om.",
                    minlength: "O sigla deve conter no mínimo 3 caracteres."
                },

            },
            submitHandler: function (form) {

                let om_id = $('#om_id').val();
                $.ajaxSetup({
                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/admin/gerencia/edita/om/'+om_id,
                    data: $('#form_edita_om').serialize(),

                    success: function (data) {

                        toastr.success('Organização Militar editada com sucesso!', 'Sucesso!', {timeOut: 3000});
                        $('#om_table').DataTable().ajax.reload(null, false); //faz o reaload da view datatable mas mantem a pagina atual
                        $('#form_edita_om')[0].reset();

                        $('#nome_edita-error').removeClass('error').addClass('disable');
                        $('#nome_edita').removeClass('error');

                        $('.modal').modal('hide');
                    },
                    error: function (data) {
                        toastr.error('Não foi possível editar om!', 'Erro!', {timeOut: 3000});
                    }
                });
            }
        })


        $(document).on('click', '.remover_om', function () {
            $('.om_nome').text($(this).data('nome'));

            $('#ModalInativaOrganizacaoMilitar').modal('show');
            $('.botao_remove').attr('onClick', 'remover(' + $(this).data('id') + ');');
        });

        function remover(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '/admin/gerencia/remove/om/' + id,
                success: function (data) {
                    // alert de sucesso
                    toastr.success('Om removida com sucesso!', 'Sucesso!', {timeOut: 3000});
                    $('#om_table').DataTable().ajax.reload(null, false); //faz o reaload da view datatable mas mantem a pagina atual
                    $('.modal').modal('hide');
                },
                error: function (data) {
                    toastr.error('Não foi possível inativar Região Miltiar!', 'Erro!', {timeOut: 3000});
                }
            });
        }

    </script>
@endsection

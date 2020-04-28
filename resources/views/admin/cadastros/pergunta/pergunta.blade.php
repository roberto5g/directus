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
            <div class="text-center">
                <div class="alert alert-simples">
                    <h3><i class="fa fa-tasks"></i> <span class="audiowide">Gerenciamento de Perguntas</span>
                    </h3>
                </div>
            </div>

            {{--formulario--}}
            <div class="row">
                <div class="col">
                    <form id="form_nova_pergunta" action="/admin/gerencia/cadastro/pergunta" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="alert alert-simples">

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="descricao">Faça uma pergunta</label>
                                        <input type="text" class="form-control" id="descricao"
                                               aria-describedby="descricaoHelp" name="descricao"
                                               placeholder="Insira a descrição da pergunta" required>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-dark">
                                <h6>
                                    <span class="audiowide">Anexo</span>
                                </h6>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group main-section">
                                            <div class="file-loading">
                                                <input id="anexo"
                                                       type="file"
                                                       name="anexo">
                                            </div>
                                        </div>
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
            </div>
            <div class="row">
                {{-- tabela --}}
                <div class="col">
                    <div class="alert alert-simples">
                        <div class="table-responsive">
                            <table id="pegunta_table"
                                   class="table table-sm table-hover table-bordered table-striped dataTable no-footer">
                                <thead>
                                <tr>
                                    <th class="text-center">Pergunta</th>
                                    <th class="text-center">Anexo</th>
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

    {{--Modal de editar--}}
    <div class="modal fade" id="ModalEdita" role="dialog"
         aria-labelledby="ModalEditaTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEditaTitle">Edição de Períodos</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{--modal body--}}
                <div class="modal-body">


                    <form id="form_edita_periodo" method="post">
                        <div class="alert alert-simples">
                            <input type="hidden" id="periodo_id">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="inicio_edita">Data de Início</label>
                                        <input type="date" class="form-control " id="inicio_edita"
                                               aria-describedby="inicioHelp" name="inicio"
                                               placeholder="Insira a data de início" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="fim_edita">Data de Fim</label>
                                        <input type="date" class="form-control " id="fim_edita"
                                               aria-describedby="nomeHelp" name="fim"
                                               placeholder="Insira a data de fim" required>
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

        $('#pegunta_table').DataTable({
            "processing": true,
            "serverSide": true,
            "autoWidth": false,
            "ajax": "/admin/gerencia/lista/pergunta/getdata",
            'order': [0, 'desc'],
            'columnDefs': [
                {
                    "targets": [0, 1, 2], // your case first column
                    "className": "text-center",
                },
                {
                    "width": "70%", "targets": 0
                },
                {
                    "width": "20%", "targets": 1
                },
                {
                    "targets": 1, render: function (data) {
                        if(data){
                            return '<a href="/storage/'+data+'" target="_blank" class="vermelho"><i class="fa fa-search"> anexo</i></a>';
                        } else {
                            return '-';
                        }

                    }
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
                {"data": "descricao"},
                {"data": "anexo"},
                {"data": "action"},
            ]
        });


        $('#form_nova_pergunta').validate({
            onkeyup: function (element) {
                $(element).valid();
            },
            errorClass: "error",
            rules: {
                descricao: {
                    required: true,
                },

            },
            messages: {
                descricao: {
                    required: "Por favor, informe uma descrição para a pergunta.",
                },
            },
        });

        // edita organização militar
        function editaPeriodo(id) {
            $('#ModalEdita').modal('show');
            $('#periodo_id').val(id);

            $('#inicio_edita').val($('#edita_' + id).data('inicio'));
            $('#fim_edita').val($('#edita_' + id).data('fim'));
        }

        // form de editar organização militar

        $('#form_edita_periodo').validate({
            onkeyup: function (element) {
                $(element).valid();
            },
            errorClass: "error",
            rules: {
                inicio: {
                    required: true,
                },
                fim: {
                    required: true,
                },
            },
            messages: {
                inicio: {
                    required: "Por favor, informe a data de início.",
                },
                fim: {
                    required: "Por favor, informe a data de fim.",
                },

            },
            submitHandler: function (form) {

                let periodo_id = $('#periodo_id').val();
                $.ajaxSetup({
                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/admin/gerencia/edita/pergunta/' + periodo_id,
                    data: $('#form_edita_periodo').serialize(),

                    success: function (data) {

                        toastr.success('Período editado com sucesso!', 'Sucesso!', {timeOut: 3000});
                        $('#periodo_table').DataTable().ajax.reload(null, false); //faz o reaload da view datatable mas mantem a pagina atual
                        $('#form_edita_periodo')[0].reset();

                        $('#inicio_edita-error').removeClass('error').addClass('disable');
                        $('#fim_edita').removeClass('error');

                        $('.modal').modal('hide');
                    },
                    error: function (data) {
                        toastr.error('Não foi possível editar!', 'Erro!', {timeOut: 3000});
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

        $('.documento_comprobatorio').fileinput({
            theme: 'fa',
            uploadUrl: "/",
            required: true,
            dropZoneEnabled: false,
            allowedFileExtensions: ['jpg', 'jpeg', 'png', 'pdf'],
            overwriteInitial: false,
            maxFileSize: 2000,
            maxFilesNum: 10
        });
    </script>
@endsection

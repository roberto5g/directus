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
                                        <textarea name="descricao" class="form-control" id="descricao"
                                                  type="text" rows="5" cols="30" dir="ltr"
                                                  placeholder="Insira a descrição da pergunta" required></textarea>

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
                                                <input id="anexo" type="file"
                                                       name="anexo" class="file documento_comprobatorio"
                                                       data-browse-on-zone-click="false"
                                                       data-overwrite-initial="false"
                                                       data-min-file-count="2"
                                                       data-show-preview="false">
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
                                    <th class="text-center">Status</th>
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
                    <h5 class="modal-title" id="ModalEditaTitle">Edição de Pergunta</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{--modal body--}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <form id="form_edita_pergunta" action="/admin/gerencia/edita/pergunta" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" id="pergunta_id" name="pergunta_id">
                                <div class="alert alert-simples">

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="descricao_edita">Faça uma pergunta</label>
                                                <textarea name="descricao" class="form-control" id="descricao_edita"
                                                          type="text" rows="5" cols="30" dir="ltr"
                                                          placeholder="Informe sua resposta" required></textarea>
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
                                                        <input id="anexo_edita" type="file"
                                                               name="anexo" class="file documento_comprobatorio"
                                                               data-browse-on-zone-click="false"
                                                               data-overwrite-initial="false"
                                                               data-min-file-count="2"
                                                               data-show-preview="false">
                                                    </div>
                                                </div>
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
        </div>
    </div>

    {{--modal de remover --}}
    <div class="modal fade" id="ModalRemover" tabindex="-1" role="dialog"
         aria-labelledby="ModalRemoverTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalRemoverTitle">Remover Pergunta</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{--modal body--}}
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <p>
                            Você deseja realmente remover <b><br><span class="pergunta_descricao"></span></b>
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

    {{--modal de inativar --}}
    <div class="modal fade" id="ModalInativar" tabindex="-1" role="dialog"
         aria-labelledby="ModalRemoverTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalInativarTitle">Inativar Pergunta</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{--modal body--}}
                <div class="modal-body">
                    <div class="alert alert-secondary">
                        <p>
                            Você deseja realmente inativar <b><br><span class="pergunta_descricao"></span></b>
                        </p>

                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="button"
                                    class="btn btn-secondary btn-block inativa">
                                Inativar
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
            $('[data-toggle="tooltip"]').tooltip();


            $('.modal').on('hidden.bs.modal', function () {
                $('input').each(function () {
                    $(this).not('[name=_token]').val('');
                    $(this).removeClass('error');
                });
                $('.error').each(function () {
                    $(this).removeClass('error').addClass('disable');
                })

            })

        });

        $('#pegunta_table').DataTable({
            "processing": true,
            "serverSide": true,
            "autoWidth": false,
            "ajax": "/admin/gerencia/lista/pergunta/getdata",
            'order': [0, 'desc'],
            'columnDefs': [
                {
                    "targets": [0, 1, 2,3], // your case first column
                    "className": "text-center",
                },
                {
                    "width": "60%", "targets": 0
                },
                {
                    "width": "20%", "targets": 1
                },
                {
                    "width": "10%", "targets": 2
                },
                {
                    "targets": 1, render: function (data) {
                        if(data){
                            return '<h6><a href="/storage/'+data+'" target="_blank" class="vermelho"><i class="fa fa-clipboard"> anexo</i></a></h6>';
                        } else {
                            return '-';
                        }

                    }
                },
                {
                    "targets": 2, render: function (data) {
                        if(data == 'Ativo'){
                            return '<h6><span class="badge badge-success">'+data+'</span></h6>';
                        } else {
                            return '<h6><span class="badge badge-warning">'+data+'</span></h6>';
                        }

                    }
                },
                {
                    "width": "10%", "targets": 3
                },
                {
                    "targets": 3,
                    "orderable": false
                },
            ],
            "columns": [
                {"data": "descricao"},
                {"data": "anexo"},
                {"data": "status"},
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

        //
        function editaPergunta(id) {
            $('#ModalEdita').modal('show');
            $('#pergunta_id').val(id);

            $('#descricao_edita').val($('#edita_' + id).data('descricao'));

        }

        // form de editar organização militar

        $('#form_edita_pergunta').validate({
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
        })

        function removePergunta(id) {
            $('#ModalRemover').modal('show');
            $('.pergunta_descricao').text($('#remove_'+id).data('descricao'));
            $('.remover').attr('onClick', 'remover(' + id + ');');
        }

        function inativaPergunta(id) {
            $('#ModalInativar').modal('show');
            $('.pergunta_descricao').text($('#inativa_'+id).data('descricao'));
            $('.inativa').attr('onClick', 'inativa(' + id + ');');
        }

        function remover(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '/admin/gerencia/remove/pergunta/' + id,
                success: function (data) {
                    // alert de sucesso
                    toastr.success('Pergunta removida com sucesso!', 'Sucesso!', {timeOut: 3000});
                    $('#pegunta_table').DataTable().ajax.reload(null, false); //faz o reaload da view datatable mas mantem a pagina atual

                    $('.modal').modal('hide');
                },
                error: function (data) {
                    toastr.error('Não foi possível remover!', 'Erro!', {timeOut: 3000});
                }
            });
        }

        function ativarPergunta(id) {
            $.ajax({
                type: 'get',
                url: '/admin/gerencia/ativar/pergunta/' + id,
                success: function (data) {
                    // alert de sucesso
                    toastr.success('Pergunta ativada com sucesso!', 'Sucesso!', {timeOut: 3000});
                    $('#pegunta_table').DataTable().ajax.reload(null, false); //faz o reaload da view datatable mas mantem a pagina atual

                    $('.modal').modal('hide');
                },
                error: function (data) {
                    toastr.error('Não foi possível remover!', 'Erro!', {timeOut: 3000});
                }
            });
        }

        function inativa(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '/admin/gerencia/inativa/pergunta/' + id,
                success: function (data) {
                    // alert de sucesso
                    toastr.success('Pergunta inativada com sucesso!', 'Sucesso!', {timeOut: 3000});
                    $('#pegunta_table').DataTable().ajax.reload(null, false); //faz o reaload da view datatable mas mantem a pagina atual

                    $('.modal').modal('hide');
                },
                error: function (data) {
                    toastr.error('Não foi possível remover!', 'Erro!', {timeOut: 3000});
                }
            });
        }
    </script>
@endsection

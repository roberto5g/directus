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
                    <form id="form_nova_pergunta" action="/admin/gerencia/cadastro/pergunta" method="post"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="alert alert-simples">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="descricao">Faça uma pergunta</label>
                                        <textarea name="descricao" class="form-control" id="descricao" type="text"
                                                  autofocus rows="5" cols="30" dir="ltr"
                                                  placeholder="Insira a descrição da pergunta" required></textarea>

                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-dark">
                                <h6>
                                    <span>Anexar documento de referência</span>
                                </h6>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group main-section">
                                            <div class="file-loading">
                                                <input id="anexo" type="file" name="anexo"
                                                       class="file documento_comprobatorio"
                                                       data-browse-on-zone-click="false" data-overwrite-initial="false"
                                                       data-min-file-count="2" data-show-preview="false">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="alert alert-primary">
                                            <small id="formatoHelp"
                                                   class="form-text text-center">
                                                <b>Só serão aceitos arquivos nos seguintes formatos:
                                                    ( jpg, jpeg, png,
                                                    pdf, doc, docx, dotx, txt, cvs, ods,
                                                    xls, odp, odt, pps, ppsx, ppt, pptx e zip) e com tamanho máximo de
                                                    2mb.</b>

                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-silver">
                                <div class="row">
                                    <div class="col">
                                        <div class="text-center">
                                            <h6><span>Selecione a(às) OM que devem responder a pergunta </span></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    {{--areas de atuação disponíveis--}}
                                    <div class="col-md-5">
                                        <div class="text-center">
                                            <span for="search">OM Disponível</span>
                                        </div>
                                        <select id="search" class="form-control" size="8" multiple="multiple">
                                        </select>
                                    </div>

                                    {{--options--}}
                                    <div class="col-md-2">
                                        <div class="text-center">
                                            <label>Opções</label>
                                        </div>
                                        <div class="espacobaixo10"></div>
                                        <button type="button" id="search_rightAll" class="btn btn-block"><i
                                                    class="fa fa-forward"></i></button>
                                        <button type="button" id="search_rightSelected" class="btn btn-block"><i
                                                    class="fa fa-chevron-right "></i></button>
                                        <button type="button" id="search_leftSelected" class="btn btn-block"><i
                                                    class="fa fa-chevron-left"></i></button>
                                        <button type="button" id="search_leftAll" class="btn btn-block">
                                            <i class="fa fa-backward"></i></button>
                                    </div>


                                    <div class="col-md-5">
                                        <div class="text-center">
                                            <span for="search_to">OM Selecionada</span>
                                        </div>
                                        <select name="om_pergunta[]" id="search_to" class="form-control om_pergunta"
                                                size="8" multiple="multiple"></select>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-block btn-success">
                                        Cadastrar Pergunta
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
    <div class="modal fade" id="ModalEdita" role="dialog" aria-labelledby="ModalEditaTitle" aria-hidden="true">
        <div class="modal-dialog modal-xg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEditaTitle">Edição de Pergunta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{--modal body--}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <form id="form_edita_pergunta" action="/admin/gerencia/update/pergunta" method="POST"
                                  enctype="multipart/form-data">
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
                                            <span>Anexar documento de referência</span>
                                        </h6>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group main-section">
                                                    <div class="file-loading">
                                                        <input id="anexo_edita" type="file" name="anexo"
                                                               class="file documento_comprobatorio"
                                                               data-browse-on-zone-click="false"
                                                               data-overwrite-initial="false" data-min-file-count="2"
                                                               data-show-preview="false">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="alert alert-primary">
                                                    <small id="formatoHelp"
                                                           class="form-text text-center">
                                                        <b>Só serão aceitos arquivos nos seguintes formatos:
                                                            ( jpg, jpeg, png,
                                                            pdf, doc, docx, dotx, txt, cvs, ods,
                                                            xls, odp, odt, pps, ppsx, ppt, pptx e zip) e com tamanho
                                                            máximo de 2mb.</b>

                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="alert alert-silver">
                                        <div class="row">
                                            <div class="col">
                                                <div class="text-center">
                                                    <h6><span>Selecione a(às) OM que devem responder a pergunta </span>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="text-center">
                                                    <label for="search2">OM Disponível</label>
                                                </div>
                                                <select id="search2" class="form-control" size="8" multiple="multiple">
                                                </select>
                                            </div>

                                            {{--options--}}
                                            <div class="col-md-2">
                                                <div class="text-center">
                                                    <label>Opções</label>
                                                </div>
                                                <div class="espacobaixo10"></div>
                                                <button type="button" id="search2_rightAll" class="btn btn-block"><i
                                                            class="fa fa-forward"></i></button>
                                                <button type="button" id="search2_rightSelected" class="btn btn-block">
                                                    <i class="fa fa-chevron-right "></i></button>
                                                <button type="button" id="search2_leftSelected" class="btn btn-block"><i
                                                            class="fa fa-chevron-left"></i></button>
                                                <button type="button" id="search2_leftAll" class="btn btn-block">
                                                    <i class="fa fa-backward"></i></button>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="text-center">
                                                    <label for="search2_to">OM Selecionada</label>
                                                </div>
                                                <select name="om_pergunta[]" id="search2_to"
                                                        class="form-control om_pergunta" size="8"
                                                        multiple="multiple"></select>
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
                                                Editar Pergunta
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
    <div class="modal fade" id="ModalRemover" tabindex="-1" role="dialog" aria-labelledby="ModalRemoverTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalRemoverTitle">Remover Pergunta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{--modal body--}}
                <div class="modal-body">
                    <div class="alert alert-danger text-center">
                        Você deseja realmente remover?
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-danger btn-block remover">
                                Remover
                            </button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-outline-secondary btn-block" data-dismiss="modal">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--modal de inativar --}}
    <div class="modal fade" id="ModalInativar" tabindex="-1" role="dialog" aria-labelledby="ModalRemoverTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalInativarTitle">Inativar Pergunta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{--modal body--}}
                <div class="modal-body">
                    <div class="alert alert-secondary text-center">
                        Você deseja realmente inativar?
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-secondary btn-block inativa">
                                Inativar
                            </button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-outline-secondary btn-block" data-dismiss="modal">
                                Cancelar
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

            CKEDITOR.replace('descricao');
            CKEDITOR.replace('descricao_edita');

            $('[data-toggle="tooltip"]').tooltip();
            $('.modal').on('hidden.bs.modal', function () {
                $('input').each(function () {
                    $(this).not('[name=_token]').val('');
                    $(this).removeClass('error');
                });
                $('.error').each(function () {
                    $(this).removeClass('error').addClass('disable');
                });
                $("#search2_to").empty();
            });

        });

        $('#pegunta_table').DataTable({
            "processing": true,
            "serverSide": true,
            "autoWidth": false,
            "ajax": "/admin/gerencia/lista/pergunta/getdata",
            'order': [0, 'desc'],
            'columnDefs': [{
                "targets": [1, 2, 3], // your case first column
                "className": "text-center",
            },
                {
                    "width": "60%",
                    "targets": 0,
                    render: function (data) {
                        return strip(data);
                    }
                },
                {
                    "width": "20%",
                    "targets": 1
                },
                {
                    "width": "10%",
                    "targets": 2
                },
                {
                    "targets": 1,
                    render: function (data) {
                        if (data) {
                            return '<h6><a href="/storage/' + data + '" target="_blank" class="vermelho"><i class="fa fa-clipboard"> anexo</i></a></h6>';
                        } else {
                            return '-';
                        }

                    }
                },
                {
                    "targets": 2,
                    render: function (data) {
                        if (data == 'Ativo') {
                            return '<h6><span class="badge badge-success">' + data + '</span></h6>';
                        } else {
                            return '<h6><span class="badge badge-warning">' + data + '</span></h6>';
                        }

                    }
                },
                {
                    "width": "10%",
                    "targets": 3
                },
                {
                    "targets": 3,
                    "orderable": false
                },
            ],
            "columns": [{
                "data": "descricao"
            },
                {
                    "data": "anexo"
                },
                {
                    "data": "status"
                },
                {
                    "data": "action"
                },
            ]
        });

        valida = 0;
        var mutationObserver = new MutationObserver(function (mutations) {
            var om_pergunta = [];
            mutations.forEach(function (mutation) {
                for (var i = 0; i < mutation.target.length; i++) {
                    om_pergunta.push(mutation.target[i].value, mutation.target[i].id);
                }
            });
            var selecionados = om_pergunta.filter(function (valor, i) {
                return om_pergunta.indexOf(valor) == i;
            });
            if (selecionados.length >= 1) {
                valida = 1;
                $('#search_to').removeClass('error')
                $('#search_to-error').removeClass('error').addClass('disable');
            } else {
                valida = 0;
                $('#search_to-error').removeClass('disable').addClass('error');
                $('#search_to').removeClass('disable').addClass('error');
            }
        });

        mutationObserver.observe(document.getElementById('search_to'), {
            childList: true
        });


        $('#form_nova_pergunta').validate({
            onkeyup: function (element) {
                $(element).valid();
            },
            ignore: [],
            errorClass: "error",
            rules: {
                descricao: {
                    required: function () {
                        CKEDITOR.instances.descricao.updateElement();
                    },
                    minlength: 6
                },
                "om_pergunta[]": {
                    required: {
                        depends: function () {
                            if (!valida) {
                                return true
                            } else {
                                return false
                            }
                        }
                    },
                }

            },
            messages: {
                descricao: {
                    required: "Por favor, informe uma descrição para a pergunta.",
                    minlength: "A pergunta deve ser mais detalhada.",
                },
                "om_pergunta[]": {
                    required: "Por favor, informe ao menos uma om"
                }
            },
        });

        function editaPergunta(id) {
            $('#ModalEdita').modal('show');
            $('#pergunta_id').val(id);


            $.getJSON('/admin/gerencia/edita/pergunta/' + id, function (pergunta) {

                $('#descricao_edita').val(pergunta.descricao);
                CKEDITOR.instances['descricao_edita'].setData();
            });


            $.getJSON('/admin/lista/pergunta/om/' + id, function (oms) {
                var om_selecionadas = [];
                var om_disponivel = [];
                var om_livres = [];


                $.getJSON('/admin/gerencia/om/lista', function (data) {

                    for (var i = 0; i < oms[0].om.length; i++) {
                        console.log(oms[0].om[i].om_id)
                        om_selecionadas.push(oms[0].om[i].om_id)
                    }
                    for (var i = 0; i < data.length; i++) {
                        om_disponivel.push(data[i].id)
                    }

                    $.grep(om_disponivel, function (el) {
                        if ($.inArray(el, om_selecionadas) == -1) om_livres.push(el);
                    });


                    let search = '';
                    let search_to = '';
                    if (data.length) {
                        for (var i = 0; i < data.length; i++) {
                            for (var j = 0; j < om_livres.length; j++) {
                                if (data[i].id == om_livres[j]) {
                                    search += '<option id="' + data[i].id + '" value="' + data[i].id + '">' + data[i].sigla + '</option>'
                                }
                            }
                        }
                        $("#search2").html(search);
                    }

                    if (om_selecionadas.length) {
                        for (var i = 0; i < data.length; i++) {
                            for (var j = 0; j < om_selecionadas.length; j++) {
                                if (data[i].id == om_selecionadas[j]) {
                                    search_to += '<option id="' + data[i].id + '" value="' + data[i].id + '">' + data[i].sigla + '</option>'
                                }
                            }
                        }

                        $("#search2_to").html(search_to);
                    }
                })
            })

        }

        $('#form_edita_pergunta').on('submit', function () {
            $('.om_pergunta option').prop('selected', true)
        });
        $('#form_edita_pergunta').validate({
            onkeyup: function (element) {
                $(element).valid();
            },
            errorClass: "error",
            rules: {
                descricao: {
                    required: function () {
                        CKEDITOR.instances.descricao.updateElement();
                    },
                    minlength: 6
                },
                "om_pergunta[]": {
                    required: {
                        depends: function () {
                            if (!valida) {
                                return true
                            } else {
                                return false
                            }
                        }
                    },
                }

            },
            messages: {
                descricao: {
                    required: "Por favor, informe uma descrição para a pergunta.",
                    minlength: "A pergunta deve ser mais detalhada.",
                },
                "om_pergunta[]": {
                    required: "Por favor, informe ao menos uma om"
                }
            },
        });

        function removePergunta(id) {
            $('#ModalRemover').modal('show');
            $('.remover').attr('onClick', 'remover(' + id + ');');
        }

        function inativaPergunta(id) {
            $('#ModalInativar').modal('show');
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
                    toastr.success('Pergunta removida com sucesso!', 'Sucesso!', {
                        timeOut: 3000
                    });
                    $('#pegunta_table').DataTable().ajax.reload(null, false); //faz o reaload da view datatable mas mantem a pagina atual

                    $('.modal').modal('hide');
                },
                error: function (data) {
                    toastr.error('Não foi possível remover!', 'Erro!', {
                        timeOut: 3000
                    });
                }
            });
        }

        function ativarPergunta(id) {
            $.ajax({
                type: 'get',
                url: '/admin/gerencia/ativar/pergunta/' + id,
                success: function (data) {
                    // alert de sucesso
                    toastr.success('Pergunta ativada com sucesso!', 'Sucesso!', {
                        timeOut: 3000
                    });
                    $('#pegunta_table').DataTable().ajax.reload(null, false); //faz o reaload da view datatable mas mantem a pagina atual

                    $('.modal').modal('hide');
                },
                error: function (data) {
                    toastr.error('Não foi possível remover!', 'Erro!', {
                        timeOut: 3000
                    });
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
                    toastr.success('Pergunta inativada com sucesso!', 'Sucesso!', {
                        timeOut: 3000
                    });
                    $('#pegunta_table').DataTable().ajax.reload(null, false); //faz o reaload da view datatable mas mantem a pagina atual

                    $('.modal').modal('hide');
                },
                error: function (data) {
                    toastr.error('Não foi possível remover!', 'Erro!', {
                        timeOut: 3000
                    });
                }
            });
        }

        om();

        function om() {
            $.getJSON('/admin/gerencia/om/lista', function (data) {
                $("#search").empty();
                let search = '';
                if (data.length) {
                    for (var i = 0; i < data.length; i++) {

                        search += '<option id="' + data[i].id + '" value="' + data[i].id + '">' + data[i].sigla + '</option>'
                    }
                    $("#search").html(search);
                } else {

                }
            });
        }

        $('#form_nova_pergunta').on('submit', function () {
            $('.om_pergunta option').prop('selected', true)
        });

        $('#search').multiselect({
            search: {
                left: '<input type="text"  class="form-control" placeholder="Pesquisar..." />',
                right: '<input type="text"  class="form-control" placeholder="Pesquisar..." />'
            }
        });
        $('#search2').multiselect({
            search: {
                left: '<input type="text"  class="form-control" placeholder="Pesquisar..." />',
                right: '<input type="text"  class="form-control" placeholder="Pesquisar..." />'
            }
        });
    </script>
@endsection
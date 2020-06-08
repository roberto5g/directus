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
                    <h3><i class="fa fa-tasks"></i>
                        <span class="audiowide">
                        Perguntas
                    </span></h3>
                </div>
            </div>

            @if($perguntas)
                @foreach($perguntas as $pergunta)

                    <div class="alert alert-secondary">
                        <form id="form_resposta_{{$pergunta->id}}" action="/responde/pergunta/{{$pergunta->id}}"
                              method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label><b>Origem: </b>{{$pergunta->sigla}}</label><br>
                                        <label for="pergunta_{{$pergunta->id}}"><b>Pergunta:</b> {!! $pergunta->descricao !!}
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label><b>Insira sua resposta</b></label>
                                        <textarea name="resposta" class="form-control" id="pergunta_{{$pergunta->id}}"
                                                  type="text" rows="5" cols="30" dir="ltr"
                                                  placeholder="Informe sua resposta" required></textarea>
                                    </div>
                                </div>
                            </div>
                            @if($pergunta->anexo)
                                <div class="row">
                                    <div class="col">
                                        <label><b>Anexo referente a pergunta</b></label> <a
                                                href="/storage/{{$pergunta->anexo}}" target="_blank"><i
                                                    class="fa fa-file-text"></i> Anexo</a>

                                    </div>
                                </div>
                            @endif
                            <div class="alert alert-dark">
                                <h6>
                                    <span class="audiowide">Inserir documento em anexo</span>
                                </h6>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group main-section">
                                            <div class="file-loading">
                                                <input id="anexo_{{$pergunta->id}}" type="file" name="anexo_resposta"
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

                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-block btn-success responder" id="{{$pergunta->id}}">
                                        Responder Pergunta
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach

            @else
                <div class="alert alert-success">
                    <div class="row">
                        <div class="col">
                            <div class="text-center">
                                <h2>
                                    <p>Você não possui perguntas disponíveis para responder.</p>
                                </h2>
                            </div>
                        </div>
                    </div>

                </div>

            @endif


            <div class="espacobaixo10"></div>


            <div class="alert alert-simples">
                <div class="text-center">
                    <h6><i class="fa fa-book"></i>

                        <span class="audiowide">
                        Perguntas respondidas
                    </span></h6>
                </div>

                <div class="table-responsive">
                    <table id="perguntas_table"
                           class="table table-sm table-hover table-bordered table-striped dataTable no-footer">
                        <thead>
                        <tr>
                            <th class="text-center">Om</th>
                            <th class="text-center">Descrição</th>
                            <th class="text-center">Data pergunta</th>
                            <th class="text-center">Data resposta</th>
                            <th class="text-center">Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalDetalhe" tabindex="-1" role="dialog" aria-labelledby="ModalDetaleTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalDetalheTitle">Detalhe pergunta - resposta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{--modal body--}}
                <div class="modal-body">
                    <div class="alert alert-simples">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label><b>Origem: </b><span id="om"></span></label><br>
                                    <label for="pergunta"><b>Pergunta:</b> <div id="pergunta"></div></label>
                                    <div class="alert alert-simples">
                                        <label><b>Resposta: </b></label>
                                        <div id="resposta"></div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div id="anexos">
                            <div class="row">
                                <div class="col" id="anexo_pergunta">
                                    <label><b>Anexo referente a pergunta: </b></label> <a id="link_pergunta" href=""
                                                                                          target="_blank"><i
                                                class="fa fa-file-text"></i> Anexo Pergunta</a>

                                </div>
                                <div class="col" id="anexo_resposta">
                                    <label><b>Anexo referente a resposta: </b></label> <a id="link_resposta" href=""
                                                                                          target="_blank"><i
                                                class="fa fa-file-text"></i> Anexo Resposta</a>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <button class="btn btn-block btn-secondary" data-dismiss="modal">
                                    Fechar
                                </button>
                            </div>
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
            @if($perguntas)
            @foreach($perguntas as $pergunta)
            CKEDITOR.replace('pergunta_{{$pergunta->id}}');
            @endforeach
            @endif
        });

        $('.responder').on('click', function (e) {
            //e.preventDefault();
            let id = $(this).attr('id');
            $('#form_resposta_' + id).validate({
                onkeyup: function (element) {
                    $(element).valid();
                },
                errorClass: "error",
                rules: {
                    resposta: {
                        required: true,
                    },
                },
                messages: {
                    resposta: {
                        required: "Informe uma resposta",
                    },
                },
            });
        });

        function detalhes(id) {
            $('#ModalDetalhe').modal('show');
            $('#om').text($('#detalhes_' + id).data('om'));
            $('#pergunta').html($('#detalhes_' + id).data('pergunta'));
            $('#resposta').html($('#detalhes_' + id).data('resposta'));
            let anexo_pergunta = $('#detalhes_' + id).data('anexo_pergunta');
            let anexo_resposta = $('#detalhes_' + id).data('anexo_resposta');

            if (anexo_pergunta == '') {
                $('#anexo_pergunta').removeClass('enable').addClass('disable');
            } else {
                $('#link_pergunta').attr("href", "/storage/" + anexo_pergunta);
                $('#anexo_pergunta').removeClass('disable').addClass('enable');
            }
            if (anexo_resposta == '') {
                $('#anexo_resposta').removeClass('enable').addClass('disable');
            } else {
                $('#link_resposta').attr("href", "/storage/" + anexo_resposta);
                $('#anexo_resposta').removeClass('disable').addClass('enable');
            }


        }

        $('#perguntas_table').DataTable({
            "processing": true,
            "serverSide": true,
            "autoWidth": false,
            "ajax": "/usuario/lista/respostas",
            'order': [0, 'desc'],
            'columnDefs': [{
                "targets": [0, 2, 3, 4], // your case first column
                "className": "text-center",
            },
                {
                    "width": "20%",
                    "targets": 0
                },
                {
                    "width": "40%",
                    "targets": 1,
                    render: function (data) {
                        return strip(data);
                    }
                },
                {
                    "width": "10%",
                    "targets": 2
                },
                {
                    "width": "10%",
                    "targets": 3
                },
                {
                    "width": "10%",
                    "targets": 4
                },
                {
                    "targets": 2,
                    render: function (data) {
                        return moment(data).format('DD/MM/YYYY');
                    }
                },
                {
                    "targets": 3,
                    render: function (data) {
                        return moment(data).format('DD/MM/YYYY');
                    }
                },
                {
                    "targets": [4],
                    "orderable": false
                },
            ],

            "columns": [{
                "data": "perguntas.user.om.sigla"
            },
                {
                    "data": "perguntas.descricao"
                },
                {
                    "data": "perguntas.created_at"
                },
                {
                    "data": "created_at"
                },
                {
                    "data": "action"
                },
            ]
        });
    </script>

@endsection
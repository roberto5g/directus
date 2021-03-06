@extends('admin.layout.master')
@section('content')
    <?php ini_set('memory_limit', '2048M'); ?>

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
        </div>

        <div class="alert alert-simples">
            <div class="table-responsive">
                <table id="perguntas_table"
                       class="table table-sm table-hover table-bordered table-striped dataTable no-footer">
                    <thead>
                    <tr>
                        <th class="text-center">Om</th>
                        <th class="text-center">Descrição</th>
                        <th class="text-center">Data pergunta</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Porcentagem</th>
                        <th class="text-center">Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalDetalhe" tabindex="-1" role="dialog"
         aria-labelledby="ModalDetaleTitle" aria-hidden="true">
        <div class="modal-dialog modal-xg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalDetalheTitle">Detalhe pergunta - resposta</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{--modal body--}}
                <div class="modal-body">

                    <div class="alert alert-simples">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="pergunta_tabela"><b>Pergunta:</b></label>
                                    <div id="pergunta_tabela"></div>
                                    <div class="anexo_pergunta"></div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-success">
                            <div class="text-center">
                                <h5><i class="fa fa-tasks"></i>
                                    <span class="audiowide">
                            Respostas para a pergunta
                                </span></h5>
                            </div>
                            <div class="alert alert-simples">
                                <div class="table-responsive">
                                    <table id="perguntas_table_modal"
                                           class="table table-sm table-hover table-bordered table-striped no-footer">

                                        <thead>
                                        <tr>
                                            <th class="text-center">OM</th>
                                            <th class="text-center">Resposta
                                            <th class="text-center">Data resposta
                                            </th>
                                            <th class="text-center">Anexo
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="espacobaixo5"></div>
                                <div class="alert alert-simples">
                                    <div class="form-group">
                                        <div class="text-center">
                                            <h3>
                                                <i class="fa fa-book"></i> <span
                                                        class="audiowide">Emissão de Relatório por pergunta</span>
                                            </h3>
                                        </div>

                                        {{--botões de geração de relatório--}}
                                        <div class="row">
                                            <div class="col">
                                                <form action="/admin/gera/relatorio/om/sem/resposta/pergunta"
                                                      method="get">
                                                    <input type="hidden" class="pergunta_id" name="pergunta_id">


                                                    <button type="submit" class="btn btn-secondary btn-block gera_pdf"
                                                            data-target="_black" name="pdf" value="pdf">
                                                        <i class="fa fa-download"> </i>
                                                        Download PDF (OM que não respondeu)
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col">
                                                <form action="/admin/gera/relatorio/geral/pergunta" method="get">
                                                    <input type="hidden" class="pergunta_id" name="pergunta_id">


                                                    <button type="submit" class="btn btn-success btn-block gera_pdf"
                                                            data-target="_black" name="pdf" value="pdf">
                                                        <i class="fa fa-download"> </i>
                                                        Download PDF (Geral)
                                                    </button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="button"
                                        class="btn btn-secondary btn-block"
                                        data-dismiss="modal">Fechar
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
            $('[data-toggle="tooltip"]').tooltip();


            $('.modal').on('hidden.bs.modal', function () {
                $('#perguntas_table_modal').DataTable().destroy();
                $('#perguntas_table_modal tbody').empty();
            })

        });

        function detalhesPergunta(id) {

            $('#ModalDetalhe').modal('show');
            $('.pergunta_id').val(id);

            $('#perguntas_table_modal').DataTable({
                "processing": true,
                "serverSide": true,
                "autoWidth": false,
                "ajax": "admin/gerencia/lista/pergunta/" + id,
                'order': [0, 'desc'],
                rowCallback: function (row, data, index) {
                    if (data.status == 'pendente') {
                        $(row).css('background-color', '#FA5858');
                    }
                },
                'columnDefs': [
                    {
                        "targets": [0, 2, 3], // your case first column
                        "className": "text-center",
                    },
                    {
                        "width": "20%", "targets": 0
                    },
                    {
                        "targets": 1, // your case first column
                        "className": "text-left",
                        "width": "60%",
                        render: function (data) {
                            return strip(data);
                        }
                    },
                    {
                        "width": "10%", "targets": 2
                    },
                    {
                        "width": "10%", "targets": 3
                    },

                    {
                        "targets": 1, render: function (data) {
                            if (data != "Não respondido") {
                                return data;
                            } else {
                                return '<div class="text-center">' + data + '</div>';
                            }

                        }
                    },
                    {
                        "targets": 3, render: function (data) {
                            console.log(data)
                            if (data != null && data != "--") {
                                return '<h6><a href="/storage/' + data + '"  class="badge badge-success" target="_blank">' +
                                    '<i class="fa fa-file-text"></i> anexo</a></h6>';
                            } else if (data == null) {
                                return '<h6><span class="badge badge-warning"> sem anexo </span></h6>';
                            } else {
                                return '<span class="text-center"> -- </span>';
                            }

                        }
                    },
                ],
                "columns": [
                    {"data": "sigla"},
                    {"data": "resposta"},
                    {"data": "data"},
                    {"data": "anexo"},
                ]
            });


            $.getJSON('/admin/gerencia/edita/pergunta/' + id, function (pergunta) {

                $('#pergunta_tabela').html(pergunta.descricao)
            });


            $('.respostas_om').empty();
            $('.anexo_pergunta').empty();


            $.getJSON('/admin/detalhes/perguntas/respostas/' + id, function (pergunta) {
                for (var i = 0; i < pergunta.length; i++) {
                    var anexo = '';
                    if (pergunta[i].anexo != null) {
                        anexo += '<b>Anexo de referência: </b><h6><a href="/storage/' + pergunta[i].anexo + '"  class="badge badge-success" target="_blank">' +
                            '<i class="fa fa-file-text"></i> anexo</a></h6>'
                    }
                    $('.anexo_pergunta').html(anexo);

                }
            });


        }

        $('#perguntas_table').DataTable({
            "processing": true,
            "serverSide": true,
            "autoWidth": false,
            "ajax": "/admin/gerencia/lista/perguntas",
            'order': [0, 'desc'],
            'columnDefs': [
                {
                    "targets": [0, 2, 3, 4, 5], // your case first column
                    "className": "text-center",
                },
                {
                    "width": "20%", "targets": 0
                },
                {
                    "width": "40%", "targets": 1,
                    render: function (data) {
                        return strip(data);
                    }
                },
                {
                    "width": "10%", "targets": 2
                },
                {
                    "targets": 4, render: function (data) {
                        return '<h6><span class="badge badge-primary">' + data + '%</span></h6>';
                    }
                },
                {
                    "targets": 3, render: function (data) {
                        if (data == 'Ativo') {
                            return '<h6><span class="badge badge-success">' + data + '</span></h6>';
                        } else {
                            return '<h6><span class="badge badge-warning">' + data + '</span></h6>';
                        }

                    }
                },
                {
                    "width": "10%", "targets": 4
                },
                {
                    "width": "10%", "targets": 5
                },
                {
                    "targets": 5,
                    "orderable": false
                },
            ],
            "columns": [
                {"data": "sigla"},
                {"data": "descricao"},
                {"data": "created_at"},
                {"data": "status"},
                {"data": "porcentagem"},
                {"data": "action"},
            ]
        });


    </script>

@endsection

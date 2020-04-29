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
                                    <label for="pergunta_tabela"><b>Pergunta:</b> <span id="pergunta_tabela"></span></label><br>
                                    <div class="anexo_pergunta"></div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="perguntas_table"
                                   class="table table-sm table-hover table-bordered table-striped no-footer">
                                <thead>
                                <tr>
                                    <th class="text-center alinha" style="width:15%;">OM</th>
                                    <th class="text-center alinha" style="width:70%;">Resposta
                                    <th class="text-center alinha" style="width:5%;">Data resposta
                                    </th>
                                    <th class="text-center alinha" style="width:10%;">Anexo
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                @for($i = 0; $i < count($oms); $i++)

                                    <tr>
                                        <th scope="row" class="alinha">{{$oms[$i]->sigla}}</th>
                                        <td scope="col" class="text-left tabela_valor tab_resposta" id="resposta_{{$oms[$i]->id}}"></td>
                                        <td scope="col" class="text-left tabela_valor tab_data" id="data_{{$oms[$i]->id}}"></td>
                                        <td scope="col" class="text-center tabela_valor tab_anexo alinha" id="anexo_{{$oms[$i]->id}}"></td>

                                    </tr>

                                @endfor
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="alert alert-simples">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="pergunta"><b>Pergunta:</b> <span id="pergunta"></span></label><br>
                                    <div class="anexo_pergunta"></div>
                                </div>
                            </div>
                        </div>

                        <div class="respostas disable">
                            <div class="row">
                                <div class="col">
                                    <span><b>Respostas</b></span>
                                </div>
                            </div>
                        </div>

                        <div class="aviso_respostas disable">
                            <div class="alert alert-warning">
                                <div class="row">
                                    <div class="col">
                                        <div class="text-center">
                                            <h3><span><b>Essa pergunta ainda não pussui respostas.</b></span></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="respostas_om">
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

        function detalhesPergunta(id) {
            $('#ModalDetalhe').modal('show');
            $('#pergunta').text($('#detalhes_' + id).data('descricao'));
            $('#pergunta_tabela').text($('#detalhes_' + id).data('descricao'));
            $('.respostas_om').empty();
            $('.anexo_pergunta').empty();
            $('.tabela_valor').empty();
            $('.tab_resposta').html('<div class="text-center">Não responseu</div>');
            $('.tab_data').html('<div class="text-center"> -- </div>');
            $('.tab_anexo').html('<div class="text-center">sem anexo</div>');
            $('.respostas').removeClass('enable').addClass('disable');
            $('.aviso_respostas').removeClass('enable').addClass('disable');
            var html = '';
            $.getJSON('/admin/detalhes/perguntas/respostas/' + id, function (pergunta) {
                for (var i = 0; i < pergunta.length; i++) {
                    console.log(pergunta[i])
                    var anexo = '';
                    if (pergunta[i].anexo != null) {
                        anexo += '<label><b>Anexo de referência: </b><a href="/storage/' + pergunta[i].anexo + '" target="_blank"><i class="fa fa-file-text"> anexo</i></a></label>'
                    }
                    $('.anexo_pergunta').html(anexo);

                    if (pergunta[i].respostas.length) {
                        $('.respostas').removeClass('disable').addClass('enable');
                    } else {
                        $('.aviso_respostas').removeClass('disable').addClass('enable');
                    }


                    for (var j = 0; j < pergunta[i].respostas.length; j++) {

                        var date = moment(pergunta[i].respostas[j].created_at).format('DD/MM/YYYY HH:mm:ss');

                        $('#resposta_'+pergunta[i].respostas[j].users.om.id).text(pergunta[i].respostas[j].resposta);
                        $('#data_'+pergunta[i].respostas[j].users.om.id).text(date);
                        var anexo_tabela = '';
                        if (pergunta[i].respostas[j].anexo_resposta != null) {
                            anexo_tabela += '<br><label><a href="/storage/' + pergunta[i].respostas[j].anexo_resposta + '" target="_blank"><i class="fa fa-file-text"> anexo</i></a></label>\n';
                        } else {
                            anexo_tabela += '<div class="text-center">sem anexo</div>';
                        }

                        $('#anexo_'+pergunta[i].respostas[j].users.om.id).html(anexo_tabela);

                        html += '<div class="alert alert-success">\n' +
                            '         <label><b>' + pergunta[i].respostas[j].users.om.sigla + '</b></label>\n' +
                            '         <div class="alert alert-simples">\n' +
                            '              <div class="row">\n' +
                            '                   <div class="col">\n' +
                            '                        <label><b>Respondeu: </b>' + pergunta[i].respostas[j].resposta + '</label>\n';
                        if (pergunta[i].respostas[j].anexo_resposta != null) {
                            html += '                   <br><label><b>Anexo: </b><a href="/storage/' + pergunta[i].respostas[j].anexo_resposta + '" target="_blank"><i class="fa fa-file-text"> anexo</i></a></label>\n';
                        }
                        html += '                </div>\n' +
                            '              </div>\n' +
                            '         </div>\n' +
                            '     </div>';

                    }
                    $('.respostas_om').append(html);
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
                    "targets": [0, 1, 2, 3, 4], // your case first column
                    "className": "text-center",
                },
                {
                    "width": "20%", "targets": 0
                },
                {
                    "width": "40%", "targets": 1
                },
                {
                    "width": "10%", "targets": 2
                },
                {
                    "targets": 2, render: function (data) {
                        return moment(data).format('DD/MM/YYYY');
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
                    "targets": 4,
                    "orderable": false
                },
            ],
            "columns": [
                {"data": "user.om.sigla"},
                {"data": "descricao"},
                {"data": "created_at"},
                {"data": "status"},
                {"data": "action"},
            ]
        });


    </script>

@endsection

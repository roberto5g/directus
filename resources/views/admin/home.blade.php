@extends('admin.layout.master')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header" id="headingOne">
                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8 text-center">
                        <h3>
                            <i class="fa fa-fort-awesome"></i>
                            <span class="audiowide">
                                            Efetivo PRM / Guarnição por Áreas
                                        </span>
                        </h3>
                    </div>
                </div>
            </div>

            <div class="card-body" id="card_tabela">
                <div class="row">
                    <div class="col">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th scope="col" class="table-dark text-center">#</th>
                                @for($y = 0; $y < count($formacoes); $y++)
                                    <th scope="col"
                                        class="table-dark text-center">{{$formacoes[$y]->nome}}</th>

                                @endfor
                            </tr>
                            </thead>
                            <tbody>

                            @for($i = 0; $i < count($prms); $i++)
                                <?php
                                $total = 0;
                                ?>
                                <tr>
                                    <th scope="row" class="table-secondary">{{$prms[$i]->nome}}</th>
                                    @for($y = 0; $y < count($formacoes); $y++)
                                        @for($j = 0; $j < count($prms[$i]->oms); $j++)
                                            @for($z = 0; $z < count($informacoes); $z++)
                                                @if($prms[$i]->oms[$j]->id == $informacoes[$z]->om->id && $informacoes[$z]->formacao->id == $formacoes[$y]->id)
                                                    <?php $total += 1 ?>
                                                @endif
                                            @endfor

                                        @endfor
                                        <td scope="col" class="text-center">
                                            @if($total != 0)
                                                <h6><span class="badge badge-success">{{$total}}</span></h6>
                                            @else
                                                <h6><span class="badge badge-secondary">{{$total}}</span></h6>
                                            @endif
                                        </td>
                                        <?php
                                        $total = 0;
                                        ?>
                                    @endfor
                                </tr>
                            @endfor

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection
<!-- /.conainer-fluid -->

@section('myscript')


@endsection
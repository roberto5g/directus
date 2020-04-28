<form method="POST" id="cadastro" action="{{ route('register') }}">
    {{ csrf_field() }}
    <div class="alert alert-simples">
        <h3 class="text-center"><span class="audiowide">Informe seus dados</span></h3>
        <div class="form-group">
            <input type="text" id="nome" name="nome" class="form-control formatar_nome"
                   placeholder="Nome Completo"
                   required>
        </div>

        <div class="form-group">

            <input id="email" type="email"
                   class="form-control"
                   name="email" value="{{ old('email') }}" required
                   placeholder="Email">

        </div>
        <div class="form-group">
            <input type="text" name="om_id" id="cpf" class="form-control cpf"
                   value="1">
        </div>

        <div class="form-group">
            <input type="password" id="password" name="password" class="form-control"
                   placeholder="Senha"
                   required>
        </div>

        <div class="form-group">
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                   placeholder="Repita a Senha">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="button"
                    class="btn btn-outline-secondary btn-block"
                    data-dismiss="modal">Cancelar
            </button>
        </div>

        <div class="col">
            <button type="submit" class="btn btn-success btn-block">
                Salvar e prosseguir
            </button>
        </div>
    </div>
</form>
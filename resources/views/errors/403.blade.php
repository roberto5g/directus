<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->

  <title>Sist</title>
  <link href="{{ asset('css/page_error.css') }}" rel="stylesheet">

</head>

<body>

<?php registraErro(Request::url(),403)?>
<h1>403</h1>
<div><p>> <span>CÓDIGO DE ERRO</span>: "<i>HTTP 403 Forbidden</i>"</p>
  <p>> <span>DESCRIÇÃO</span>: "<i>Acesso Negado. Você não tem permissão para acessar essa página.</i>"</p>
  <p>> <span>OBSERVAÇÃO</span>: "<i>Sua tentativa de acessar essa página foi salva para futuras análises.</i>"</p>
  <p>> <span>ATENÇÃO</span>: <i>Clique</i> [<a href="/" class="link-simples-branco">Aqui</a>], <i>para voltar.</i></p>
</div>

<!-- Bootstrap and necessary plugins -->
  <script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
  <script src="{{ asset('js/vendor/page_error.js') }}"></script>
</body>
</html>
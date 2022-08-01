@extends('main')

@section('content')
    <table class="table" id="emprestimos">
    <thead>
        <tr>
        <th scope="col">Empréstimo</th>
        <th scope="col">Foto</th>
        <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        @include('emprestimos.partials.tremprestimo')
        </tr>
    </tbody>
    </table>
@endsection('content')


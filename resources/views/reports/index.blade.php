@extends('main')

@section('content')

<h2>Relatório</h2>

<br>

<div>
    <b>Quantos livros tem a localização iniciada com i (ou I):</b> {{ $i_start }}

</div>
<br>

@foreach($years as $year)
<div>
    <b>Quantos livros foram cadastrados em {{ $year }}:</b> {{ $livros_by_year[$year] }}
</div>
@endforeach
<br>


@foreach($years as $year)
<div>
    <b>Quantos empréstimos aconteceram em {{ $year }}:</b> {{ $emprestimos_by_year[$year] }}
</div>

@endforeach
<br>


@foreach($years as $year)
<div><b>Quantos alunos diferentes retiraram livros em {{ $year }}:</b> {{ $users_emprestimos_by_year[$year]}}</div> 

@endforeach
<br>


<div><b>Dos alunos que retiraram livros neste ano de quais turmas eles são?</b></div>
<table class="table">
    <thead>
        <tr>
        <th scope="col">Turma</th>
        <th scope="col">Quantidade</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users_emprestimos_by_year_grouped[date('Y')] as $key=>$value)
            <tr>
                <td>{{$key}}</td>
                <td>{{$value}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@foreach($years as $year)
    <div><b>Top 10 livros em {{ $year }}</b></div>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Livro</th>
            <th scope="col">Empréstimos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($top10_livros[$year] as $key=>$value)
                <tr>
                    <td>{{ \App\Models\Livro::where('id',$key)->first()->titulo }}</td>
                    <td>{{$value}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endforeach


@endsection('content')
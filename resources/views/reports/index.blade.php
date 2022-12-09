@extends('main')div

@section('content')

<h2>Relatório</h2>

<br>

<div>
    <b>Quantos livros tem a localização iniciada com i (ou I):</b> {{ $i_start }}</div>
<br>

@foreach($years as $year)
<div>
    <b>Quantos livros foram cadastrados em {{ $year }}:</b> {{ $livros_by_year[$year] }}</div>
@endforeach
<br>


@foreach($years as $year)
<div><b>Quantos empréstimos aconteceram em {{ $year }}:</b> {{ $emprestimos_by_year[$year] }}</div>

@endforeach
<br>


@foreach($years as $year)
<div><b>Quantos alunos diferentes retiraram livros em {{ $year }}:</b> {{ $users_emprestimos_by_year[$year]}}</div> 

@endforeach
<br>

@foreach($years as $year)
<div>Dos alunos que retiraram livros em {{ $year }} de quais séries eles são?</div>

@endforeach






@endsection('content')
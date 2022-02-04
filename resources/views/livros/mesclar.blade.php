@extends('main')

@section('content')

   
    @foreach($grupos as $livros)

        @if($livros->count()>1)
        <table class="table table-sm">
            <thead>
                <tr>
                <th scope="col">Mesclar</th>
                <th scope="col">Título</th>
                <th scope="col">Localização (CDD+PHA)</th>
                <th scope="col">Localização Completa</th>
                <th scope="col"></th>
                </tr>
            </thead>

            <tbody>
                @php $rowid = 0; @endphp
                <form method="POST" action="/mesclar">
                @foreach($livros as $livro)
                    
                        <tr>
                        <td><div class="form-check"><input class="form-check-input" type="checkbox" name="livros[]" value="{{ $livro->id }}"></div></td>
                            <td><a href="/livros/{{ $livro->id }}">{{ $livro->titulo }}</a></td>
                            <td>{{ $livro->localizacao }}</td>
                            <td>{{ $livro->localizacao_formatada }}</td>
                            @if($rowid == 0)
                                <td style="vertical-align : middle;text-align:center;" rowspan="{{$livros->count()}}">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Você tem certeza que deseja mesclar os registros?')">Mesclar</button>
                                </td>
                            @endif
                        </tr>
                    
                    @php $rowid++; @endphp
                @endforeach
                </form>
            
            </tbody>
        </table>
        <hr>
        @endif
    @endforeach
   


@endsection('content')
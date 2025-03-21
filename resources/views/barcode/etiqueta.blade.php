<table style='width:100%; padding:1px; margin-top: 25px; border: 0px solid #000'>
    <tr>
        <td style='text-align:center;'>
            <span style='font-size: 11px'>
            @if(!empty($item->livro->titulo))<b>Título: </b> {{ $item->livro->titulo }}<br>@endif
            </span>
            {{ $item->exemplar }} - {{ $item->tombo }}<br>{!! $codigo !!}
            <br><span style='font-size: 9px'>Biblioteca FITO</span>
        </td>
    </tr>
</table>
<style type="text/css">
    /* * { margin: 0; padding: 0; } */
    table, th, td {
        border: 1px solid black;
        width: 100%;
    }

    td {
        width: 50%;
        
    }

</style>

<table style="width: 100%">
  @foreach($livros as $livro)
  <tr>
    <td height="2.4cm"> </td>
    <td height="2.4cm">
        {{ $livro->tombo }} {!! $generator->getBarcode($livro->tombo, $generator::TYPE_CODE_39) !!} 
        {{ $livro->localizacao }}
    </td>
  </tr>
  @endforeach
</table> 
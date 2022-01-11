<style type="text/css">

.cartao{
    float:left;
    border: 2px solid;
    width: 10cm;
    height: 15cm;
}

.bolso{
    float:right;
    border: 2px dashed;
    width: 10cm;
    height: 15cm;
}

</style>


<div class="cartao">
Tombo: {{ $livro->tombo }} <br>
Autor: <b>{{ $livro->autor }}</b> <br>
Título: {{ $livro->titulo }} <br>
</div>

<div class="bolso">
Tombo: {{ $livro->tombo }} <br>
Autor: <b>{{ $livro->autor }}</b> <br>
Título: {{ $livro->titulo }} <br>
</div>
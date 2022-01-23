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

.interna {
    margin: 1cm;
    border: 2px dashed;
}

</style>

<div class="cartao">
    <div class="interna">
    Tombo: {{ $livro->tombo }} <br>
    Autor: <b>{{ $livro->autor }}</b> <br>
    Título: {{ $livro->titulo }} <br>
    </div>
</div>

<div class="bolso">
Tombo: {{ $livro->tombo }} <br>
Autor: <b>{{ $livro->autor }}</b> <br>
Título: {{ $livro->titulo }} <br>
</div>
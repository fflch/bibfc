<li> <a href="/assuntos/{{$assunto->id}}" >{{ $assunto->titulo }}</a></li>

@if (count($assunto->children) > 0)
	<ul>
	@foreach($assunto->children as $assunto)
		@include('assuntos.partials.assunto', $assunto)
	@endforeach
	</ul>
@endif
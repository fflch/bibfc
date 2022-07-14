Usuário para testes:

    $user = new App\Models\User();
    $user->password = Hash::make('admin');
    $user->email = 'admin@example.com';
    $user->name = 'admin';
    $user->save();

Renomeando fotos, o código que vale é o que está depois do underline:

    for i in $(ls); do cp $i renomeados/$(echo $i |cut -d'_' -f1).jpg ; done

Import usuários:

    php artisan importusuarios arquivo.csv

Deletar livros sem exemplar:

    Livro::whereDoesntHave('instances')->delete();


Rascunhos:

    <ul>
        @each('assuntos.partials.assunto', $assuntos, 'assunto')
    </ul>

    update assuntos set parent_id=130 where (parent_id IS NULL and id!=130);
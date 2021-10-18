Usuário para testes:

    $user = new App\Models\User();
    $user->password = Hash::make('admin');
    $user->email = 'admin@example.com';
    $user->name = 'admin';
    $user->save();

Renomeando fotos:

    for i in $(ls); do cp $i renomeados/$(echo $i |cut -d'_' -f1).jpg ; done

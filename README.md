

    $user = new App\Models\User();
    $user->password = Hash::make('admin');
    $user->email = 'admin@example.com';
    $user->name = 'admin';
    $user->save();

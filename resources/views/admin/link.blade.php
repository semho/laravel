@auth
    @if(\App\Models\Role::isAdmin(Auth::user()))
        <a class="p-2 text-muted" href="/admin">Админ.раздел</a>
    @endif
@endauth

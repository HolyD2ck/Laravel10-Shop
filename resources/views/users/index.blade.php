@include('layouts/app')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<h1 class="t">Список Пользователей</h1>
<br />
@if ($users == null)
    <p><em>Загрузка...</em></p>
@else
<button class="btn btn-secondary l">
    <a href="/users/create" style="color: inherit; text-decoration: none;">Создать Пользователя</a>
</button>
<hr>
    <br>
    <table class="">
        <thead>
            <tr>
                <th>id</th>
                <th>Имя</th>
                <th>Почта</th>
                <th>Телефон</th>
                <th>Аватар</th>
                <th>Пароль</th>
                <th>Роль</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->Телефон }}</td>
                    <td><img class="db" src="{{ $user->Аватар }}"></td>
                    <td>{{ $user->password }}</td>
                    <td>{{ $user->role}}</td>
                    <td>
                        <button class="btn btn-secondary">
                            <a style="color: inherit; text-decoration: none;" href="{{ url("users/{$user->id}/edit") }}">Изменить</a>
                        </button>                        
                        <form method="post" action="{{ route('users.destroy', $user->id) }}">
                        <br>
                        @csrf
                        @method('DELETE')
                            <button class="btn btn-danger" onclick="deleteConfirm(event, this.closest('form'))">
                                <a style="color: inherit; text-decoration: none;">Удалить</a>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
                <script>
                    window.deleteConfirm = function(e, form){
                        e.preventDefault();
                        Swal.fire({
                            title: 'Вы уверены?',
                            text: 'Что хотите удалить запись?!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Да!',
                            cancelButtonText: 'Нет!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    }
                </script>
        </tbody>
    </table>
    @endif
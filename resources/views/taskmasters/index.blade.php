@include('layouts/app')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<h1 class="t">Список Поставщиков</h1>
<br />
@if ($taskmasters == null)
    <p><em>Загрузка...</em></p>
@else
<button class="btn btn-secondary l">
    <a href="/taskmasters/create" style="color: inherit; text-decoration: none;">Создать Поставщика</a>
</button>
<hr>
    <br>
    <table class="">
        <thead>
            <tr>
                <th>id</th>
                <th>Название</th>
                <th>Дата_Основания</th>
                <th>Директор</th>
                <th>Страна</th>
                <th>Гост</th>
                <th>Почта</th>
                <th>Фото</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($taskmasters as $taskmaster)
                <tr>
                    <td>{{ $taskmaster->id }}</td>
                    <td>{{ $taskmaster->Название}}</td>
                    <td>{{ $taskmaster->Дата_Основания}}</td>
                    <td>{{ $taskmaster->Директор}}</td>
                    <td>{{ $taskmaster->Страна}}</td>
                    <td>{{ $taskmaster->Гост}}</td>
                    <td>{{ $taskmaster->Почта}}</td>              
                    <td><img class="db" src="{{ $taskmaster->Фото }}"></td>
                    <td>
                        <button class="btn btn-secondary">
                            <a style="color: inherit; text-decoration: none;" href="{{ url("taskmasters/{$taskmaster->id}/edit") }}">Изменить</a>
                        </button>                        
                        <form method="post" action="{{ route('taskmasters.destroy', $taskmaster->id) }}">
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
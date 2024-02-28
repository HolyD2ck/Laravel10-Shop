@include('layouts/app')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<h1 class="t">Список Товаров</h1>
<br />
@if ($products == null)
    <p><em>Загрузка...</em></p>
@else
<button class="btn btn-secondary l">
    <a href="/products/create" style="color: inherit; text-decoration: none;">Создать Товар</a>
</button>
<hr>
    <br>
    <table class="">
        <thead>
            <tr>
                <th>id</th>
                <th>Категория</th>
                <th>Тип</th>
                <th>Производитель</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Описание</th>
                <th>Фото</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->Категория }}</td>
                    <td>{{ $product->Тип}}</td>
                    <td>{{ $product->taskmaster ? $product->taskmaster->Название : 'N/A' }}</td>
                    <td>{{ $product->Название}}</td>
                    <td>{{ $product->Цена}}</td>
                    <td>{{ $product->Описание}}</td>                    
                    <td><img class="db" src="{{ $product->Фото }}"></td>
                    <td>
                        <button class="btn btn-secondary">
                            <a style="color: inherit; text-decoration: none;" href="{{ url("products/{$product->id}/edit") }}">Изменить</a>
                        </button>                        
                        <form method="post" action="{{ route('products.destroy', $product->id) }}">
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
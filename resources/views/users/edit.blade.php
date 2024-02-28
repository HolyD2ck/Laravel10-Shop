@include('layouts/app')
<h1 class="t">Изменить Пользователя</h1>

<h4>Пользователь</h4>
<hr />
<div class="row">
    <div class="col-md-4">
        <form method="POST"  enctype="multipart/form-data" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="Имя" class="control-label">Имя</label>
                <input id="Имя" name="name" class="form-control" value="{{$user->name}}" />
            </div>
            <div class="form-group">
                <label for="email" class="control-label">Почта</label>
                <input id="email" type="email" name="email" class="form-control" value="{{$user->email}}"/>
            </div>
            <div class="form-group">
                <label for="Телефон" class="control-label">Телефон</label>
                <input id="Телефон" type="tel" name="Телефон" class="form-control" value="{{$user->Телефон}}" />
            </div>
            <div class="form-group">
                <label for="Аватар" class="control-label">Аватар</label>
                <img src="{{$user->Аватар}}" alt="" class="db control-label bu" id="file-preview">
                <input id="Аватар" value="{{$user->Аватар}}" type="file" name="Аватар" class="form-control" accept="image/*" onchange="showFile(event)"/>
            </div>
            <div class="form-group">
                <label for="role" class="control-label">Роль</label>
                <input id="role" name="role" class="form-control" value="{{$user->role}}" />
            </div>
            <br>
             <div class="form-group">
                <input type="submit" value="Внести" class="btn btn-primary" />
            </div>
        </form>
        <script>
                function showFile(event){
                    var input = event.target
                    var reader = new FileReader();
                    reader.onload = function(){
                        var dataURL = reader.result;
                        var output = document.getElementById('file-preview');
                        output.src = dataURL;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
        </script>
    </div>
</div>
        
                


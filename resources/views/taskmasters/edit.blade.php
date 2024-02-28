@include('layouts/app')
<h1 class="t">Изменить Поставщика</h1>

<h4>Поставщики</h4>
<hr />
<div class="row">
    <div class="col-md-4">
        <form method="POST"  enctype="multipart/form-data" action="{{ route('taskmasters.update',$taskmasters->id) }}">
        @csrf
        @method("PUT")
            <div class="form-group">
                <label for="Название" class="control-label">Название</label>
                <input id="Название" name="Название" class="form-control" value="{{$taskmasters->Название}}" />
            </div>
            <div class="form-group">
                <label for="Дата_Основания" class="control-label">Дата основания</label>
                <input id="Дата_Основания" type="date" name="Дата_Основания" class="form-control" value="{{$taskmasters->Дата_Основания}}" />
            </div>
            <div class="form-group">
                <label for="Директор" class="control-label">Директор</label>
                <input id="Директор" type="tel" name="Директор" class="form-control" value="{{$taskmasters->Директор}}" />
            </div>
            <div class="form-group">
                <label for="Страна" class="control-label">Страна</label>
                <input id="Страна"  name="Страна" class="form-control" value="{{$taskmasters->Страна}}" />
            </div>
            <div class="form-group">
                <label for="Гост" class="control-label">Гост</label>
                <input id="Гост" name="Гост" class="form-control" value="{{$taskmasters->Гост}}" />
            </div>
            <div class="form-group">
                <label for="Почта" class="control-label">Почта</label>
                <input id="Почта" type="email" name="Почта" class="form-control" value="{{$taskmasters->Почта}}" />
            </div>
            <div class="form-group">
                <label for="Фото" class="control-label">Фото</label>
                <img src="{{$taskmasters->Фото}}" alt="" class="db control-label bu" id="file-preview">
                <input id="Фото" type="file" name="Фото" class="form-control" value="{{$taskmasters->Фото}}" accept="image/*" onchange="showFile(event)"/>
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
        
                


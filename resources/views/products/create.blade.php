@include('layouts/app')
<h1 class="t">Внести Продукт</h1>

<h4>Продукт</h4>
<hr />
<div class="row">
    <div class="col-md-4">
        <form method="POST"  enctype="multipart/form-data" form action="{{ route('products.store') }}">
        @csrf
            <div class="form-group">
                <label for="Категория" class="control-label">Категория</label>
                <input id="Категория" name="Категория" class="form-control" />
            </div>
            <div class="form-group">
                <label for="Тип" class="control-label">Тип</label>
                <input id="Тип"  name="Тип" class="form-control" />
            </div>
            <div class="form-group">
                <label for="Название" class="control-label">Название</label>
                <input id="Название" type="tel" name="Название" class="form-control" />
            </div>
            <div class="form-group">
                <label for="Цена" class="control-label">Цена</label>
                <input id="Цена" type="number" name="Цена" class="form-control" step="0.01"/>
            </div>
            <div class="form-group">
                <label for="Описание" class="control-label">Описание</label>
                <textarea class="form-control" id="Описание" name="Описание">
                </textarea>
            </div>
            <div class="form-group">
                <label for="Фото" class="control-label">Фото</label>
                <img src="" alt="" class="db control-label bu" id="file-preview">
                <input id="Фото" type="file" name="Фото" class="form-control" accept="image/*" onchange="showFile(event)"/>
            </div>
            <div class="form-group">
                <label for="taskmaster_id" class="control-label">Номер поставщика</label>
                <input class="form-control" id="taskmaster_id" name="taskmaster_id">
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
        
                


<?php view('todo', 'include/page-top.htm.php');?>
    
<div class="container-md pt-4">
    <div class="row">
        <div class="col p-0">
            <p>
                <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSave" aria-expanded="false" aria-controls="collapseSave">
                    Новая задача
                </button>
            </p>
            <div class="collapse" id="collapseSave">
                <div class="card card-body">
                    <form onsubmit="alert(); return false;">
                        <div class="mb-3">
                            <label for="formControl-Name" class="form-label">Имя</label>
                            <input type="text" class="form-control" id="formControl-Name">
                        </div>
                        <div class="mb-3">
                            <label for="formControl-Email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="formControl-Email">
                        </div>
                        <div class="mb-3">
                            <label for="formControl-Text" class="form-label">Текст</label>
                            <textarea class="form-control" id="formControl-Text" rows="3"></textarea>
                        </div>
                        <button class="btn btn-primary">Сохранить задачу</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-2 text-end p-0">
            <button class="btn btn-secondary">Войти</button>
        </div>
    </div>
    <div class="row mt-3">
        <div class="card mb-3 position-relative">
            <div class="card-body">
                <h5 class="card-title">Задача #0001</h5>
                <h6 class="card-subtitle mb-2 text-muted">Vusal (vusal@mail.ru)</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">Редактировать</a>
                <a href="#" class="card-link text-danger">Удаить</a>

                <div class="position-absolute top-0 end-0 bg-success text-white card-status">
                    Done
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Задача #0002</h5>
                <h6 class="card-subtitle mb-2 text-muted">Alex (alex@mail.ru)</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>
</div>

<?php view('todo', 'include/page-bottom.htm.php');?>
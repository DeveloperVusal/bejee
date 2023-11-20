<?php view('todo', 'include/page-top.htm.php');?>
<div class="container-md pt-4">
    <div class="row">
        <div class="col p-0">
            <p>
                <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdd" aria-expanded="false" aria-controls="collapseAdd">
                    Новая задача
                </button>
            </p>
            <div class="collapse" id="collapseAdd">
                <div class="card card-body">
                    <form onsubmit="onSubmitTaskSave(this); return false;">
                        <div class="mb-3">
                            <label for="formControl-Name" class="form-label">Имя</label>
                            <input type="text" name="name" class="form-control" id="formControl-Name">
                        </div>
                        <div class="mb-3">
                            <label for="formControl-Email" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" id="formControl-Email">
                        </div>
                        <div class="mb-3">
                            <label for="formControl-Text" class="form-label">Текст</label>
                            <textarea class="form-control" name="text" id="formControl-Text" rows="3"></textarea>
                        </div>
                        <div id="liveAlertPlaceholder"></div>
                        <button class="btn btn-primary">Сохранить задачу</button>
                    </form>
                </div>
                <hr>
            </div>
        </div>
        <div class="col-2 text-end p-0">
            <?php if ($auth::isAuth()):?>
                <a href="/api/logout">
                    <button class="btn btn-secondary">Выйти</button>
                </a>
            <?php else:?>
                <a href="/auth">
                    <button class="btn btn-secondary">Войти</button>
                </a>
            <?php endif;?>
        </div>
    </div>
    <div class="row mt-3">
        <div class="row mb-3 d-flex justify-content-between pr-0 w-100" id="selects-sorts">
            <select class="form-select w-auto" name="sort-name">
                <option value="">Сортировка по Имени</option>
                <option value="asc" <?php if (isset($_GET['sort-name']) && $_GET['sort-name'] === 'asc'):?>selected<?php endif;?> >По возрастанию</option>
                <option value="desc" <?php if (isset($_GET['sort-name']) && $_GET['sort-name'] === 'desc'):?>selected<?php endif;?> >По убыванию</option>
            </select>

            <select class="form-select w-auto" name="sort-email">
                <option value="">Сортировка по Email</option>
                <option value="asc" <?php if (isset($_GET['sort-email']) && $_GET['sort-email'] === 'asc'):?>selected<?php endif;?> >По возрастанию</option>
                <option value="desc" <?php if (isset($_GET['sort-email']) && $_GET['sort-email'] === 'desc'):?>selected<?php endif;?> >По убыванию</option>
            </select>

            <select class="form-select w-auto" name="sort-is_done">
                <option value="">Сортировка по Статусу</option>
                <option value="asc" <?php if (isset($_GET['sort-is_done']) && $_GET['sort-is_done'] === 'asc'):?>selected<?php endif;?> >По возрастанию</option>
                <option value="desc" <?php if (isset($_GET['sort-is_done']) && $_GET['sort-is_done'] === 'desc'):?>selected<?php endif;?> >По убыванию</option>
            </select>
        </div>

        <?php if (!count($data)):?>
            <div class="alert alert-info" role="alert">
                Задачи еще не добавлены!
            </div>
        <?php endif;?>

        <?php foreach ($data as $row):?>
            <div class="card mb-3 position-relative">
                <div class="card-body">
                    <h5 class="card-title">Задача #<?=sprintf("%04d", $row['id']);?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?=$row['name'];?> (<?=$row['email'];?>)</h6>
                    <p class="card-text"><?=$row['text'];?></p>

                    <?php if ($auth::isAuth()):?>
                        <a href="#" class="card-link" data-bs-toggle="collapse" data-bs-target="#collapseSave-<?=$row['id'];?>" aria-expanded="false" aria-controls="collapseSave-<?=$row['id'];?>">Редактировать</a>
                        <button type="button" onclick="onClickRemove(<?=$row['id'];?>)" class="btn btn-link text-danger">Удалить</button>
                    <?php endif;?>
                    
                    <?php if ($row['save_user_id']):?>
                        <div class="position-absolute top-0 end-0 bg-info text-white card-status">Отредактировано администратором</div>
                    <?php endif;?>

                    <?php if ($row['is_done']):?>
                        <div class="position-absolute <?=($row['save_user_id'])?'my-top-30':'top-0';?> end-0 bg-success text-white card-status">Выполнено</div>
                    <?php endif;?>
                </div>
                <?php if ($auth::isAuth()):?>
                    <div class="collapse mb-3" id="collapseSave-<?=$row['id'];?>">
                        <div class="card card-body card-body-bg">
                            <form onsubmit="onSubmitTaskSave(this); return false;">
                                <input type="hidden" name="taskid" value="<?=$row['id'];?>">
                                <input type="hidden" name="user_id" value="<?=$auth::getUserId();?>">
                                <div class="mb-3">
                                    <label for="formControl-Text" class="form-label">Текст</label>
                                    <textarea class="form-control" name="text" id="formControl-Text" rows="3"><?=$row['text'];?></textarea>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" role="switch" id="formControl-IsDone"<?php if ($row['is_done']):?>checked<?php endif;?> name="is_done">
                                    <label class="form-check-label" for="formControl-IsDone">Выполнено</label>
                                </div>
                                <div id="liveAlertPlaceholder"></div>
                                <button class="btn btn-primary">Сохранить задачу</button>
                            </form>
                        </div>
                    </div>
                <?php endif;?>
            </div>
        <?php endforeach;?>
        <div class="row">
            <div class="col"><?php $pagination->pg_print();?></div>
        </div>
    </div>
</div>

<?php view('todo', 'include/page-bottom.htm.php');?>
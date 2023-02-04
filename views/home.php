<?php $title = 'Главная';

include_once "shared/layout_header.php"; ?>

<body>
<div class="text-center">

    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button id="upload-file" class="btn btn-link link-dark text-decoration-none"
                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                            aria-controls="collapseOne">
                        <i class="fa-solid fa-caret-down"></i> Загрузить файл
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">

                <form method="post" action="/b1task/index.php" enctype="multipart/form-data" class="card-body">
                    <div class="m-0 p-0">
                        <div class="mt-3">
                            <div class="text-center mt-3">
                                <label for="file" id="drop-area" class="col-12 p-5 border border-5 rounded">
                                    <i class="fa fa-cloud-upload"></i> Выберите или перетащите файл ...
                                </label>
                                <input type="file" id="file" name="file" class="d-none" accept="text/csv">
                                <button id="file-upload" class="d-none">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button id="uploaded-file" class="btn btn-link collapsed link-dark text-decoration-none"
                            data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                            aria-controls="collapseTwo">
                        <i class="fa-solid fa-caret-down"></i> Загруженные файлы
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <?php /*@foreach (var balanceFile in Model)
                            {
                            <div class="col-lg-3 mb-4">
                                <div class="form-control">
                                    <h3>@balanceFile.FileName</h3>

                                    <a type="button" class="btn btn-outline-primary"
                                       href="Home/BalanceFile/@balanceFile.BalanceFileId">
                                        Открыть
                                    </a>
                                </div>
                            </div>
                            }*/ ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
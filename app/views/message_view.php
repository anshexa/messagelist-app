<?php
declare(strict_types=1);


class MessageView
{
    public function renderMessageList(array $messages): void
    { ?>

        <h1>Список сообщений</h1>
        <br>

        <?php
        foreach ($messages['messages'] as $message) { ?>
            <div class="card mb-2">
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="/message.php?id=<?= $message["id"] ?>" class="stretched-link text-decoration-none">
                            <?= htmlspecialchars($message["title"]) // экранируем спецсимволы для защиты от XSS  ?>
                        </a>
                    </h4>
                    <p class="card-text"><?= htmlspecialchars($message["summary"]) ?></p>
                </div>
            </div>
            <?php
        } ?>

        <?php

        function displayPagination(int $currentPage, int $totalPages): void
        { ?>
            <nav aria-label="pagination">
                <ul class="pagination pagination-sm">
                    <? for ($i = 1; $i <= $totalPages; $i++) {
                        if ($i == $currentPage) { ?>
                            <li class="page-item active" aria-current="page">
                                <span class="page-link"><?= $i ?></span>
                            </li> <?
                        } else { ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li> <?
                        }
                    } ?>
                </ul>
            </nav> <?
        } ?>

        <br>
        <?php
        // Отображение пагинации
        if ($messages['totalPages'] != 1) {
            displayPagination($messages['currentPage'], $messages['totalPages']);
        }


        // форма добавления сообщения
        ?>
        <br>

        <form action="" method="post" id="addMess" class="p-4 border border-dark border-opacity-25 rounded">
            <input type="hidden" name="form_type" value="add_message">

            <fieldset>
                <legend>Создать сообщение</legend>

                <div class="row mb-3">
                    <label for="title" class="col-sm-2 col-form-label">Заголовок</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="summary" class="col-sm-2 col-form-label">Краткое содержание</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="summary" name="summary" required></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="text" class="col-sm-2 col-form-label">Полное содержание</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="text" name="text" required></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="author" class="col-sm-2 col-form-label">Автор</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="author" name="author" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Отправить</button>
            </fieldset>
        </form>

        <?php
    }


    public function renderMessage(array $message): void
    { ?>
        <div class="pb-3 mb-4">
            <a href="/" class="link-primary">
                К списку сообщений
            </a>
        </div>

        <div class="content">

            <div class="pb-2 mb-4 border-bottom">
                <h2><?= htmlspecialchars($message["title"]) ?></h2>
            </div>
            <p><em><?= htmlspecialchars($message["author"]) ?></em></p>
            <p><?= htmlspecialchars($message["summary"]) ?></p>
            <p><?= htmlspecialchars($message["text"]) ?></p>
        </div>
        <br>

        <form action="" method="post" id="editMess" class="p-4 border border-dark border-opacity-25 rounded">
            <input type="hidden" name="form_type" value="edit_message">

            <fieldset>
                <legend>Редактировать сообщение</legend>

                <div class="row mb-3">
                    <label for="title" class="col-sm-2 col-form-label">Заголовок</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title"
                               value="<?= htmlspecialchars($message["title"]) ?>" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="summary" class="col-sm-2 col-form-label">Краткое содержание</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="summary" name="summary"
                                  required><?= htmlspecialchars($message["summary"]) ?></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="text" class="col-sm-2 col-form-label">Полное содержание</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="text" name="text"
                                  required><?= htmlspecialchars($message["text"]) ?></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Сохранить</button>
            </fieldset>
        </form>
        <br>

        <?php
    }

}

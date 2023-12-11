<?php
declare(strict_types=1);


class CommentView
{
    public function renderListComments(array $comments): void
    { ?>

        <h3>Комментарии</h3>

        <?php
        foreach ($comments as $comment) { ?>
            <div class="comment">
                <p><em><?= $comment["author"] ?></em></p>
                <p><?= $comment["text"] ?></p>
            </div>
            <hr>
            <?php
        } ?>

        <form action="" method="post" id="addComment" class="p-4 border border-dark border-opacity-25 rounded">
            <input type="hidden" name="form_type" value="add_comment">

            <fieldset>
                <legend>Добавить комментарий</legend>

                <div class="row mb-3">
                    <label for="text" class="col-sm-2 col-form-label">Текст</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="text" name="text"
                                  required></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="author" class="col-sm-2 col-form-label">Автор</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="author" name="author"
                               required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Отправить</button>
            </fieldset>
        </form>
        <br>

        <?php
    }

}

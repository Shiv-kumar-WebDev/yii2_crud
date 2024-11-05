<?php

/** @var yii\web\View $this */
use yii\helpers\Url;

$this->title = 'To-do List Application';
?>
<?php
// Check if there is an error flash message
if (Yii::$app->session->hasFlash('error')) {
    // Get the flash message
    $errorMessage = Yii::$app->session->getFlash('error');
    echo '<div class="alert alert-danger">' . htmlspecialchars($errorMessage) . '</div>';
}

// Optionally, you can check for a success message too
if (Yii::$app->session->hasFlash('success')) {
    $successMessage = Yii::$app->session->getFlash('success');
    echo '<div class="alert alert-success">' . htmlspecialchars($successMessage) . '</div>';
}
?>
<div style="display: grid;grid-template-columns:1fr 4fr;padding: 2rem 5rem;">
    <h1>handysolver</h1>
    <div>
        <h2 style="text-align: center;">To-do List Application</h2>
        <p style="text-align: center;">Where to-do items are added/deleted and belong to categories</p>
    </div>
</div>
<div>
    <div style="display: flex;padding:2rem 5rem;justify-content:center;gap:4rem">
        <div>
            <form action="<?= \yii\helpers\Url::to(['site/create']) ?>" method="post">
            <select name="category_id" id="category">
                <option value="">Category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                <div>
                    <input name="toDo" style="width:500px" type="text" id="toDoName" value="<?= isset($oldToDoName) ? htmlspecialchars($oldToDoName) : ''; ?>">
                    <button type="submit" style="background: green;color:white" id="addTodo">Add</button>
                </div>
            </form>
            </div>
    </div>
    <div style="padding: 2rem 5rem;">
        <table border="1" width="100%">
            <tr style="background: lightgray;">
                <td>Todo item name</td>
                <td>Category</td>
                <td>Timestamp</td>
                <td>Actions</td>
            </tr>
            <?php foreach ($toDos as $toDo): ?>
            <tr data-id="<?= $toDo['id']; ?>"> <!-- Add data-id for the row -->
                <td><?= $toDo['todo_name']; ?></td>
                <td><?= $toDo['category_name']; ?></td>
                <td><?php $date = new DateTime($toDo['timestamp']);
                echo $date->format('jS F'); ?></td>
                <td><a href="<?= Url::to(['site/delete', 'id' => $toDo['id']]) ?>" class="delete-todo" style="background: red; color: white; padding: .3rem; text-decoration: none;">Delete</a></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
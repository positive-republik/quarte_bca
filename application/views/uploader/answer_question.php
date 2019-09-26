<div class="form-group">
    <label for="question">Question</label>
    <input type="text" class="form-control" id="question" value="<?= $question['question']; ?>" disabled>
</div>
<?php if ($question['status'] == null || $question['status'] == 1) : ?>
    <div class="form-group">
        <label for="answer">Answer</label>
        <textarea class="form-control" id="answer" name="answer" rows="5" required></textarea>
    </div>
    <div class="form-group">
        <label for="answer_link">Link</label>
        <input type="text" class="form-control" id="answer_link" name="answer_link" required>
    </div>
<?php else : ?>
    <div class="form-group">
        <label for="answer">Answer</label>
        <textarea class="form-control" id="answer" name="answer" rows="5" required readonly><?= $question['answer'] ?></textarea>
    </div>
    <div class="form-group">
        <label for="answer_link">Link</label>
        <input type="text" class="form-control" id="answer_link" name="answer_link" value="<?= $question['answer_link'] ?>" required readonly>
    </div>
<?php endif; ?>

<input type="hidden" name="id" value="<?= $question['id'] ?>">
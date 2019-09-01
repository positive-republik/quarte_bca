<div class="form-group">
    <label for="question">Question</label>
    <input type="text" class="form-control" id="question" value="<?= $question['question']; ?>" disabled>
</div>
<div class="form-group">
    <label for="answer">Answer</label>
    <textarea class="form-control" id="answer" name="answer" rows="5" required></textarea>
</div>
<div class="form-group">
    <label for="answer_link">Link</label>
    <input type="text" class="form-control" id="answer_link" name="answer_link" required>
</div>

<input type="hidden" name="id" value="<?= $question['id'] ?>">

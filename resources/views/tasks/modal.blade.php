<div class="modal fade" id="taskModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="task-form" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="taskModalLabel">Add Task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="text" name="title" id="title" class="form-control" placeholder="Task title" required>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>

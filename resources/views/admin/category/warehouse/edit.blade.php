<form action="{{ route('warehouse.update') }}" method="Post" id="add-form">
  @csrf
  <div class="modal-body">
    <div class="form-group">
      <label for="warehouse_name" class="form-label">Warehouse Name</label>
      <input type="text" class="form-control" name="warehouse_name" required="" value="{{ $warehouse->warehouse_name }}">
    </div>
    <input type="hidden" name="id" value="{{ $warehouse->id }}">
    <div class="form-group">
      <label for="warehouse_address" class="form-label">Warehouse Address</label>
      <input type="text" class="form-control" name="warehouse_address" required="" value="{{ $warehouse->warehouse_address }}">
    </div>
    <div class="form-group">
      <label for="warehouse_phone" class="form-label">Warehouse Phone</label>
      <input type="text" class="form-control" name="warehouse_phone" required="" value="{{ $warehouse->warehouse_phone }}">
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger rounded font-sm hover-up" data-dismiss="modal">Close</button>
    <button type="Submit" class="btn btn-light rounded font-sm mr-5 text-body hover-up">Update</button>
  </div>
</form>
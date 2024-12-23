<form action="{{ route('category.update') }}" method="Post" enctype="multipart/form-data">
  @csrf
  <div class="mb-4">
    <label for="product_name" class="form-label">Category Name</label>
    <input type="text" placeholder="Type here" id="category_name" class="form-control" name="category_name" value="{{ $data->category_name }}" />
  </div>
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="form-group">
    <label class="form-label">Category Icon</label>
    <input class="form-control" name="icon" type="file" id="icon">
    <input type="hidden" name="old_icon" value="{{ $data->icon }}">
  </div>
  <div class="form-group">
    <label class="form-label">Show categories on home</label>
    <select class="form-select" name="home_page">
      <option value="1" @if($data->home_page==1) selected @endif>Yes</option>
      <option value="0" @if($data->home_page==0) selected @endif>No</option>
    </select>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger rounded font-sm hover-up" data-dismiss="modal">Close</button>
    <button type="Submit" class="btn btn-light rounded font-sm mr-5 text-body hover-up">Submit</button>
  </div>
</form>
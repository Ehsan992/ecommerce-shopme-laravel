<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<form action="{{ route('developer.team.update') }}" method="Post" enctype="multipart/form-data">
  @csrf
  <div class="modal-body">
    <div class="mb-4">
      <label for="product_name" class="form-label">Name</label>
      <input type="text" placeholder="Type here" class="form-control" name="name" value="{{ $data->name }}" />
    </div>
    <input type="hidden" name="id" value="{{ $data->id }}">
    <div class="form-group">
      <label class="form-label">Image</label>
      <input class="form-control" name="image" type="file">
      <input type="hidden" name="old_image" value="{{ $data->image }}">
    </div>
    <div class="mb-4">
      <label for="product_name" class="form-label">Roles</label>
      <input type="text" placeholder="Type here" class="form-control" name="roles" value="{{ $data->roles }}" />
    </div>
    <div class="mb-4">
      <label for="product_name" class="form-label">Facebook</label>
      <input type="text" placeholder="Type here" class="form-control" name="facebook" value="{{ $data->facebook }}" />
    </div>
    <div class="mb-4">
      <label for="product_name" class="form-label">Twitter</label>
      <input type="text" placeholder="Type here" class="form-control" name="twitter" value="{{ $data->twitter }}" />
    </div>
    <div class="mb-4">
      <label for="product_name" class="form-label">Instagram</label>
      <input type="text" placeholder="Type here" class="form-control" name="instagram" value="{{ $data->instagram }}" />
    </div>
    <div class="mb-4">
      <label for="product_name" class="form-label">Linkedin</label>
      <input type="text" placeholder="Type here" class="form-control" name="linkedin" value="{{ $data->linkedin }}" />
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger rounded font-sm hover-up" data-dismiss="modal">Close</button>
    <button type="Submit" class="btn btn-light rounded font-sm mr-5 text-body hover-up">Submit</button>
  </div>
</form>
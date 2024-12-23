 <form action="{{ route('childcategory.update') }}" method="Post" id="add-form">
   @csrf
   <div class="modal-body">
     <div class="form-group">
       <label for="category_name" class="form-label">Category/Subcategory</label>
       <select class="form-select" name="subcategory_id" required="">
         @foreach($category as $row)
         @php
         $subcat=DB::table('subcategories')->where('category_id',$row->id)->get();
         @endphp
         <option disabled="" style="color: blue;">{{ $row->category_name }}</option>
         @foreach($subcat as $row)
         <option value="{{ $row->id }}" @if($row->id == $data->subcategory_id) selected @endif >{{ $row->subcategory_name }}</option>
         @endforeach
         @endforeach
       </select>
       <input type="hidden" name="id" value="{{ $data->id }}">
     </div>
     <div class="form-group">
       <label for="category_name" class="form-label">Childcategory Name</label>
       <input type="text" class="form-control" name="childcategory_name" required="" value="{{ $data->childcategory_name }}">
       <small id="emailHelp" class="form-text text-muted">This is your childcategory category.</small>
     </div>
   </div>
   <div class="modal-footer">
     <button type="button" class="btn btn-danger rounded font-sm hover-up" data-dismiss="modal">Close</button>
     <button type="Submit" class="btn btn-light rounded font-sm mr-5 text-body hover-up">Update</button>
   </div>
 </form>
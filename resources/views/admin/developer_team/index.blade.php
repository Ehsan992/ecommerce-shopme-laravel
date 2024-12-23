@extends('layouts.admin')

@section('admin_content')

<main class="main-wrap">
  <section class="content-main">
    <div class="content-header">
      <div>
        <h2 class="content-title card-title">Member List </h2>
        <p>List of Member</p>
      </div>
      <div>
        <a href="#" class="btn btn-primary btn-sm rounded" data-toggle="modal" data-target="#categoryModal">Add new Member</a>
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table id="" class="table table-hover ytable">
            <thead>
              <tr>
                <th>#SL</th>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col">Roles</th>
                <th scope="col">Facebook</th>
                <th scope="col">Twitter</th>
                <th scope="col">Instagram</th>
                <th scope="col">Linkedin</th>
                <th scope="col" class="text-end"> Action </th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $key=>$row)
              <tr>
                <td>{{ $key+1 }}</td>
                <td><b>{{ $row->name }}</b></td>
                <td> <img src="{{ asset($row->image) }}" class="img-sm img-thumbnail" alt="Item"> </td>
                <td><b>{{ $row->roles }}</b></td>
                <td><b>{{ $row->facebook }}</b></td>
                <td><b>{{ $row->twitter }}</b></td>
                <td><b>{{ $row->instagram }}</b></td>
                <td><b>{{ $row->linkedin }}</b></td>
                <td class="text-end">
                  <a href="#" class="btn btn-sm font-sm rounded btn-brand  hover-up edit" data-id="{{ $row->id }}" data-toggle="modal" data-target="#editModal"><i class="material-icons md-edit" style="font-size: 1.5em;color: white;"></i>Edit</a>
                  <a href="{{ route('developer.team.delete',$row->id) }}" class="btn btn-sm font-sm btn-danger rounded hover-up"><i class="material-icons md-delete_forever" style="font-size: 1.5em;color: white;"></i> Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div> <!-- table-responsive //end -->
      </div> <!-- card-body end// -->
    </div> <!-- card end// -->
  </section> <!-- content-main end// -->
</main>



<style>
    .modal-header {
        background-color: #5897fb;
        /* Change this to your desired background color */
        color: #333;
        /* Change this to your desired text color */
    }

    .modal-title-custom {
        font-weight: none;
        color: white;
    }
</style>


<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

{{-- category insert modal --}}
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title modal-title-custom" id="exampleModalLabel">Add New Member</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background: none;">
                    <i class="fa-solid fa-square-xmark" aria-hidden="true" style="font-size: 2em;color: white;"></i>
                </button>
            </div>
            <form action="{{ route('developer.team.store') }}" method="Post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="product_name" class="form-label">Name</label>
                        <input type="text" placeholder="Type here" class="form-control" name="name" id="product_name" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Image</label>
                        <input class="form-control" name="image" type="file">
                    </div>
                    <div class="mb-4">
                        <label for="product_name" class="form-label">Roles</label>
                        <input type="text" placeholder="Type here" class="form-control" name="roles" id="product_name" />
                    </div>
                    <div class="mb-4">
                        <label for="product_name" class="form-label">Facebook</label>
                        <input type="text" placeholder="Type here" class="form-control" name="facebook" id="product_name" />
                    </div>
                    <div class="mb-4">
                        <label for="product_name" class="form-label">Twitter</label>
                        <input type="text" placeholder="Type here" class="form-control" name="twitter" id="product_name" />
                    </div>
                    <div class="mb-4">
                        <label for="product_name" class="form-label">Instagram</label>
                        <input type="text" placeholder="Type here" class="form-control" name="instagram" id="product_name" />
                    </div>
                    <div class="mb-4">
                        <label for="product_name" class="form-label">Linkedin</label>
                        <input type="text" placeholder="Type here" class="form-control" name="linkedin" id="product_name" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger rounded font-sm hover-up" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-light rounded font-sm mr-5 text-body hover-up">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


{{-- edit modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title modal-title-custom" id="exampleModalLabel">Edit Member</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background: none;">
                    <i class="fa-solid fa-square-xmark" aria-hidden="true" style="font-size: 2em; color: white;"></i>
                </button>
            </div>
            <div class="modal-body" id="modal_body">

            </div>
        </div>
    </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

<script type="text/javascript">
    $('body').on('click', '.edit', function() {
        let cat_id = $(this).data('id');
        $.get("developer-team/edit/" + cat_id, function(data) {
            $("#modal_body").html(data);
        });
    });
</script>
@endsection
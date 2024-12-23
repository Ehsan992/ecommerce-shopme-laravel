@php
$color=explode(',',$product->color);
$sizes=explode(',',$product->size);
@endphp
<div class="card">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="{{ asset($product->thumbnail) }}" alt="Product Image" class="card-img">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h2 class="card-title">{{ $product->name }}</h2>
        <p class="card-text">{{ $product->category->category_name }} > {{ $product->subcategory->subcategory_name }}</p>
        <p class="card-text">Brand: {{ $product->brand->brand_name }}</p>
        <p class="card-text">Stock: {{ $product->unit }} pc</p>
        <p class="card-text">Size:
          @isset($product->size)
          @foreach($sizes as $size)
          <span class="badge rounded-pill alert-success">{{ $size }}</span>
          @endforeach
          @endisset
        </p>

        @isset($product->color)
        <p class="card-text">Color:
          @foreach($color as $row)
          <span class="badge rounded-pill alert-success">{{ $row }}</span>
          @endforeach
          @endisset
        </p>
        <p class="card-text">Purchase Price: {{ $product->purchase_price }}</p>
        <p class="card-text">Selling Price: {{ $product->selling_price }}</p>
        @if($product->discount_price!=NULL)
        <p class="card-text">Discount Price: {{ $product->discount_price }}</p>
        @endif
      </div>
    </div>
  </div>
</div>
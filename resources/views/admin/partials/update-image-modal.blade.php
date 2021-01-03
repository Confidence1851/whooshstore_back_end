 <!-- Modal -->
 <div class="modal fade" id="image_modal_{{ $image->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <h2 class="card-title">Add Product Images</h2>
            <form action="{{ route("products.image.save") }}" method="post" enctype="multipart/form-data">@csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}" id="" >
                <input type="hidden" name="image_id" value="{{ $image->id }}" id="" >
                <input type="file" name="image" id="">
                <input class="btn btn-primary mt-5" type="submit" value="Submit">    
            </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div> 
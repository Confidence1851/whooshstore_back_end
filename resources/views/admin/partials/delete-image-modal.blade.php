<div class="modal fade bd-example-modal-md" id="del-{{ $product->id }}">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
          <div class="modal-header mb-3">
              <h5 class="modal-title">Delete Product Image </h5>
              <button type="button" class="close"
                  data-dismiss="modal"><span>&times;</span></button></h5>
          </div>
          <div class="modal-body">
              <small>
                  Are you sure? Deleting this would Remove this product-image from
                  the database
              </small>
              <form action="{{ route('products.image.delete',$product->id) }}" method="post">
                    @csrf 
                    @method('delete')
                  <div class="modal-footer">
                      <button class="btn btn-outline-info btn-sm"
                          type="button" class="close"
                          data-dismiss="modal">Cancel</button>
                      <button type="submit"
                          class="btn btn-outline-danger btn-sm">Proceed</button>
                  </div>
              </form>  
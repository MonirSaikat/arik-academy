<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLbel" aria-hidden="true">
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="addModalLabel">Add school worker picture</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="errMsgContainer">
                    </div>
               
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="name" name="name" id="name" class="form-control">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                      <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                         <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo">
                      </div>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
    </form>
</div>

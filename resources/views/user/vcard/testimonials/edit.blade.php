<!-- Create Testimonial Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLongTitle">Add vCard Testimonial</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
 
             <form id="ajaxEditForm" enctype="multipart/form-data" class="modal-form" action="{{route('user.vcard.testimonialUpdate')}}" method="POST">
                @csrf
                <input id="intestimonial_id" type="hidden" name="testimonial_id">
                <div class="row">
                   <div class="col-lg-12">
                     <div class="form-group">
                       <div class="col-12 mb-2">
                         <label for="image"><strong>Image*</strong></label>
                       </div>
                       <div class="col-md-12 showImage mb-3">
                         <img id="inimage" src="{{asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail image">
                       </div>
                       <input type="file" name="image" id="image" class="form-control">
                       <p id="eerrimage" class="mb-0 text-danger em"></p>
                     </div>
                   </div>
                 </div>
                <div class="form-group">
                   <label for="">Name **</label>
                   <input id="inname" type="text" class="form-control {{$vcard->direction == 2 ? 'rtl' : ''}}" name="name" placeholder="Enter name" value="">
                   <p id="eerrname" class="mb-0 text-danger em"></p>
                </div>
                <div class="form-group">
                   <label for="">Rating **</label>
                   <input id="inrating" type="text" class="form-control ltr" name="rating" placeholder="Enter rating" value="" min="1" max="5"> 
                   <p class="text-warning mb-0">Rating must be between 1 to 5</p>
                   <p id="eerrrating" class="mb-0 text-danger em"></p>
                </div>
                
               <div class="form-group" >
                  <label for="">Comment</label>
                  <textarea id="incomment" class="form-control {{$vcard->direction == 2 ? 'rtl' : ''}}" name="comment" rows="4" cols="80" placeholder="Enter short details"></textarea>
                  <p id="eerrcomment" class="mb-0 text-danger em"></p>
               </div>
 
                <div class="form-group">
                   <label for="">Serial Number **</label>
                   <input id="inserial_number" type="number" class="form-control ltr" name="serial_number" value="" placeholder="Enter Serial Number">
                   <p id="eerrserial_number" class="mb-0 text-danger em"></p>
                   <p class="text-warning mb-0"><small>The higher the serial number is, the later the testimonial will be shown.</small></p>
                </div>
             </form>
          </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             <button id="updateBtn" type="button" class="btn btn-primary">Update</button>
          </div>
       </div>
    </div>
 </div>



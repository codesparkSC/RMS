@extends('layouts.master')
@section('title') @lang('translation.order-details') @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Order @endslot
        @slot('title') Orders Details @endslot
    @endcomponent
    <input type="hidden" name="seller_id" id="seller_id" value={{Auth::user()->seller_id}}>
    <div class="row">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-header">
                   <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Order #{{$id}}</h5>
                        <div class="flex-shrink-0" id="status_action">
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#approveModel"><i class="ri-download-2-fill align-middle me-1"></i> Mark As Paid</button>

                            {{-- <button  class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModel"><i class="ri-download-2-fill align-middle me-1"></i> Reject Order</button> --}}

                        </div>
                   </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                  <th scope="col">Product Details</th>
                                  <th scope="col">Item Price</th>
                                  <th scope="col">Quantity</th>
                                  {{-- <th scope="col">Rating</th> --}}
                                  <th scope="col" class="text-end">Total Amount</th>
                                  {{-- <th scope="col" >Action</th> --}}
                                </tr>
                              </thead>
                            <tbody id="product_list">
                                {{-- <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                <img src="{{ URL::asset('assets/images/products/img-8.png') }}" alt="" class="img-fluid d-block">
                                            </div>
                                           <div class="flex-grow-1 ms-3">
                                                <h5 class="fs-15"><a href="apps-ecommerce-product-details" class="link-primary">Sweatshirt for Men (Pink)</a></h5>
                                                <p class="text-muted mb-0">Color: <span class="fw-medium">Pink</span></p>
                                                <p class="text-muted mb-0">Size: <span class="fw-medium">M</span></p>
                                           </div>
                                        </div>
                                    </td>
                                    <td>$119.99</td>
                                    <td>02</td>
                                   
                                    <td class="fw-medium text-end">
                                        $239.98
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                <img src="{{ URL::asset('assets/images/products/img-7.png') }}" alt="" class="img-fluid d-block">
                                            </div>
                                           <div class="flex-grow-1 ms-3">
                                                <h5 class="fs-15"><a href="apps-ecommerce-product-details" class="link-primary">Noise NoiseFit Endure Smart Watch</a></h5>
                                                <p class="text-muted mb-0">Color: <span class="fw-medium">Black</span></p>
                                                <p class="text-muted mb-0">Size: <span class="fw-medium">32.5mm</span></p>
                                           </div>
                                        </div>
                                    </td>
                                    <td>$94.99</td>
                                    <td>01</td>
                                   
                                    <td class="fw-medium text-end">
                                        $94.99
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                <img src="{{ URL::asset('assets/images/products/img-3.png') }}" alt="" class="img-fluid d-block">
                                            </div>
                                           <div class="flex-grow-1 ms-3">
                                                <h5 class="fs-15"><a href="apps-ecommerce-product-details" class="link-primary">350 ml Glass Grocery Container</a></h5>
                                                <p class="text-muted mb-0">Color: <span class="fw-medium">White</span></p>
                                                <p class="text-muted mb-0">Size: <span class="fw-medium">350 ml</span></p>
                                           </div>
                                        </div>
                                    </td>
                                    <td>$24.99</td>
                                    <td>01</td>
                                  
                                    <td class="fw-medium text-end">
                                        $24.99
                                    </td>
                                </tr>
                                <tr class="border-top border-top-dashed">
                                    <td colspan="3"></td>
                                    <td colspan="2" class="fw-medium p-0">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>Sub Total :</td>
                                                    <td class="text-end">$359.96</td>
                                                </tr>
                                                <tr>
                                                    <td>Discount <span class="text-muted">(VELZON15)</span> : :</td>
                                                    <td class="text-end">-$53.99</td>
                                                </tr>
                                                <tr>
                                                    <td>Shipping Charge :</td>
                                                    <td class="text-end">$65.00</td>
                                                </tr>
                                                <tr>
                                                    <td>Estimated Tax :</td>
                                                    <td class="text-end">$44.99</td>
                                                </tr>
                                                <tr class="border-top border-top-dashed">
                                                    <th scope="row">Total (USD) :</th>
                                                    <th class="text-end">$415.96</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!--end card-->
            <div class="card" style="display:none;">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Order Status</h5>
                        <div class="flex-shrink-0 mt-2 mt-sm-0">
                            <a href="javasccript:void(0;)" class="btn btn-soft-info btn-sm mt-2 mt-sm-0"><i class="ri-map-pin-line align-middle me-1"></i> Change Address</a>
                            <a href="javasccript:void(0;)" class="btn btn-soft-danger btn-sm mt-2 mt-sm-0"><i class="mdi mdi-archive-remove-outline align-middle me-1"></i> Cancel Order</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="profile-timeline">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingOne">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="ri-shopping-bag-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-0 fw-semibold">Order Placed - <span class="fw-normal">Wed, 15 Dec 2021</span></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <h6 class="mb-1">An order has been placed.</h6>
                                        <p class="text-muted">Wed, 15 Dec 2021 - 05:34PM</p>

                                        <h6 class="mb-1">Seller has proccessed your order.</h6>
                                        <p class="text-muted mb-0">Thu, 16 Dec 2021 - 5:48AM</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingTwo">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="mdi mdi-gift-outline"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-1 fw-semibold">Packed - <span class="fw-normal">Thu, 16 Dec 2021</span></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <h6 class="mb-1">Your Item has been picked up by courier patner</h6>
                                        <p class="text-muted mb-0">Fri, 17 Dec 2021 - 9:45AM</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingThree">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="ri-truck-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-1 fw-semibold">Shipping - <span class="fw-normal">Thu, 16 Dec 2021</span></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <h6 class="fs-14">RQK Logistics - MFDS1400457854</h6>
                                        <h6 class="mb-1">Your item has been shipped.</h6>
                                        <p class="text-muted mb-0">Sat, 18 Dec 2021 - 4.54PM</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingFour">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseFour" aria-expanded="false">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-light text-success rounded-circle">
                                                    <i class="ri-takeaway-fill"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-0 fw-semibold">Out For Delivery</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingFive">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseFile" aria-expanded="false">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-light text-success rounded-circle">
                                                    <i class="mdi mdi-package-variant"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-0 fw-semibold">Delivered</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div><!--end accordion-->
                    </div>
                </div>
            </div><!--end card-->
        </div><!--end col-->
        <div class="col-xl-3">
            {{-- <div class="card">
                <div class="card-header">
                   <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0"><i class="mdi mdi-truck-fast-outline align-middle me-1 text-muted"></i> Logistics Details</h5>
                        <div class="flex-shrink-0">
                            <a href="javascript:void(0);" class="badge badge-soft-primary fs-11">Track Order</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <lord-icon src="https://cdn.lordicon.com/uetqnvvg.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:80px;height:80px"></lord-icon>
                        <h5 class="fs-16 mt-2">RQK Logistics</h5>
                        <p class="text-muted mb-0">ID: MFDS1400457854</p>
                        <p class="text-muted mb-0">Payment Mode : Debit Card</p>
                    </div>
                </div>
            </div><!--end card--> --}}

            <div class="card">
                <div class="card-header">
                   <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Customer Details</h5>
                        {{-- <div class="flex-shrink-0">
                            <a href="javascript:void(0);" class="link-secondary">View Profile</a>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 vstack gap-3">
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ URL::asset('assets/images/users/avatar-3.jpg') }}" alt="" class="avatar-sm rounded" id="customer_avater">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                   <h6 class="fs-14 mb-1" id="customer_name"></h6>
                                   <p class="text-muted mb-0">Customer/Staff</p>
                                </div>
                            </div>
                        </li>
                        <li><i class="ri-mail-line me-2 align-middle text-muted fs-16" ></i><span id="customer_email"></span></li>
                        {{-- <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>+(256) 245451 441</li> --}}
                    </ul>
                </div>
            </div><!--end card-->
            {{-- <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Billing Address</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                        <li class="fw-medium fs-14">Joseph Parker</li>
                        <li>+(256) 245451 451</li>
                        <li>2186 Joyce Street Rocky Mount</li>
                        <li>New York - 25645</li>
                        <li>United States</li>
                    </ul>
                </div>
            </div><!--end card--> --}}
            {{-- <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Shipping Address</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                        <li class="fw-medium fs-14" id="ship_name"></li>
                        <li id="ship_mobile"></li>
                        <li id="ship_address"></li>
                        <li id="ship_city"></li>
                        <li id="ship_zipcode"></li>
                    </ul>
                </div>
            </div><!--end card--> --}}

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="ri-secure-payment-line align-bottom me-1 text-muted"></i> Payment Details</h5>
                </div>
                <div class="card-body">
                    {{-- <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                           <p class="text-muted mb-0">Transactions:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">#VLZ124561278124</h6>
                         </div>
                    </div> --}}
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                           <p class="text-muted mb-0">Payment Method:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0" id="payment_method"></h6>
                         </div>
                    </div>
                    {{-- <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                           <p class="text-muted mb-0">Card Holder Name:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">Joseph Parker</h6>
                         </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                           <p class="text-muted mb-0">Card Number:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">xxxx xxxx xxxx 2456</h6>
                         </div>
                    </div> --}}
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                           <p class="text-muted mb-0">Total Amount:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0" id="payment_total"></h6>
                         </div>
                    </div>
                </div>
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->

       <!-- removeItemModal -->
       {{-- <div id="removeItemModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form id="order_approve">
                    <div class="mt-2 text-center">
                        <div class="col-xxl-3 col-md-12">
                            <div class="text-start">
                                <label for="exampleFormControlTextarea5" class="form-label">Delivery Date <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" data-provider="flatpickr" data-date-format="Y/m/d" placeholder="Select Delivery Date" id="delivery_date" name="delivery_date">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-success">Yes, Approve It!</button>
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        
                    </div>
                </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> --}}
    <div class="modal fade" id="approveModel" tabindex="-1" aria-labelledby="exampleModalgridLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Mark As Paid</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0);">
                        <div class="row g-3">
                            <h2>Are You Sure Want to Mark As Paid?</h2>
                           
                            {{-- <div class="col-xxl-6">
                                <label for="emailInput" class="form-label">Delivery Date</label>
                                <input type="date" class="form-control" id="delivery_date" placeholder="Select Delivery Date">
                              
                            </div><!--end col-->

                            <div class="col-xxl-6">
                                <label for="emailInput" class="form-label">Delivery Time</label>
                                <input type="time" class="form-control" id="delivery_time" placeholder="Select Delivery Time">
                            </div><!--end col--> --}}
                         
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="approve_order()">Yes</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rejectModel" tabindex="-1" aria-labelledby="exampleModalgridLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Reject Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0);">
                        <div class="row g-3">
                            
                           
                            <div class="col-xxl-6">
                                <label for="emailInput" class="form-label">Reason</label>
                                <textarea class="form-control" id="reason" name="reason" rows="3">Sorry ! Currently this product is not present. 
                                </textarea>
                            </div><!--end col-->
                         
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="reject_order()">Submit</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
    <script src="{{ URL::asset('assets/js/pages/notifications.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/prismjs/prismjs.min.js') }}"></script>
    <script>
         var order_id='{{$id}}';
            var seller_id=$('#seller_id').val();
         $(document).ready(function(){
            getdetails();
            // var current_date = new Date().toISOString().split("T")[0];
            // console.log(current_date)
            // $('#delivery_date').attr('min',current_date)
        });

        function getdetails()
        {
            if(order_id!=0)
            {
                $.ajax({
                type: "POST",
                url: base_url+"order_details",
                data: {order_id:order_id,seller_id:seller_id},
                success: function(result) {
                    console.log("ajax data=", result)
                    if(result.data.orders)
                    {
                        if(result.data.customer)
                        {
                        //    $('#customer_name').text(result.data.customer.name);
                           $('#customer_email').text(result.data.customer.email);
                        }
                        if(result.data.staff)
                        {
                        //    $('#customer_name').text(result.data.customer.name);
                           $('#customer_email').text(result.data.staff.email);
                        }
                        $('#payment_method').text(result.data.orders.payment_type);
                        $('#payment_total').text(result.data.orders.total_payment);
                        if(result.data.orders.seller_status!=0)
                        {
                            $('#status_action').hide();
                        }
                    
                        var list='';
                       // for(var i = 0; i < (result.data.product).length; i++) {
                        (result.data.product).forEach(function(el, index) {
                           list+= `<tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                <img src="${file_url}${el.image}" alt="" class="img-fluid d-block w-100 h-100">
                                            </div>
                                           <div class="flex-grow-1 ms-3">
                                                <h5 class="fs-15">${el.product_name}</h5>
                                           </div>
                                        </div>
                                    </td>
                                    <td>${el.currency} ${el.price}</td>
                                    <td>${el.quantity}</td>
                                   
                                    <td class="fw-medium text-end">
                                        ${el.currency} ${el.price * el.quantity}
                                    </td>
                                   
                                </tr>`;
                            });
                        $('#product_list').append(list);
                        console.log(list)
                        
                    }      
                },
                error: function(error) {
                    console.log(error)
                    $('#error_msg').attr('data-toast-text',error.responseJSON.message).trigger('click');
                 }
                });
            }
        }

        function update_status(id,status)
        {
            $.ajax({
                type: "POST",
                url: base_url+"order_item_status/",
                data: {item_id:id,status:status},
                success: function(result) {
                    console.log("ajax data=", result)     
                    $('#success_msg').attr('data-toast-text',result.message).trigger('click');
                },
                error: function(error) {
                    console.log(error)
                    $('#error_msg').attr('data-toast-text',error.responseJSON.message).trigger('click');
                 }
                });
    
        }

    // function openapprovemodel(id)
    // {
    //     console.log(id)
    //     $('#approveModel').modal('show');
       
    // }

    function approve_order()
        {
            // var delivery_date=$('#delivery_date').val();
            // var delivery_time=$('#delivery_time').val();
           
            // if(delivery_date =='' && delivery_time =='')
            // {
            //     $('#error_msg').attr('data-toast-text','Please Select Delivery Date and Time').trigger('click');
            // }
            // else{
            $.ajax({
                type: "POST",
                url: base_url+"approve_order",
                data: {order_id:order_id,seller_id:seller_id},  
                success: function(result) {
                    console.log("ajax data=", result)   
                    $('#approveModel').modal('hide');  
                    $('#success_msg').attr('data-toast-text',result.message).trigger('click');
                    window.location.href='/orders_billed';
                },
                error: function(error) {
                    console.log(error)
                    $('#error_msg').attr('data-toast-text',error.responseJSON.message).trigger('click');
                 }
                });
          //  }
    
        }

        
    function reject_order()
        {
            var reason=$('#reason').val();
        
            if(reason =='' )
            {
                $('#error_msg').attr('data-toast-text','Please Enter Reason').trigger('click');
            }
            else{
            $.ajax({
                type: "POST",
                url: base_url+"reject_order",
                data: {order_id:order_id,seller_id:seller_id,reason:reason},  
                success: function(result) {
                    console.log("ajax data=", result)   
                    $('#rejectModel').modal('hide');  
                    $('#success_msg').attr('data-toast-text',result.message).trigger('click');
                    window.location.href='/orders';
                },
                error: function(error) {
                    console.log(error)
                    $('#error_msg').attr('data-toast-text',error.responseJSON.message).trigger('click');
                 }
                });
            }
    
        }

    </script>
@endsection

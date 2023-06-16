@extends('layouts.master')
@section('title')
    Billed Orders
@endsection
@section('css')
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
        Orders
        @endslot
        @slot('title')
            Billed Orders
        @endslot
    @endcomponent
    <div class="row">
   
        <div class="col-xl-12 col-lg-12">
            <div>
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row g-4">
                            <div class="col-sm-6">
                                  @if(Auth::user()->role==1)
                                    <div class="search-box ms-2">
                                        <h6 class="fw-semibold">Seller List</h6>
                                        <select class="seller_list" name="seller_id" id="seller_id"></select>
                                    </div>
                                    @else
                                    <input type="hidden" name="seller_id" id="seller_id" value={{Auth::user()->seller_id}}>
                                    @endif
                            </div>
                         


                            <div class="col-sm-6 text-end">
                                {{-- <div>
                                    <a href="{{url('/add_product')}}" class="btn btn-success" ><i
                                            class="ri-add-line align-bottom me-1"></i> Add Product</a>
                                </div> --}}
                            </div>
                           
                        </div>
                    </div>

                    {{-- <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#productnav-all"
                                            role="tab">
                                            All <span class="badge badge-soft-danger align-middle rounded-pill ms-1">12</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#productnav-published"
                                            role="tab">
                                            Published <span class="badge badge-soft-danger align-middle rounded-pill ms-1">5</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#productnav-draft"
                                            role="tab">
                                            Draft
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-auto">
                                <div id="selection-element">
                                    <div class="my-n1 d-flex align-items-center text-muted">
                                        Select <div id="select-content" class="text-body fw-semibold px-1"></div> Result <button type="button" class="btn btn-link link-danger p-0 ms-3" data-bs-toggle="modal" data-bs-target="#removeItemModal">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- end card header -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    {{-- <div class="card-header">
                                        <h5 class="card-title mb-0">Ajax Datatables</h5>
                                    </div> --}}
                                    <div class="card-body">
                                        <table id="order_list" class="display table table-bordered dt-responsive" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Table. No</th>
                                                    {{-- <th>Customer Email</th> --}}
                                                    <th>Payment Method</th>
                                                    <th>Total Bill</th>
                                                    <th>Bill Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </div>

                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->


    <!-- removeItemModal -->
    <div id="removeItemModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you Sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Product ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger " id="delete-product">Yes, Delete It!</button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('script')
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- <script src="{{ URL::asset('assets/js/pages/select2.init.js') }}"></script> --}}


<script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>

<script>
    $(document).ready(function(){
        seller_list();
    $(".seller_list").select2({
})
     var product_table =$('#order_list').DataTable({
        proccessing: true,
        serverSide: true,
        searching: true,
      //  bFilter: true,
        ajax: {
            url: base_url+"list_billorder",
            type: "POST",
            data:function(d) {
            d.seller_id=$('[name=seller_id]').val();
        },
            },
        columns: [
            { data: 'table_name'},
            // { data: 'email' },
            { data: 'payment_type'},
            { data: 'total_payment'},
            { data: 'seller_status',render: function (data, type, row, meta) {
                var status='<span class="badge bg-warning">Warning</span>';
                if(data==1)
                {
                    status= '<span class="badge bg-success">Approve</span>';
                }
                else if(data==2)
                {
                    status= '<span class="badge bg-danger">Reject</span>';
                }
                return status;
                } },
            { data: 'id',render:function(data,type,row){ 
                // return 'Action';
                return `<div class="dropdown">
						<button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="ri-more-fill"></i>
						</button>
						<ul class="dropdown-menu dropdown-menu-end">
						
						<li><a class="dropdown-item edit-list" data-edit-id='${data}' href="{{url('/orders_details/${data}')}}"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
						<li class="dropdown-divider"></li>
						
						</ul>
						</div>`
            } 
             },

           //<li><a class="dropdown-item remove-list" href="#" data-id='${data}' onclick="opendeletmodel(${data})" ><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li>
        ]
    });

    // $('.seller_list').change(function () {
    //     console.log($('[name=seller_id]').val())
    //     product_table.ajax.reload();
    //   })
    
    });

    function opendeletmodel(id)
    {
        console.log(id)
        $('#removeItemModal').modal('show');
          $("#delete-product").replaceWith('<a href="#" class="btn btn-danger m-2" id="delete-product" onclick="deleteProduct('+id+')">Yes, Delete it</a>');
    }

    function deleteProduct(id)
      {
          $('#removeItemModal').modal('hide');
        $.ajax({
                type: "POST",
                url: base_url+"delete_product",
                data: {product_id:id},
                success: function(result) {
                    console.log("ajax data=", result)
                    if(result.success==true)
                    {
                        $('#order_list').DataTable().ajax.reload();
                    }      
                    toast_success(result.message)
                },
                error: function(error) {
                    console.log(error)
                    toast_error(error.responseJSON.message)
                 }
                });
    
      }

     


    </script>
@endsection

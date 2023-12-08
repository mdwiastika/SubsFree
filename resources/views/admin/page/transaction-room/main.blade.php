@extends('admin.layout.app')
@section('content')
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-12">
               <div class="judul">Data {{ $title }}</div>
               <div class="anak-judul">Manajemen Data {{ $title }}</div>
               @if (Auth::user()->level_user == 'Super Admin' || Auth::user()->level_user == 'Admin')
                  <button type="button" class="btn btn-sm btn-info" onclick="add('0')" id="btn-add">
                     <span class="fas fa-plus"></span>&nbsp Data {{ $title }}
                  </button>
               @endif
            </div>
         </div>
      </div>
   </div>

   <section class="content">
      <div class="container-fluid">
         <div class="card main-layer">
            <div class="card-body">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-inline pull-right panelSearch p-10 m-b-0 mb-3">
                  <div class="col-md-7 col-sm-7 col-xs-12 m-b-0 "></div>
                  <div class="col-md-2 col-sm-2 col-xs-12 m-b-0 ">
                     <div class="form-group">
                        <div class="form-line">
                           <select class="input-sm form-control option-search select-custom w-100" id="search-option"></select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-12 m-b-0 ">
                     <div class="form-group">
                        <div class="form-line">
                           <input type="text" class="input-sm form-control" placeholder="Search" id="search">
                        </div>
                     </div>
                  </div>
               </div>
               <div class='clearfix'></div>
               <div class="col-md-12 p-0 m-b-0">
                  <!-- Datagrid -->
                  <div class="table-responsive">
                     <table class="table table-striped b-t b-light" id="datagrid"></table>
                  </div>
                  <div class='clearfix'></div>

                  <footer class="panel-footer">
                     <div class="row">
                        <!-- Page Option -->
                        <div class="col-sm-1 hidden-xs">
                           <select class="input-sm form-control show-tick input-s-sm inline v-middle option-page" id="option"></select>
                        </div>
                        <!-- Page Info -->
                        <div class="col-sm-6 text-center">
                           <small class="text-muted inline m-t-sm m-b-sm" style="padding-left:20em" id="info"></small>
                        </div>
                        <!-- Paging -->
                        <div class="col-sm-5 text-right text-center-xs">
                           <ul class="pagination pagination-sm m-t-0 m-b-0 float-right" id="paging"></ul>
                        </div>
                     </div>
                  </footer>
               </div>
               <div class="clearfix"></div>
            </div>
         </div>
      </div>
      <div class="col-12 other-page"></div>
      <div class="col-12 modal-dialog"></div>
   </section>
@endsection

@section('js')
   <script type="text/javascript">
      var datagrid = $("#datagrid").datagrid({
         url: "{!! route('transactionRoomDatagrid') !!}",
         primaryField: 'id_transaction_room',
         rowNumber: true,
         rowCheck: false,
         searchInputElement: '#search',
         searchFieldElement: '#search-option',
         pagingElement: '#paging',
         optionPagingElement: '#option',
         pageInfoElement: '#info',
         columns: [{
               field: 'name_room',
               title: 'Name Room',
               editable: false,
               sortable: false,
               width: 200,
               align: 'left',
               search: false
            },
            {
               field: 'name_user',
               title: 'Name User',
               editable: false,
               sortable: false,
               width: 200,
               align: 'left',
               search: false
            },
            {
               field: 'start_date',
               title: 'Start Date',
               editable: false,
               sortable: true,
               width: 200,
               align: 'left',
               search: true
            },
            {
               field: 'end_date',
               title: 'End Date',
               editable: false,
               sortable: true,
               width: 200,
               align: 'left',
               search: true
            },
            {
               field: 'menu',
               title: 'Action',
               sortable: false,
               width: 250,
               align: 'center',
               search: false,
               rowStyler: function(rowData, rowIndex) {
                  return menu(rowData, rowIndex);
               }
            }
         ]
      });

      $(document).ready(function() {
         datagrid.run();
      });

      function add(rowIndex) {
         $('.main-layer').hide();
         $.post("{{ route('transactionRoomCreate') }}", {
            id: rowIndex
         }).done(function(data) {
            if (data.status == 'success') {
               $('.other-page').html(data.content).fadeIn();
            } else {
               $('.main-layer').show();
            }
         });
      }

      function detail(rowIndex) {
         $('.main-layer').hide();
         var id = datagrid.getRowData(rowIndex).id_transaction_room;
         $.post("{!! route('transactionRoomCreate') !!}", {
            id: id,
            show: 'ada',
         }).done(function(data) {
            if (data.status == 'success') {
               $('.other-page').html(data.content).fadeIn();
            } else {
               $('.main-layer').show();
            }
         });
      }

      function deleted(rowIndex) {
         var rowData = datagrid.getRowData(rowIndex);
         swal({
            title: "Are You Sure You Will Delete This Data ?",
            text: "Data Will be Deleted and Cannot be Restored !",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes, Delete Data!',
         }).then((result) => {
            if (result.value) {
               $.post("{{ route('transactionRoomDestroy') }}", {
                  id: rowData.id_transaction_room
               }).done(function(data) {
                  if (data.status == 'success') {
                     swal('Success', data.message, "success");
                  } else {
                     swal('Sorry!', data.message, "warning");
                  }
                  datagrid.reload();
               }).fail(function() {
                  swal('', "Data Has Been Deleted!", "error");
               });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
               Swal('Batal', 'Data Has Been Deleted!', 'error')
               datagrid.reload();
            }
         });
      }

      function menu(rowData, rowIndex) {
         var tag = '';
         tag += '<a href="javascript:void(0);" onclick="detail(' + rowIndex +
            ')" class="btn btn-warning btn-sm mr-1 mb-1" id="btn-detail"><i class="fa fa-eye"></i></a>';
         if ("{{ auth()->user()->level_user != 'Partner' }}") {
            tag += '<a href="javascript:void(0)" onclick="add(\'' + rowData.id_transaction_room +
               '\')" class="btn btn-primary btn-sm mr-1 mb-1" id="btn-edit"> <i class="fa fa-edit"></i></a>';
            tag += '<a href="javascript:void(0);" onclick="deleted(' + rowIndex +
               ')" class="btn btn-danger btn-sm mb-1" id="btn-delete"><i class="fa fa-trash"></i></a>';
         }
         return tag;
      }
   </script>
@endsection

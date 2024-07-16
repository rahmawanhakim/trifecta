@extends('Pengguna.template-user')
@section('add-request-beverage')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item {{ $title == 'Dashboard User' ? 'active' : '' }}">
                    <a href="{{ url('dashboard-user') }}">Dashboard</a>
                </li>
                <li
                    class="breadcrumb-item {{ $title == 'Request Beverage' ? 'active' : '' || $title == 'History Beverage' }}">
                    <a href="{{ url('customer-user') }}">Request</a>
                </li>
                <li class="breadcrumb-item {{ $title == 'Add Request Beverage' ? 'active' : '' }}">
                    <a href="{{ url('customer-user/add-request') }}">Add Request Beverage</a>
                </li>
            </ol>
        </nav>
        {{-- <form action="{{ route('add-request') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-5">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="alert alert-danger alert-dismissible" role="alert" id="alert_kosong"
                                style="display: none">
                                Belum mengisi inputan!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                            <input type="datetime-local" value="{{ date('Y-m-d H:i') }}" id="datenow"
                                style="display: none">
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label">Request Date</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="datetime-local" name="request_date"
                                        id="request_date" />
                                    <div id="date_alert" class="form-text" style="color: maroon;">Please
                                        select date!</div>
                                </div>
                            </div>
                            <input type="hidden" id="item_name" value="">
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label">Select Item</label>
                                <div class="col-md-8">
                                    <select class="form-select select_item" id="beverage_list" style="width: 100%">
                                        <option value=''>Select item</option>
                                        @foreach ($beverage as $bv)
                                            <option value="{{ $bv->id_barang }}">
                                                <img src="{{ asset('gambar_barang/' . $bv->gambar_barang) }}"
                                                    alt="">
                                                {{ $bv->nama_barang }} -{{ $bv->deskripsi_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div id="item_alert" class="form-text" style="color: maroon;">Please
                                        select item!</div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label">Quantity</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="quantity"
                                        placeholder="Input Quantity" />
                                    <div id="quantity_alert" class="form-text" style="color: maroon;">Please
                                        input quantity!
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label">Price / Item</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="price_item" readonly />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label">Total</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="total_nominal" readonly />
                                </div>
                            </div>
                            <div class="card-footer">
                                <a class="btn btn-primary" id="add_item" style="color: white">
                                    <span class="fas fa-plus"></span>Add</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2 text-center">No</div>
                                <div class="col-sm-2 text-center">Item</div>
                                <div class="col-sm-2 text-center">Quantity</div>
                                <div class="col-sm-2 text-center">Price</div>
                                <div class="col-sm-2 text-center">Total</div>
                                <div class="col-sm-2 text-center">Action</div>
                            </div>
                            <hr>
                            <div id="place_item">

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form> --}}

        <div class="row">
            @foreach ($beverage as $bv)
                <?php
                $price = DB::table('tb_harga_barang')
                    ->where('id_barang', $bv->id_barang)
                    ->orderBy('tanggal_harga_barang_ditambah', 'DESC')
                    ->first();
                ?>
                <div class="col-sm-2 mt-2 mb-2">
                    <button
                        style="border: none; text-decoration: none; display: inline-block; background-color: #ffffff; border-radius: 0.5rem;"
                        class="btn btnBeverage" value="{{ $bv->id_barang }}">
                        <img src="{{ asset('gambar_barang/' . $bv->gambar_barang) }}" width="160" height="160">
                        <h6 class="card-title mt-2">{{ $bv->nama_barang }}</h6>
                        <p class="card-text">
                            Rp {{ number_format(ceil($price->harga_barang), 0, ',', '.') }}
                        </p>
                        <input type="hidden" id="harga_barang-{{ $bv->id_barang }}"
                            value="{{ $price->harga_barang }}">
                    </button>
                </div>
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="detailBeverage" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btnClose btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img id="beverage-image" width="300" height="300">
                        </div>
                        <div class="col-md-6">
                            
                            <form method="POST" action="{{ route('add_beverage_request') }}" id="form_add_beverage"
                                enctype="multipart/form-data">
                                <div class="mt-4 mb-3">
                                    @csrf
                                    <h5 id="judul_barang" class="text-uppercase"></h5>
                                    <div class="price d-flex flex-row align-items-center"> <span id="price"
                                            class="act-price"></span>
                                        <div class="ml-2">
                                        </div>
                                    </div>
                                </div>
                                <p id="description" style="width: 350px;"></p>
                                <div class="mt-2">
                                    <div class="col-md-6 col-lg-6 col-xl-5 d-flex">
                                        <input type="hidden" id="id_barang" name="id_barang">
                                        <input type="hidden" id="harga_barang" name="harga_barang">

                                        <input type="hidden" name="type_button" id="type_button">
                                        <button type="button" class="btn btn-link px-2" onclick="getNominalDown()">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input id="total_barang" min="1" name="total_barang" value="0"
                                            type="number" class="form-control text-center form-control-sm"
                                            onkeyup="getNominal()" />
                                        <button type="button" class="btn btn-link px-2" onclick="getNominalUp()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="cart mt-4 align-items-center">
                                    <button type="button" class="btnAddToChart btn btn-danger text-uppercase mr-2 px-4">Add
                                        to
                                        cart</button>
                                    <button type="button" class="btnBuyNow btn btn-primary btn-rounded">Buy
                                        Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function getNominal() {
            var quantity = $('#total_barang').val();
            console.log(quantity)
            var beverage_id = $('#id_barang').val();
            var price = $('#harga_barang-' + beverage_id).val();
            $('#harga_barang').val(quantity * response.beverage.harga_barang)

        }

        function getNominalUp() {
            var quantity = $('#total_barang').val();
            var beverage_id = $('#id_barang').val();
            var price = $('#harga_barang-' + beverage_id).val();
            var newQty = parseInt(quantity) + 1;
            $('#total_barang').val(newQty)
            $('#harga_barang').val(newQty * price)
        }


        $(document).ready(function() {
            $(document).on('click', '.btnBeverage', function() {
                var beverage_id = $(this).val();
                // var quantity = $('#quantity').val();
                // console.log(quantity);

                $('#detailBeverage').modal('show');

                $.ajax({
                    type: 'GET',
                    url: "{{ url('item_beverage_request') }}/" + beverage_id,
                    success: function(response) {
                        document.getElementById("judul_barang").textContent = (response
                            .beverage.nama_barang);
                        document.getElementById("price").textContent = ('Rp ' + parseInt(
                            response.beverage.harga_barang).toLocaleString());
                        document.getElementById("description").textContent = (response.beverage
                            .deskripsi_barang);

                        // $('#gambar_barang_edit').val(response.beverage.gambar_barang)
                        $('#deskripsi_barang_edit').val(response.beverage
                            .deskripsi_barang)
                        $('#id_barang').val(response.beverage.id_barang)
                        $('#total_barang').val(0)
                        var get_file = '{{ asset('gambar_barang') }}/';
                        document.getElementById("beverage-image").src = get_file + response
                            .beverage.gambar_barang;

                        getNominalUp();
                        console.log(response);
                    }
                })
            })

            $(document).on('click', '.btnAddToChart', function() {
                $('#type_button').val('1');
                $('#form_add_beverage').submit();
            })

            $(document).on('click', '.btnBuyNow', function() {
                $('#type_button').val('2');
                $('#form_add_beverage').submit();

            })
        });

        function getNominalDown() {
            var quantity = $('#total_barang').val();
            var beverage_id = $('#id_barang').val();
            var price = $('#harga_barang-' + beverage_id).val();
            var newQty = parseInt(quantity) - 1;

            alert(newQty);
            if (quantity != 1) {

                $('#total_barang').val(newQty)
                $('#harga_barang').val(newQty * price)
            }

        }

        $(document).ready(function() {
            $(document).on('click', '.showBeverage', function() {
                var beverage_id = $(this).val();
                $('#detailBeverage').modal('show')

            })
        });

        $(document).ready(function() {
            $('.select_item').select2();

            $("#date_alert").css('display', 'none');
            $("#quantity_alert").css('display', 'none');
            $("#item_alert").css('display', 'none');
        });

        $('#quantity').on('change', function() {
            //GET BEVERAGE TOTAL
            var id_bev = $("#beverage_list").val();
            if (id_bev == '') {
                $("#item_alert").css('display', '')
                document.getElementById("quantity").value = '';
            } else {
                var quantity = $("#quantity").val();
                var price_per_id = $("#price_item").val();
                convert1 = price_per_id.replace("Rp.", " ");
                convert2 = convert1.replace(",", "");
                total_price = (convert2) * quantity;
                var output = parseInt(total_price).toLocaleString();
                document.getElementById("total_nominal").value = 'Rp. ' + output;
            }
        });

        $('#beverage_list').on('change', function() {
            $('#alert_kosong').hide();
            var id_bev = $(this).val();
            var req_date = $("#request_date").val();
            if (req_date == '') {
                $("#date_alert").css('display', '');
                $("#request_date").removeClass('form-control');
                $("#request_date").addClass('border-red');
                document.getElementById("beverage_list").value = '';
            } else {
                var id_bev = $("#beverage_list").val();
                $.ajax({
                    type: "POST",
                    url: "{{ url('get-bev-price') }}",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'req_date': req_date,
                        'id_bev': id_bev,
                    },
                    success: function(data) {
                        $.each(data, function(index, element) {
                            var price_per_item = parseInt(element.harga_barang)
                                .toLocaleString();
                            document.getElementById("price_item").value = 'Rp. ' +
                                price_per_item;
                            document.getElementById("item_name").value = element.nama_barang;
                        });
                    }
                });
            }
        });



        var no = 0 + 1;
        $('#add_item').on('click', function() {
            var id_bev = $("#beverage_list").val();
            var item_name = $('#item_name').val();
            var qtt = $("#quantity").val();
            var price = $("#price_item").val();
            var total = $("#total_nominal").val();
            if (id_bev == '' || qtt == '' || total == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill all fields!',
                })
            } else {
                var item = "<div class='row' id='item-" + no + "'>" +
                    "<input type='hidden' name='id_barang[]' value='" + id_bev + "'>" +
                    "<div class='col-sm-2 mt-2 text-center'>Item " + no + "</div>" +
                    "<div class='col-sm-2 mt-2 text-center'><input class='form-control2' value='" + item_name +
                    "' readonly></div>" +
                    "<div class='col-sm-2 mt-2 text-center'><input class='form-control2' name='beverage_quantity[]' value='" +
                    qtt + "' readonly></div>" +
                    "<div class='col-sm-2 mt-2 text-center'><input class='form-control2' value='" + price +
                    "' readonly></div>" +
                    "<div class='col-sm-2 mt-2 text-center'><input class='form-control2' name='harga_barang[]' value='" +
                    total + "' readonly></div>" +
                    "<div class='col-sm-2 mt-2 text-center'><a onclick='remove(" + no +
                    ")' class='btn btn-sm rounded-pill btn-icon btn-danger'>" +
                    "<span class='fas fa-minus' style='color:white'></span></a></div> </div"
                $("#place_item").append(item);
                console.log(no);
                no++;
            }
            document.getElementById("price_item").value = '';
            document.getElementById("total_nominal").value = '';
            document.getElementById("quantity").value = '';
            document.getElementById("beverage_list").value = '';
        });

        function remove(p) {
            $("#item-" + p).remove();
        }

        // if (\Session::has('coba')){
        // $('#shopingcart').modal('show');
        // }
    </script>

    <script>
        @if (\Session::has('success'))
            var msg = "{{ Session::get('success') }}"
            Swal.fire(
                'Success',
                msg,
                'success'
            )
            @php \Session::forget('success') @endphp
            @php \Session::forget('error') @endphp
            @php \Session::forget('info') @endphp
        @endif
        @if (\Session::has('error'))
            var msg = "{{ Session::get('error') }}"
            Swal.fire(
                'Whoops',
                msg,
                'error'
            )
            @php \Session::forget('success') @endphp
            @php \Session::forget('error') @endphp
            @php \Session::forget('info') @endphp
        @endif

        @if (\Session::has('coba'))
            $(document).ready(function() {

                $('#shopingcart').modal('show');

            });
        @endif
    </script>
@stop
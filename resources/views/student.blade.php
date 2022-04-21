<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="{{URL::asset('/assets/css/bootstrap.min.css')}}" type="text/css" media="all">
<script type="text/javascript" src="{{URL::asset('/assets/js/jquery-3.5.1.min.js')}}"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
    .hidden {
        display: none;
    }

    /* Font ROBOTO */
    .roboto {
        font-family: 'Roboto', sans-serif !important;
    }

    /* custom background for panel  */
    .container {
        padding-top: 50px !important;
        background-color: #f5f5f5 !important;
    }

    /* custom background header panel */
    .custom-header-panel {
    / / background-color: #004b8e !important;
        border-color: #004b8e !important;
        color: white;
    }

    .no-margin-form-group {
        margin: 0 !important;
    }

    .requerido {
        color: red;
    }

    .btn-orange-md {
        background: #FF791F !important;
        border-bottom: 3px solid #ae4d13 !important;
        color: white;
    }

    .btn-orange-md:hover {
        background: #d86016 !important;
        color: white !important;
    }
</style>
<div class="container">
    <div class="panel">
        <div class="btn btn-sm btn-primary" onclick="add_student()"><i class="fa fa-plus"></i>Add Student</div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Gender</th>
                <th scope="col">Email</th>
                <th scope="col">Mobile</th>
                <th scope="col">Class</th>
                <th scope="col">Year</th>
                <th scope="col">Address</th>
                <th scope="col">Photo</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            ?>
            @foreach($all_student_info as $v_student_info)
            <tr>
                <th scope="row">{{$i++}}</th>
                <td>{{$v_student_info->name}}</td>
                <td>{{$v_student_info->gender}}</td>
                <td>{{$v_student_info->email}}</td>
                <td>{{$v_student_info->mobile}}</td>
                <td>{{$v_student_info->class}}</td>
                <td>{{$v_student_info->education_year}}</td>
                <td>{{$v_student_info->address}}</td>
                <td>{{$v_student_info->photo}}</td>
                <td>
                    @if ($v_student_info->status == 1)
                        <a  href="{{URL::to('/unpublish/')}}{{'/'.$v_student_info->id}}">
                        <span class='btn purple tooltips active' data-original-title='Publish'>
                            <i class='fa fa-check'></i>
                        </span>
                        </a>

                    @endif
                    @if ($v_student_info->status == 0)
                        <a  href="{{URL::to('/publish/')}}{{'/'.$v_student_info->id}}">
                            <span class='btn purple tooltips active' data-original-title='Unpublish'>  <i class='fa fa-times'></i> </span>
                        </a>

                    @endif

                    <a class="edit btn purple tooltips active center" data-original-title='Edit' onclick="edit_category({{$v_student_info->id}});" href="javascript:void(0)">
                        <i class='fa fa-pencil'></i>
                    </a>
                    <a class="delete btn purple tooltips active center center" data-original-title='Delete' href="{{URL::to('/delete/')}}{{'/'.$v_student_info->id}}" title="Delete" onclick="return check_delete()">
                        <i class='fa fa-trash-o'></i>
                    </a>
                </td>

            </tr>
            @endForeach
            </tbody>
        </table>

    </div>
</div>
<!-- Tab panes -->
<!-- Modal -->
<div class="modal fade" id="student" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="form" class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">

                    @csrf
                    <div class="form-group row">

                        <div class="col-md-12">
                            <label for="ex_head" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>
                            <input type="hidden" class="form-control id" name="id" value="" >
                            <input id="m_url" type="text" class="form-control name" name="name" value="" required autocomplete="name">

                        </div>

                        <div class="col-md-12">
                            <label for="ex_head" class="col-md-3 col-form-label text-md-right">{{ __('Gender') }}</label>
                            <select class="form-control" name="gender">
                                <option value="male">male</option>
                                <option value="female">female</option>
                                <option value="other">other</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="ex_head" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>
                            <input id="m_url" type="email" class="form-control email" name="email" value="" required autocomplete="email">

                        </div>
                        <div class="col-md-12">
                            <label for="ex_head" class="col-md-3 col-form-label text-md-right">{{ __('Mobile') }}</label>
                            <input id="m_url" type="text" class="form-control email" name="phone" value="" required autocomplete="phone">

                        </div>
                        <div class="col-md-12">
                            <label for="ex_head" class="col-md-3 col-form-label text-md-right">{{ __('Class') }}</label>
                            <input id="m_url" type="text" class="form-control clss" name="class" value="" required autocomplete="phone">

                        </div>
                        <div class="col-md-12">
                            <label for="ex_head" class="col-md-3 col-form-label text-md-right">{{ __('Year') }}</label>
                            <input id="m_url" type="text" class="form-control year" name="year" value="" required autocomplete="year">

                        </div>
                        <div class="col-md-12">
                            <label for="ex_head" class="col-md-3 col-form-label text-md-right">{{ __('Address') }}</label>
                           <textarea name="address" class="form-control address"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="ex_head" class="col-md-3 col-form-label text-md-right">{{ __('Photo') }}</label>
                            <input id="m_url" type="text" class="form-control photo" name="file" value="" required autocomplete="year">

                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-9 offset-md-4">
                            <button type="submit" class="btn btn-primary pull-right upbtn">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function add_student()
    {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#student').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Student'); // Set Title to Bootstrap modal title
        if ($('.modal-title').text('Add Student')) {
            $('.btnsave').val('Save');
        }
    }

    function getRandomInteger(min, max) {
        return Math.floor(Math.random() * (max - min)) + min;
    }

    $('.default').on('click', function () {
        let amount = getRandomInteger(1, 15);
        $('.amt').val(amount);
        $('.cus_name').val('Abu tayeb md fahim');
        $('.cus_phone').val('01717302935');
        $('.cus_city').val('Dhaka');
        $('.cus_address').val('Gulshan 1,Dhaka 1212');
        $('.email').val('fahim@shurjopay.com.bd');
    });
    $('.sub').click(function () {
        let name = $('.name').val();
        let id = $('.id').val();
        let gender = $('.gender').val();
        let email = $('.email').val();
        let clss = $('.class').val();
        let year = $('.year').val();
        let address = $('.address').val();
        let photo = $('.photo').val();

        let settings = {
            "url": "{{url('save-student-info')}}",
            "method": "POST",
            "timeout": 0,
            //    "dataType": "JSON",

            "data": {
                "id": id,
                "name": name,
                "gender": gender,
                "email": email,
                "phone": phone,
                "class": clss,
                "education_year": year,
                "address": address,
                "photo": photo
            }
        };

        $.ajax(settings).done(function (response) {

            if (response.checkout_url) {
                window.location.href = response.checkout_url;
            } else {
                let obj = JSON.parse(response);
                //        alert(obj.order_id);
                if (typeof (obj.order_id) != 'undefined') {
                    $('.order_error').text(obj.order_id);
                } else {
                    document.getElementById('order_error').className += ' hidden';
                }
                if (typeof (obj.amount) != 'undefined') {
                    $('.amount_error').text(obj.amount);
                } else {
                    document.getElementById('amount_error').className += ' hidden';
                }
                if (typeof (obj.customer_name) != 'undefined') {
                    $('.customer_name_error').text(obj.customer_name);
                } else {
                    document.getElementById('customer_name_error').className += ' hidden';
                }
                if (typeof (obj.customer_phone) != 'undefined') {
                    $('.customer_phone_error').text(obj.customer_phone);
                } else {
                    document.getElementById('customer_phone_error').className += ' hidden';
                }

                if (typeof (obj.customer_city) != 'undefined') {
                    $('.customer_city_error').text(obj.customer_city);
                } else {
                    document.getElementById('customer_city_error').className += ' hidden';
                }
                if (typeof (obj.customer_address) != 'undefined') {
                    $('.customer_add_error').text(obj.customer_address);
                } else {
                    document.getElementById('customer_add_error').className += ' hidden';
                }
                if (typeof (obj.currency) != 'undefined') {
                    $('.curency_add_error').text(obj.currency);
                } else {
                    document.getElementById('curency_add_error').className += ' hidden';
                }


            }
            //                $("#main_body").html(response);

            //        let url = response;
            //
        });
    });
</script>

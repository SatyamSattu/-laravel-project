@extends('layouts.master')
@section('content')

  <section class=form-login>
    <div class="container">
        <div class="row ">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                          <h4 class="text-center">Reset Password</h4>
                    </div>
                    <div class="card-body">
                        <form id="reset_passsword_form">
                            @csrf
                            <input name="reset_token" type="hidden"
                            value="{{app('request')->input('token')}}">

                           
                            
                            <div class="form-group">
                                <label for="r_password">Password</label>
                                <input type="password" id="r_password" name="r_password"
                                class="form-control" placeholder="Enter Password" value="" minlength="6">
                            </div>


                            <div class="form-group">
                                <label for="r_password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control"
                                id="r_password_confirmation" placeholder="Enter Confirm Password"
                                name="r_password_confirmation" minlength="6">
                            </div>


                          <button type="submit" class="btn btn-dark btn-block"  id="bt_reset_password" >Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection



@section('javascript')


<script>
  $(document).ready(function () {
            $('#bt_reset_password').on('click', function () {
             
                var form = $('#reset_passsword_form');
                $(form).validate({
                    rules: {
                        r_password: {
                            required: true,
                            minlength: 6
                        },
                        r_password_confirmation: {
                            required: true,
                            equalTo: "#r_password"
                        },
                    },
                    submitHandler: function (form) {
                        let data = $('#reset_passsword_form').serializeArray();
                        console.log(data);
                        $.ajax({
                            type: 'POST',
                            url: "{{route('user_reset_password')}}",
                            data: data,
                            success: function (data) {
                                if (data.status) {
                                $('#notifDiv').fadeIn();
                                $('#notifDiv').css('background', 'green');
                                $('#notifDiv').text('Email Updated Successfully');
                                setTimeout(() => {
                                    $('#notifDiv').fadeOut();
                                }, 3000);
                                window.location = "{{ route('login') }}";
                                } else {
                                $('#notifDiv').fadeIn();
                                $('#notifDiv').css('background', 'red');
                                $('#notifDiv').text('Invalid Token');
                                setTimeout(() => {
                                    $('#notifDiv').fadeOut();
                                }, 3000);
                                }
                            },
                            error: function (err) {
                                showCustomError('Something went Wrong!')
                            }
                        });
                    }
                });
            });
        });
     
</script>
@endsection



@extends('layouts.app')

@section('content')
<style>
    @import url("https://fonts.googleapis.com/css?family=Open+Sans");

    /* Styles */
    * {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: "Open Sans";
        font-size: 14px;
    }

    .container {
        width: 500px;
        margin: 25px auto;
    }

    form {
        padding: 20px;
        background: #2c3e50;
        color: #fff;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
    }

    form label,
    form input,
    form button {
        border: 0;
        margin-bottom: 3px;
        display: block;
        width: 100%;
    }

    form input {
        height: 25px;
        line-height: 25px;
        background: #fff;
        color: #000;
        padding: 0 6px;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }

    form button {
        height: 30px;
        line-height: 30px;
        background: #e67e22;
        color: #fff;
        margin-top: 10px;
        cursor: pointer;
    }

    form .error {
        color: #ff0000;
    }

</style>
<!--Section: Contact v.2-->
<section class="mb-4">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
        a matter of hours to help you.</p>

    <div class="row">

        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form">

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="firstname" name="firstname" class="form-control">
                            <label for="first-name" class="">First name</label>
                        </div>
                    </div>
                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="lastname" name="lastname" class="form-control">
                            <label for="last-name" class="">Last name</label>
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="email" name="email" class="form-control">
                            <label for="email" class="">Your email</label>
                        </div>
                    </div>
                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="phone" name="phone" class="form-control">
                            <label for="phone" class="">Phone</label>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">
                        <div class="md-form">
                            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                            <label for="message">Your message</label>
                        </div>

                    </div>
                </div>
                <!--Grid row-->

            </form>

            <div class="text-center text-md-left">
                <button type="submit" class="btn btn-primary submit">Send</button>
            </div>
            <div class="bg-success status"></div>
        </div>
        <!--Grid column-->
    </div>

</section>
<!--Section: Contact v.2-->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $('.submit').click(function(e) {
            e.preventDefault();
            $("#contact-form").submit()
        });
        $("#contact-form").validate({
            rules: {
                firstname: "required"
                , lastname: "required"
                , email: {
                    required: true
                    , email: true
                }
                , phone: {
                    required: true
                    , minlength: 10
                }
                , message: {
                    required: true
                }
            }
            , messages: {
                firstname: "Please enter your firstname"
                , lastname: "Please enter your lastname"
                , email: "Please enter a valid email address"
            },
            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                url: "{{route('contact.store')}}",
                type: "POST",
                data:$(form).serialize() ,
                beforeSend:function() {
                    $('.submit').prop('disabled',true)
                },
                success: function (data, textStatus, jqXHR) {
                    $('.submit').prop('disabled',false)
                    $("#contact-form")[0].reset();
                    $('.status').text(data.message);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('.submit').prop('disabled',false)
                    $('.status').text(jqXHR);
                }
                });
            }
        });


    
    });
</script>
@endsection

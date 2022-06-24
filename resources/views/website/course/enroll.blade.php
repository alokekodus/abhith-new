@extends('layout.website.website')

@section('title','Courses')
@section('head')
<style>
    .inputGroup {
    background-color: #fff;
    display: block;
    margin: 10px 0;
    position: relative;

    label {
      padding: 12px 30px;
      width: 100%;
      display: block;
      text-align: left;
      color: #3C454C;
      cursor: pointer;
      position: relative;
      z-index: 2;
      transition: color 200ms ease-in;
      overflow: hidden;

      &:before {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        content: '';
        background-color: #5562eb;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%) scale3d(1, 1, 1);
        transition: all 300ms cubic-bezier(0.4, 0.0, 0.2, 1);
        opacity: 0;
        z-index: -1;
      }

      &:after {
        width: 32px;
        height: 32px;
        content: '';
        border: 2px solid #D1D7DC;
        background-color: #fff;
        background-image: url("data:image/svg+xml,%3Csvg width='32' height='32' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.414 11L4 12.414l5.414 5.414L20.828 6.414 19.414 5l-10 10z' fill='%23fff' fill-rule='nonzero'/%3E%3C/svg%3E ");
        background-repeat: no-repeat;
        background-position: 2px 3px;
        border-radius: 50%;
        z-index: 2;
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        transition: all 200ms ease-in;
      }
    }

    input:checked ~ label {
      color: #fff;

      &:before {
        transform: translate(-50%, -50%) scale3d(56, 56, 1);
        opacity: 1;
      }

      &:after {
        background-color: #54E0C7;
        border-color: #54E0C7;
      }
    }

    input {
      width: 32px;
      height: 32px;
      order: 1;
      z-index: 2;
      position: absolute;
      right: 30px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      visibility: hidden;
    }
  }


// codepen formatting
.form {
  padding: 0 16px;
  max-width: 550px;
  margin: 50px auto;
  font-size: 18px;
  font-weight: 600;
  line-height: 36px;
}

body {
  background-color: #D1D7DC;
  font-family: 'Fira Sans', sans-serif;
}

*,
*::before,
*::after {
  box-sizing: inherit;
}

html {
  box-sizing: border-box;
}

code {
  background-color: #9AA3AC;
  padding: 0 8px;
}




    .icon-box {
        display: flex;
        align-items: center;
        padding: 20px;
        transition: 0.3s;
        border: 1px solid #d3d5d6;
    }

    .home-courses-enroll {
        margin: 129px 80px;
    }

    .divider {
        margin-left: 5px;
        margin-right: 5px;
        width: 1px;
        height: 100%;
        border-left: 1px solid gray;
    }

    @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap');

    // Formatting Styles
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Open Sans', sans-serif;
        font-size: 15px;
        line-height: 1.5;
        font-weight: 400;
        background: #f0f3f6;
        color: #3a3a3a;
    }

    hr {
        margin: 20px 0;
        border: none;
        border-bottom: 1px solid #d9d9d9;
    }

    label,
    input {
        cursor: pointer;
    }

    h2,
    h3,
    h4,
    h5 {
        font-weight: 600;
        line-height: 1.3;
        color: #1f2949;
    }

    h2 {
        font-size: 24px;
    }

    h3 {
        font-size: 18px;
    }

    h4 {
        font-size: 14px;
    }

    h5 {
        font-size: 12px;
        font-weight: 400;
    }

    img {
        max-width: 100%;
        display: block;
        vertical-align: middle;
    }

    .container {
        max-width: 99vw;
        margin: 15px auto;
        padding: 0 15px;
    }

    .top-text-wrapper {
        margin: 20px 0 30px 0;
    }

    .top-text-wrapper h4 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .top-text-wrapper code {
        font-size: 0.85em;
        background: linear-gradient(90deg, #fce3ec, #ffe8cc);
        color: #ff2200;
        padding: 0.1rem 0.3rem 0.2rem;
        border-radius: 0.2rem;
    }

    .tab-section-wrapper {
        padding: 30px 0;
    }

    .grid-wrapper {
        display: grid;
        grid-gap: 30px;
        place-items: center;
        place-content: center;
    }

    .grid-col-auto {
        // grid-template-columns: repeat(auto-fill, minmax(280px, 0.1fr));
        grid-auto-flow: column;
        grid-template-rows: auto;
    }

    /* ******************* Main Styeles : Radio Card */

    $primary-color: #3057d5;
    $transition: 200ms linear;

    label.radio-card {
        cursor: pointer;

        .card-content-wrapper {
            background: #fff;
            border-radius: 5px;
            max-width: 280px;
            min-height: 330px;
            padding: 15px;
            display: grid;
            box-shadow: 0 2px 4px 0 rgba(219, 215, 215, 0.04);
            transition: $transition;
        }

        .check-icon {
            width: 20px;
            height: 20px;
            display: inline-block;
            border: solid 2px #e3e3e3;
            border-radius: 50%;
            transition: $transition;
            position: relative;

            &:before {
                content: '';
                position: absolute;
                inset: 0;
                background-image: url("data:image/svg+xml,%3Csvg width='12' height='9' viewBox='0 0 12 9' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0.93552 4.58423C0.890286 4.53718 0.854262 4.48209 0.829309 4.42179C0.779553 4.28741 0.779553 4.13965 0.829309 4.00527C0.853759 3.94471 0.889842 3.88952 0.93552 3.84283L1.68941 3.12018C1.73378 3.06821 1.7893 3.02692 1.85185 2.99939C1.91206 2.97215 1.97736 2.95796 2.04345 2.95774C2.11507 2.95635 2.18613 2.97056 2.2517 2.99939C2.31652 3.02822 2.3752 3.06922 2.42456 3.12018L4.69872 5.39851L9.58026 0.516971C9.62828 0.466328 9.68554 0.42533 9.74895 0.396182C9.81468 0.367844 9.88563 0.353653 9.95721 0.354531C10.0244 0.354903 10.0907 0.369582 10.1517 0.397592C10.2128 0.425602 10.2672 0.466298 10.3112 0.516971L11.0651 1.25003C11.1108 1.29672 11.1469 1.35191 11.1713 1.41247C11.2211 1.54686 11.2211 1.69461 11.1713 1.82899C11.1464 1.88929 11.1104 1.94439 11.0651 1.99143L5.06525 7.96007C5.02054 8.0122 4.96514 8.0541 4.90281 8.08294C4.76944 8.13802 4.61967 8.13802 4.4863 8.08294C4.42397 8.0541 4.36857 8.0122 4.32386 7.96007L0.93552 4.58423Z' fill='white'/%3E%3C/svg%3E%0A");
                background-repeat: no-repeat;
                background-size: 12px;
                background-position: center center;
                transform: scale(1.6);
                transition: $transition;
                opacity: 0;
            }
        }

        input[type='radio'] {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;

            &:checked {
                +.card-content-wrapper {
                    box-shadow: 0 2px 4px 0 rgba(219, 215, 215, 0.5), 0 0 0 2px $primary-color;

                    .check-icon {
                        background: $primary-color;
                        border-color: $primary-color;
                        transform: scale(1.2);

                        &:before {
                            transform: scale(1);
                            opacity: 1;
                        }
                    }
                }
            }

            &:focus {
                +.card-content-wrapper {
                    .check-icon {
                        box-shadow: 0 0 0 4px rgba(48, 86, 213, 0.2);
                        border-color: #3056d5;
                    }
                }
            }
        }

        .card-content {
            img {
                margin-bottom: 10px;
            }

            h4 {
                font-size: 16px;
                letter-spacing: -0.24px;
                text-align: center;
                color: #1f2949;
                margin-bottom: 10px;
            }

            h5 {
                font-size: 14px;
                line-height: 1.4;
                text-align: center;
                color: #686d73;
            }
        }
    }
</style>
@endsection

@section('content')
<section class="subheader">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-inline cart-course-list1">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif

                </ul>
            </div>
        </div>
    </div>
</section>

<section class="home-courses-enroll">
    {{-- <div class="container-fluid">
        <div class="row">
            <div class="col-6">

                <div class="icon-box">
                    <i class="ri-anchor-line" style="color: #b2904f;"></i>
                    <h3><a href="">ALL SUBJECTS</a></h3>
                </div>

            </div>
            <div class="col-6">
                <div class="icon-box">
                    <i class="ri-anchor-line" style="color: #b2904f;"></i>
                    <h3><a href="">CUSTOM PACKAGE</a></h3>
                </div>
            </div>
        </div>
    </div> --}}
</section>

<section class="home-courses">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="grid-wrapper grid-col-auto">
                    <label for="radio-card-1" class="radio-card">
                        <input type="radio" name="radio-card" id="radio-card-1" checked />
                        <div class="card-content-wrapper">
                            <span class="check-icon"></span>
                            <div class="card-content">
                                <img src="https://image.freepik.com/free-vector/group-friends-giving-high-five_23-2148363170.jpg"
                                    alt="" />
                                <h4>Lorem ipsum dolor.</h4>
                                <h5>Lorem ipsum dolor sit amet, consectetur.</h5>
                            </div>
                        </div>
                    </label>
                    <!-- /.radio-card -->

                    <label for="radio-card-2" class="radio-card">
                        <input type="radio" name="radio-card" id="radio-card-2" />
                        <div class="card-content-wrapper">
                            <span class="check-icon"></span>
                            <div class="card-content">
                                <img src="https://image.freepik.com/free-vector/people-putting-puzzle-pieces-together_52683-28610.jpg"
                                    alt="" />
                                <h4>Lorem ipsum dolor.</h4>
                                <h5>Lorem ipsum dolor sit amet, consectetur.</h5>
                            </div>
                        </div>
                    </label>
                    <!-- /.radio-card -->
                </div>
            </div>
            <div class="col-6">
                @foreach($subjects as $key=>$subject)
                <div class="inputGroup">
                    <input id="option1" name="option1" type="checkbox" />
                    <label for="option1">{{$subject->subject_name}}</label>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>
@section('scripts')
<script>
    $(document).ready(function() {
      var courseType= $(".course_type").val();
        changeCourse(courseType);
     });
   function changeCourse(value){
        if(value==1){
            $("#message-for-custom-package").html(``);
            $("#full_course").prop("checked", true);
            $(".chapter_value").each(function(index) {
                $(this).prop("checked", true);
                $(this).prop("disabled", true);
         
           });
           checkedSubject();
        }else{
            var messageForCustomPackage=` <button type="button" class="btn btn-secondary btn-lg btn-block">Please Selete Subjects for custom your package</button>`;
            $("#message-for-custom-package").html(messageForCustomPackage);
            $(".chapter_value").each(function(index) {
                $(this).prop("checked", false);
                $(this).prop("disabled", false);
         
           });
           
           checkedSubject();
        }
   }
   function checkedSubject(){
    var totalAmount=0.00;
   
      $(".chapter_value").each(function(index) {
          if(this.checked==true){         
            totalAmount= parseFloat(totalAmount) + parseFloat($(this).attr('data-price'));
          }
         
      });
      var amount=`<i class="fa fa-inr" aria-hidden="true"></i> &nbsp;`;
      if(totalAmount==0){
        $("#add_cart").prop("disabled",true);
        $("#total-cart").html(``);
       
      }else{
          var totalCart=`<ul class="list-inline total-car-list p-6"><button type="submit" class="add-cart form-control" id="add_cart">Add to Cart</button></ul>`
        
        $("#add_cart").prop("disabled",false);
        $("#total-cart").html(totalCart);
      }
      $("#total_price").html(amount+totalAmount.toFixed(2));
   }
  
</script>



@endsection
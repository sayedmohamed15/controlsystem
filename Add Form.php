<!DOCTYPE html>
<!-- saved from url=(0052)https://getbootstrap.com/docs/4.1/examples/checkout/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/favicon.ico">

    <title>Checkout example for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/form-validation.css" rel="stylesheet">
  </head>

  <body class="bg-light">

    <div class="container">
      <div class="py-5 text-center">
        <h1>Add Trainer</h1>
        
      </div>

      <div class="row">
      
        <div class="col-md-12 order-md-1">
          <h4 class="mb-3">Billing address</h4>
          <form class="needs-validation" novalidate="" action="index.php" method="post">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" name="firstname"  class="form-control" id="firstName" placeholder="" value="" required="">
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" name="lastname"  class="form-control" id="lastName" placeholder="" value="" required="">
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>
         

               <div class="mb-3">
              <label for="exampleInputPassword1">Password</label>
               <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value="" required="">
              <div class="invalid-feedback">
                Valid Password is required.
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email <span class="text-muted">(Optional)</span></label>
              <input type="email" name="email" value="" class="form-control" id="email" placeholder="you@example.com">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="address">Address</label>
              <input type="text" name="address" value="" class="form-control" id="address" placeholder="1234 Main St" required="">
              <div class="invalid-feedback">
                Please enter a valid Address.
              </div>
            </div>




             <div class="mb-3">
              <label for="exampleFormControlTextarea1">Information <span class="text-muted">(Optional)</span></label>
              <input type="text" name="information" value="" class="form-control" id="exampleFormControlTextarea1" placeholder="info about trainer">
              <div class="invalid-feedback">
                Please enter a valid Information.
              </div>
            </div>

               <div class="mb-3">
              <label for="example-tel-input"  class="col-2 col-form-label">Telephone</label>
              <input class="form-control" name="telephone" type="tel" value="" id="example-tel-input" required="" >

              <div class="invalid-feedback">
                Please enter a valid phone Number.
              </div>
            </div>
            <div class="mb-3">
            <label  class="col-2 col-form-label">Role</label>
            <select class="custom-select custom-select-lg mb-3" name="role" required>
			  <option value = "">Select Role From This Select Menu</option>
			  <option value="Trainer">Trainer</option>
			  <option value="Player">Player</option>
			  <!-- <option value="3">Three</option> -->
			
			</select>
			     <div class="invalid-feedback">
                Please select a valid Role.
              </div>
			</div>

			    <div class="mb-3">
            <label  class="col-2 col-form-label">Gender</label>
            <select class="custom-select custom-select-lg mb-3" name="gender" required>
			  <option value="">Select Gender</option>
			  <option value="Male">Male</option>
			  <option value="Female">Female</option>
			</select>
			   <div class="invalid-feedback">
                Please select a valid Gender.
              </div>
			</div>



            <div class="row">

              <div class="col-md-4 mb-3">
                <label for="state">City</label>
                <select class="custom-select d-block w-100" id="state" name="city" required="">
                  <option value="">Choose...</option>
                  <option value="Cairo">Cairo</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid city.
                </div>
              </div>

            </div>

            <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Continue to checkout</button>
          </form>
        </div>
      </div>

      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">© 2017-2018 Company Name</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="https://getbootstrap.com/docs/4.1/examples/checkout/#">Privacy</a></li>
          <li class="list-inline-item"><a href="https://getbootstrap.com/docs/4.1/examples/checkout/#">Terms</a></li>
          <li class="list-inline-item"><a href="https://getbootstrap.com/docs/4.1/examples/checkout/#">Support</a></li>
        </ul>
      </footer>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./Checkout example for Bootstrap_files/jquery-3.3.1.slim.min.js.download" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="./Checkout example for Bootstrap_files/popper.min.js.download"></script>
    <script src="./Checkout example for Bootstrap_files/bootstrap.min.js.download"></script>
    <script src="./Checkout example for Bootstrap_files/holder.min.js.download"></script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  

</body></html>
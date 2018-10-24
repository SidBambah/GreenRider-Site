
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Create Account</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="registerForm">
                <div class="modal-body mx-3">
                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" required autofocus>
                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" required>
                    <input type="tel" name="phonenumber" id="phonenumber" class="form-control" placeholder="Phone Number" required>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    <input type="password" name="password2" id="password2" class="form-control" placeholder="Re-enter Password" required>
                    <div class="modal-footer d-flex justify-content-center"> 
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="register" id="registerButton">Register</button>
                    </div>
                </div>
            </form>
            <div class ="modal-footer text-center" id="registerResult">
            </div>
        </div>
    </div>
</div>
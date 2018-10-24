<?php include_once('forgotPass.php'); ?>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h2 class="modal-title w-100 font-weight-bold">Login</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="loginForm">
                <div class="modal-body col-md-12 panel panel-default panel-body">
                    <input type="email" id="loginEmail" class="form-control" placeholder="Email address" name="loginEmail" required autofocus>
                    <input type="password" id="loginPassword" class="form-control" placeholder="Password" name="loginPassword" required>
                    <div class="modal-footer d-flex justify-content-center">
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login" id="loginButton">Sign in</button>
                    </div>
                </div>
            </form>
            <div class = "modal-footer text-center" id="loginResult">
                <div class = "text-right" data-dismiss="modal" data-target="#loginModal">
                    Forgot Password? <a href="#" data-toggle="modal" data-target="#forgotPasswordModal"> Click Here </a>
                </div>
            </div> 
        </div>
    </div>
</div>
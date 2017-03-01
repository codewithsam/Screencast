<?php

echo '
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action="index.php" method="POST">
            <div class="modal-dialog modaler-dialog">
                <div class="modal-content modaler-content">
                    <div class="modal-header modaler-header">
                        <div class="modal-header-logo"></div>
                    </div>
                    <div class="modal-body modaler-body">
                        <div class="login-input">
                            <input type="text" class="modal-username" name="email" placeholder="E-mail">
                            <input type="password" class="modal-passkey" name="password" placeholder="Password">
                        </div>
                        <div class="modal-loginbtn">
                            <button class="btn btn-primary btn-block" type="submit" name="login">Log In</button>
                            <div class="row"><a href="#">Forgot your passoword?</a></div>
                        </div>
                        <div class="or-divide">
                            <div class="line left"></div>
                            <span>or</span>
                            <div class="line right"></div>
                        </div>
                        <div class="otherloginbtn">
                            <p>Login with social account</p>
                            <div class="otheraccount">
                                <ul class="clearfix">
                                    <li class="fblogin"><i class="fa fa-facebook"></i></li>
                                    <li class="gpluslogin"><i class="fa fa-google-plus"></i></li>
                                    <li class="twitterlogin"><i class="fa fa-twitter"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>



    <div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action="index.php" method="POST">
            <div class="modal-dialog modaler-dialog">
                <div class="modal-content modaler-content">
                    <div class="modal-header modaler-header">
                        <div class="modal-header-logo"></div>
                    </div>
                    <div class="modal-body modaler-body">
                        <div class="login-input">
                            <input type="text" name="username" class="modal-username" placeholder="Username">
                            <input type="text" name="email" class="modal-email" placeholder="E-Mail">
                            <input type="password" name="password" class="modal-passkey" placeholder="Password">
                            <input type="password" name="password_confirmation" class="modal-repass" placeholder="Confirm Password">
                        </div>
                        <div class="modal-loginbtn">
                            <button class="btn btn-primary btn-block" type="submit" name="signup">Signup</button>
                            <div class="row tandc"><p>By clicking Sign Up you agree to screencast\'s <a href="#">terms & conditions</a> and <a href="#">privacy policy</a>.</p></div>
                        </div>
                        <div class="or-divide">
                            <div class="line left"></div>
                            <span>or</span>
                            <div class="line right"></div>
                        </div>
                        <div class="otherloginbtn">
                            <p>Signup with social account</p>
                            <div class="otheraccount">
                                <ul class="clearfix">
                                    <li class="fblogin"><i class="fa fa-facebook"></i></li>
                                    <li class="gpluslogin"><i class="fa fa-google-plus"></i></li>
                                    <li class="twitterlogin"><i class="fa fa-twitter"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>';

?>
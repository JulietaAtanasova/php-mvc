<div class="col-md-8 col-md-offset-2">
    <div class="well bs-component">
        <form action="" method="POST" id="register-form" class="form-horizontal" >
            <fieldset>
                <legend>Register</legend>
                <div class="control-group">
                    <label for="inputUserName" class="col-lg-2 control-label">Username</label>
                    <div class="col-lg-10 controls">
                        <input class="form-control" id="inputUserName" required="" placeholder="User name" type="text" name="username">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="control-group">
                    <label for="inputPassword" class="col-lg-2 control-label" >Password</label>
                    <div class="col-lg-10 controls">
                        <input class="form-control" id="inputPassword" required="" placeholder="Password" type="password" name="password">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <input type="submit" name="register" value="Register">
                    </div>
                </div>
                <?php if($this->error): ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Error</h3>
                        </div>
                        <div class="panel-body">
                            <?= $this->error; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </fieldset>
        </form>
    </div>
</div>

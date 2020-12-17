<?php
$page = 'login';
include_once('./partials/head.php');
?>
<?php
include_once('./partials/navbar.php');
?>
<!-- PAGE CONTENT GOES HERE -->
<div class="container my-5 py-5" id="login-app">
    <div class="row mt-5">
        <div class="col-md-7 col-sm-12 mx-auto">
            <div :class="['alert', success ? 'alert-success' : 'alert-danger']" v-if="message" role="alert">
                {{ message }}
            </div>
            <div class="card">
                <div class="card-body py-5">
                    <h3 class="card-title text-indigo mb-4">Login Here</h3>
                    <form @submit.prevent="postLoginCredentials">
                        <div class="form-floating mb-3">
                            <input type="text" v-model="username" class="form-control" id="floatingInput" placeholder="jhone_doe">
                            <label for="floatingInput">Username</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" v-model="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-dark btn-lg">Login</button>
                            <a href="./register.php" class="btn ml-2 btn-lg btn-light text-indigo">Need an Account? Register Now</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- PAGE CONTENT GOES HERE -->
<?php
include_once('./partials/footer.php');
?>
<?php
include_once('./partials/scripts.php');
?>
<!-- Custom Scripts Goes Here -->
<script>
    const app = Vue.createApp({
        data: () => ({
            username: "",
            password: "",
            message: "",
            success: false
        }),
        methods: {
            async postLoginCredentials() {
                console.log(this.password);
                console.log(this.username);
                let formData = new FormData();
                formData.append('username', this.username);
                formData.append('password', this.password);
                let {
                    data
                } = await api.post('./apis/users/login.php', formData);
                this.message = data.message;
                this.success = data.success;
                if (data.success) {
                    setTimeout(() => {
                        window.location.replace('./dashboard.php');
                    }, 3000);
                }
            }
        }
    }).mount('#login-app');
</script>
<!-- Custom Scripts Goes Here -->
</body>

</html>
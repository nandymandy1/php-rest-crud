<?php
$page = 'register';
include_once('./partials/head.php');
?>
<?php
include_once('./partials/navbar.php');
?>
<!-- PAGE CONTENT GOES HERE -->
<div class="container my-5 py-5" id="register-app">

    <div class="row mt-5">
        <div class="col-md-7 col-sm-12 mx-auto">
            <div :class="['alert', success ? 'alert-success' : 'alert-danger']" v-if="message" role="alert">
                {{ message }}
            </div>
            <div class="card">
                <div class="card-body py-5">
                    <h3 class="card-title text-indigo mb-4">Register Here</h3>
                    <form @submit.prevent="registerUser">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" v-model="username" id="floatingUsername" placeholder="jhon_doe">
                            <label for="floatingInput">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" v-model="email" id="floatingEmail" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" v-model="password" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-dark btn-lg">Register</button>
                            <a href="./login.php" class="btn btn-lg btn-light text-indigo">Already have an Account? Login Now</a>
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
            username: '',
            password: '',
            email: '',
            message: '',
            success: false
        }),
        methods: {
            async registerUser() {
                const formData = new FormData();
                formData.append('email', this.email);
                formData.append('username', this.username);
                formData.append('password', this.password);
                let {
                    data
                } = await api.post('./apis/users/register.php', formData);
                this.message = data.message;
                this.success = data.success;
                if (data.success) {
                    setTimeout(() => {
                        window.location.replace('./login.php');
                    }, 3000);
                }
            }
        }
    }).mount('#register-app');
</script>
<!-- Custom Scripts Goes Here -->
</body>

</html>
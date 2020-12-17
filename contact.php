<?php
$page = 'contact';
include_once('./partials/head.php');
?>
<?php
include_once('./partials/navbar.php');
?>
<!-- PAGE CONTENT GOES HERE -->
<div class="container my-5 pt-3" id="contact-app">
    <div class="mt-5">
        <h1 class="text-center">Contact Us</h1>
    </div>
    <div :class="['alert', success ? 'alert-success' : 'alert-danger']" v-if="message" role="alert">
        {{ message }}
    </div>
    <div class="row py-5">
        <div class="col-md-6 col-sm-12">

            <div class="card h-100">
                <div class="card-body">
                    <h3 class="text-indigo card-title">Contact Us</h3>
                    <p>Get In Touch with us</p>
                    <form @submit.prevent="contactSubmit">
                        <div class="form-floating mb-3">
                            <input type="text" v-model="person.name" class="form-control" id="name" placeholder="Jhon Doe">
                            <label for="name">Your Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" v-model="person.contact" id="contact" placeholder="+91 405-3540">
                            <label for="contact">Your Contact Number</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="email" v-model="person.email" placeholder="name@example.com">
                            <label for="email">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="message" class="form-control" id="message" cols="30" rows="20" v-model="person.message" placeholder="Write your message here..." style="height: 150px"></textarea>
                            <label for="message">Message</label>
                        </div>
                        <div class="spinner-grow text-dark" role="status" v-if="loading">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <button class="btn btn-dark btn-lg" v-else>Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <img src="./assets/images/about-banner.png" alt="" class="img-fluid">
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
            person: {
                name: "",
                email: "",
                contact: "",
                message: ""
            },
            message: "",
            loading: false,
            success: false,
        }),
        methods: {
            async contactSubmit() {
                this.loading = true;
                let {
                    person
                } = this;
                let formData = new FormData();

                for (let i in person) {
                    formData.append(i, person[i]);
                }
                let {
                    data
                } = await api.post('./apis/contact/contact.php', formData);
                this.message = data.message;
                this.success = data.success;
                if (data.success) {
                    this.person = {
                        name: "",
                        email: "",
                        contact: "",
                        message: ""
                    }
                }
                this.loading = false;
                setTimeout(() => {
                    this.message = "";
                    this.success = false;
                }, 3000);
            }
        }
    }).mount('#contact-app')
</script>
<!-- Custom Scripts Goes Here -->
</body>

</html>
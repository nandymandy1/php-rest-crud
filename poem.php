<?php
$page = 'poem';
include_once('./partials/head.php');
?>
<?php
include_once('./partials/navbar.php');
?>
<!-- PAGE CONTENT GOES HERE -->
<section class="bg-grey py-5 mt-5 h-100" id="poem-app">
    <div class="container">
        <button class="btn btn-dark" @click="goBack">Back</button>
        <div class="row mt-5">
            <div class="col-md-12 col-sm-12 mb-3">
                <div class="card h-100">
                    <div class="card-body" v-if="poem">
                        <h3 class="card-title text-indigo">
                            {{ poem.title }}
                        </h3>
                        <div class="card-text">
                            {{ poem.content }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
            poem: null
        }),
        methods: {
            async getPoemById() {
                let id;
                let params = new URLSearchParams(window.location.search);
                for (const param of params) {
                    if (param[0] === 'id') {
                        id = param[1];
                    }
                }
                let {
                    data
                } = await api.get('./apis/poems/get-poem.php?id=' + id);
                this.poem = data;
            },
            goBack() {
                window.history.back();
            }
        },
        created() {
            this.getPoemById();
        }
    }).mount('#poem-app');
</script>
<!-- Custom Scripts Goes Here -->
</body>

</html>
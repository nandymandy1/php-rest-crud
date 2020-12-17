<?php
$page = 'poems';
include_once('./partials/head.php');
?>
<?php
include_once('./partials/navbar.php');
?>
<!-- PAGE CONTENT GOES HERE -->
<section class="bg-grey py-5 my-5" id="poems-app">
    <div class="container">
        <h1 class="text-center">Poems</h1>
        <div class="row mt-5">
            <div class="col-md-6 col-sm-12 mb-3" v-for="poem in poems" :key="poem.id">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title text-indigo">
                            {{ poem.title }}
                        </h3>
                        <div class="card-text">
                            {{ poem.content.substr(0, 150) }}...
                        </div>
                        <a :href="`./poem.php?id=${poem.id}`" class="btn btn-light mt-3">Read More</a>
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
            poems: []
        }),
        methods: {
            async getAllPoems() {
                let {
                    data
                } = await api.post('./apis/poems/get-poems.php');
                this.poems = data;
            },
        },
        created() {
            this.getAllPoems();
        }
    }).mount('#poems-app');
</script>
<!-- Custom Scripts Goes Here -->
</body>

</html>
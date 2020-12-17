<?php
$page = 'dashboard';
include_once('./partials/head.php');
if (!$_SESSION['auth']) {
    header("Location: login.php");
}
?>
<?php
include_once('./partials/navbar.php');
?>
<!-- PAGE CONTENT GOES HERE -->
<section class="bg-grey py-5 my-5" id="dashboard-app">
    <div class="container">
        <h1 class="text-center">Dashboard</h1>
        <div :class="['alert', success ? 'alert-success' : 'alert-danger']" v-if="message && !modalOpen" role="alert">
            {{ message }}
        </div>
        <button type="button" class="btn btn-primary" @click="modalOpen = true" data-bs-toggle="modal" data-bs-target="#poemModal">
            Add New Poem
        </button>
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
                        <button class="btn btn-danger mt-3" @click="deletePoem(poem.id)">Delete</button>
                        <button class="btn btn-info mt-3" @click="editPoem(poem)" data-bs-toggle="modal" data-bs-target="#poemModal">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" data-bs-backdrop="static" id="poemModal" tabindex="-1" aria-labelledby="poemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-indigo" id="poemModalLabel">
                        {{ !editMode ? 'New Poem' : 'Update Poem' }}
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form @submit.prevent>
                    <div class="modal-body">
                        <div :class="['alert', success ? 'alert-success' : 'alert-danger']" v-if="message && !modalOpen" role="alert">
                            {{ message }}
                        </div>
                        <div class="form-group">
                            <div class="form-floating mb-3">
                                <input type="text" v-model="title" class="form-control" name="title" id="title" placeholder="Poem Title">
                                <label for="title">Poem Title</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea name="poem" v-model="poem" class="form-control" id="poem" cols="30" rows="20" placeholder="Write your poem here..." style="height: 200px"></textarea>
                                <label for="poem">Poem</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="closeModal">Close</button>
                        <button type="submit" class="btn btn-primary" v-if="!editMode" @click="addNewPoem">Add Poem</button>
                        <button type="submit" class="btn btn-primary" v-else @click="updatePoem">Update Poem</button>
                    </div>
                </form>
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
            id: "",
            poem: "",
            title: "",
            poems: [],
            message: "",
            success: false,
            editMode: false,
            modalOpen: false,
        }),

        methods: {
            async addNewPoem() {
                let formData = new FormData();
                formData.append('title', this.title);
                formData.append('poem', this.poem);

                let {
                    data
                } = await api.post('./apis/poems/create-poem.php', formData);

                this.success = data.success;
                this.message = data.message;

                if (data.success) {
                    this.title = "";
                    this.poem = "";
                    const poemModal = document.querySelector('#poemModal');
                    const modal = bootstrap.Modal.getInstance(poemModal);
                    modal.hide();
                    this.getAllPoems();
                    this.modalOpen = false;
                }

                setTimeout(() => {
                    this.message = "";
                    this.success = false;
                }, 3000);
            },

            editPoem(poem) {
                this.title = poem.title;
                this.poem = poem.content;
                this.editMode = true;
                this.id = poem.id;
                this.modalOpen = true;
            },

            async updatePoem() {
                const formData = new FormData();
                formData.append('title', this.title);
                formData.append('poem', this.poem);

                let {
                    data
                } = await api.post('./apis/poems/update-poem.php?id=' + this.id, formData);

                this.success = data.success;
                this.message = data.message;

                if (data.success) {
                    this.title = "";
                    this.poem = "";
                    this.editMode = false;
                    this.id = "";
                    const poemModal = document.querySelector('#poemModal');
                    const modal = bootstrap.Modal.getInstance(poemModal);
                    modal.hide();
                    this.getAllPoems();
                    this.modalOpen = false;
                    this.poems = this.poems.map(poem => {
                        if (poem.id === this.id) {
                            return data.poem;
                        } else {
                            return poem;
                        }
                    });
                }

                setTimeout(() => {
                    this.message = "";
                    this.success = false;
                }, 3000);
            },

            async getAllPoems() {
                let {
                    data
                } = await api.post('./apis/poems/get-my-poems.php');
                this.poems = data.poems;
            },

            async deletePoem(id) {
                let {
                    data
                } = await api.get('./apis/poems/delete-poem.php?id=' + id);
                if (data.success) {
                    this.poems = this.poems.filter(poem => poem.id !== id);
                    this.success = data.success;
                    this.message = data.message;
                }
                setTimeout(() => {
                    this.message = "";
                    this.success = false;
                }, 3000);
            },

            async closeModal() {
                this.id = "";
                this.poem = "";
                this.title = "";
                this.editMode = false;
                this.modalOpen = false;
            }
        },
        created() {
            this.getAllPoems();
        }
    }).mount('#dashboard-app');
</script>
<!-- Custom Scripts Goes Here -->
</body>

</html>
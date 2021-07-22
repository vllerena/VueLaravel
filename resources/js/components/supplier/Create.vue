<template>
    <div>
        <div class="row">
            <router-link to="/index-supplier" class="btn btn-primary">All Suppliers</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Add Supplier</h1>
                                    </div>
                                    <form @submit.prevent="supplierStore" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" v-model="form.name" class="form-control"
                                                               placeholder="Enter Your Full Name">
                                                        <small class="text-danger"
                                                               v-if="errors.name">{{ errors.name[0] }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="email" v-model="form.email"
                                                               class="form-control" placeholder="Enter Your Email">
                                                        <small class="text-danger"
                                                               v-if="errors.email">{{ errors.email[0] }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="tel" v-model="form.phone" class="form-control"
                                                               placeholder="Enter Your Phone">
                                                        <small class="text-danger"
                                                               v-if="errors.phone">{{ errors.phone[0] }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" v-model="form.address"
                                                               class="form-control"
                                                               placeholder="Enter Your Address">
                                                        <small class="text-danger"
                                                               v-if="errors.address">{{ errors.address[0] }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="number" v-model="form.nid" class="form-control"
                                                               placeholder="Enter Your NID">
                                                        <small class="text-danger"
                                                               v-if="errors.nid">{{ errors.nid[0] }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="date" v-model="form.shopname"
                                                               class="form-control"
                                                               placeholder="Enter Your Shopname">
                                                        <small class="text-danger"
                                                               v-if="errors.shopname">{{ errors.shopname[0] }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input type="file" class="custom-file-input"
                                                                           id="customFile" @change="onFileSelected">
                                                                    <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>
                                                                    <label class="custom-file-label"
                                                                           htmlFor="customFile">Choose File</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <img :src="form.photo"
                                                                         style="height: 60px; width: 60px" alt="photo">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Register
                                            </button>
                                        </div>
                                        <hr>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <router-link to="/" class="font-weight-bold small">Already have an
                                            account?
                                        </router-link>
                                    </div>
                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Create",
    created() {
        if (!User.loggedIn()) {
            this.$router.push({name: '/'})
        }
    },
    data() {
        return {
            form: {
                name: null,
                email: null,
                phone: null,
                shopname: null,
                address: null,
                photo: null,
            },
            errors: {}
        }
    },
    methods: {
        supplierStore() {
            axios.post('/api/admin/suppliers/store', this.form)
                .then(() => {
                    this.$router.push({name: 'index-supplier'})
                    Notification.success()
                })
                .catch(error => this.errors = error.response.data.errors)
        },
        onFileSelected(event) {
            let file = event.target.files[0];
            if (file.size > 1048770) {
                Notification.image_validation()
            } else {
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.photo = event.target.result
                }
                reader.readAsDataURL(file);
            }
        }
    }
}
</script>

<style scoped>

</style>

<template>
    <div>
        <div class="row">
            <router-link to="/index-employee" class="btn btn-primary">All Employee</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Edit Employee</h1>
                                    </div>
                                    <form @submit.prevent="employeeUpdate" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" v-model="form.name" class="form-control" placeholder="Enter Your Full Name">
                                                        <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="email" v-model="form.email" class="form-control" placeholder="Enter Your Email">
                                                        <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="tel" v-model="form.phone" class="form-control" placeholder="Enter Your Phone">
                                                        <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="number" step="any" v-model="form.sallery" class="form-control" placeholder="Enter Your Sallery">
                                                        <small class="text-danger" v-if="errors.sallery">{{errors.sallery[0]}}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" v-model="form.address" class="form-control" placeholder="Enter Your Address">
                                                        <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="number" v-model="form.nid" class="form-control" placeholder="Enter Your NID">
                                                        <small class="text-danger" v-if="errors.nid">{{errors.nid[0]}}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="date" v-model="form.joining_date" class="form-control" placeholder="Enter Your Joining Date">
                                                        <small class="text-danger" v-if="errors.joining_date">{{errors.joining_date[0]}}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">
                                                                    <small class="text-danger" v-if="errors.photo">{{errors.photo[0]}}</small>
                                                                    <label class="custom-file-label" for="customFile">Choose File</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <img :src="form.photo" style="height: 60px; width: 60px" alt="photo">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                                        </div>
                                        <hr>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <router-link to="/" class="font-weight-bold small">Already have an account?</router-link>
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
    name: "Edit",
    created() {
        if (!User.loggedIn()){
            this.$router.push({name: '/'})
        }
        let id = this.$route.params.id
        axios.get('/api/admin/employees/show/' + id)
        .then(({data}) => (this.form = data))
        .catch()
    },
    data() {
        return {
            form: {
                name: '',
                email: '',
                phone: '',
                sallery: '',
                address: '',
                photo: '',
                newphoto: '',
                nid: '',
                joining_date: '',
            },
            errors: {}
        }
    },
    methods: {
        employeeUpdate() {
            let id = this.$route.params.id
            axios.patch('/api/admin/employees/update/' + id, this.form)
                .then(() => {
                    this.$router.push({name: 'index-employee'})
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
                    this.form.newphoto = event.target.result
                }
                reader.readAsDataURL(file);
            }
        }
    }
}
</script>

<style scoped>

</style>

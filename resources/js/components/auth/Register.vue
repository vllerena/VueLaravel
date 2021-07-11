<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Register</h1>
                                    </div>
                                    <form @submit.prevent="signup">
                                        <div class="form-group">
                                            <input type="text" v-model="form.datos_personales" class="form-control" placeholder="Enter Your Full Name">
                                            <small class="text-danger" v-if="errors.datos_personales">{{errors.datos_personales[0]}}</small>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" v-model="form.username" class="form-control" placeholder="Enter Your Username">
                                            <small class="text-danger" v-if="errors.username">{{errors.username[0]}}</small>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" v-model="form.password" class="form-control" placeholder="Password">
                                            <small class="text-danger" v-if="errors.password">{{errors.password[0]}}</small>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" v-model="form.password_confirmation" class="form-control" placeholder="Confirm Password">
                                            <small class="text-danger" v-if="errors.password_confirmation">{{errors.password_confirmation[0]}}</small>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Register</button>
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
    name: "Register",
    created() {
        if (User.loggedIn()){
            this.$router.push({name: 'home'})
        }
    },
    data() {
        return {
            form: {
                datos_personales: null,
                username: null,
                password: null,
                password_confirmation: null
            },
            errors: {}
        }
    },
    methods: {
        signup() {
            axios.post('/api/auth/signup', this.form)
                .then(res => {
                    User.responseAfterLogin(res)
                    Toast.fire({
                        icon: 'success',
                        title: 'Signed in successfully'
                    })
                    this.$router.push({name: 'home'})
                })
                .catch(error => this.errors = error.response.data.errors)
        }
    }

}
</script>

<style scoped>

</style>

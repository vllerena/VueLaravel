<template>
    <div>
        <div class="py-3 d-flex flex-row">
            <router-link to="/create-employee" class="btn btn-primary">Add Employee</router-link>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-4 mt-2">
                <div class="py-3 d-flex flex-row">
                    <input type="text" v-model="searchTerm" class="form-control" style="width: 300px" placeholder="Search Here">
                </div>
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Employee List</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Phone</th>
                                <th>Sallery</th>
                                <th>Joining Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="employee in filterSearch" :key="employee.id">
                                <td>{{employee.name}}</td>
                                <td v-if="employee.photo"><img :src="employee.photo" :alt="employee.name" id="em_photo"></td>
                                <td v-else>Sin foto</td>
                                <td>{{employee.phone}}</td>
                                <td>{{employee.sallery}}</td>
                                <td>{{employee.joining_date}}</td>
                                <td>
                                    <router-link :to="{name: 'edit-employee', params: {id: employee.id}}" class="btn btn-sm btn-warning">Edit</router-link>
                                    <a @click="deleteEmployee(employee.id)" href="#" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Index",
    created() {
        if (!User.loggedIn()){
            this.$router.push({name: '/'})
        }
        this.allEmployee()
    },
    data(){
        return{
            employees: [],
            searchTerm: ''
        }
    },
    computed: {
        filterSearch(){
            return this.employees.filter(employee => {
                return employee.name.match(this.searchTerm)
            })
        }
    },
    methods: {
        allEmployee(){
            axios.get('/api/admin/employees/index', this.form)
                .then(({data}) => (this.employees = data))
                .catch()
        },
        deleteEmployee(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/admin/employees/destroy/' + id)
                        .then(() => {
                            this.employees = this.employees.filter(employee => {
                                return employee.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push({name: '/index-employee'})
                        })
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        }
    },
}
</script>

<style scoped>
    #em_photo{
        height: 60px;
        width: 60px;
    }
</style>

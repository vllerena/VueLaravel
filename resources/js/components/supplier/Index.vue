<template>
    <div>
        <div class="py-3 d-flex flex-row">
            <router-link to="/create-supplier" class="btn btn-primary">Add Supplier</router-link>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-4 mt-2">
                <div class="py-3 d-flex flex-row">
                    <input type="text" v-model="searchTerm" class="form-control" style="width: 300px" placeholder="Search Here">
                </div>
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Supplier List</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Photo</th>
                                <th>Shopname</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="supplier in filterSearch" :key="supplier.id">
                                <td>{{supplier.name}}</td>
                                <td>{{supplier.email}}</td>
                                <td>{{supplier.phone}}</td>
                                <td>{{supplier.address}}</td>
                                <td v-if="supplier.photo"><img :src="supplier.photo" :alt="supplier.name" id="em_photo"></td>
                                <td v-else>Sin foto</td>
                                <td>{{supplier.shopname}}</td>
                                <td>
                                    <router-link :to="{name: 'edit-supplier', params: {id: supplier.id}}" class="btn btn-sm btn-warning">Edit</router-link>
                                    <a @click="deleteSupplier(supplier.id)" href="#" class="btn btn-sm btn-danger">Delete</a>
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
        this.allSupplier()
    },
    data(){
        return{
            suppliers: [],
            searchTerm: ''
        }
    },
    computed: {
        filterSearch(){
            return this.suppliers.filter(supplier => {
                return supplier.name.match(this.searchTerm)
            })
        }
    },
    methods: {
        allSupplier(){
            axios.get('/api/admin/suppliers/index', this.form)
                .then(({data}) => (this.suppliers = data))
                .catch()
        },
        deleteSupplier(id){
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
                    axios.delete('/api/admin/suppliers/destroy/' + id)
                        .then(() => {
                            this.suppliers = this.suppliers.filter(supplier => {
                                return supplier.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push({name: '/index-supplier'})
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

</style>

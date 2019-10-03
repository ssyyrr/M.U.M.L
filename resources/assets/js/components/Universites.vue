<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isSuperadministratorOrAdministratorOrEnseignant()">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Universites Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Add New <i class="fa fa-landmark "></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body table-responsive p-0">


                            <table class="table table-hover">
                                            <tbody>
                                            <tr>

                                                <th> <i > </i> Id</th>
                                                <th> <i class="fa fa-landmark purple"> </i>intitule</th>
                                                <th> <i > </i>Abreviation</th>

                                                <th> <i class="fa fa-edit  blue"> Modify </i></th>
                                                <th> <i class="fa fa-trash red"> Delete </i></th>

                                            </tr>

                                            <tr v-for="universite in universites.data" :key="universite.id ">
 
                                                    <td>{{universite.Id}}</td>
                                                    <td>{{universite.intitule}}</td>
                                                    <td>{{universite.abrev}}</td>
 
 
                                                    <td>
                                                        <a href="#" @click="editModal(universite)">
                                                            <i class="fa fa-edit blue"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="#" @click="deleteUniversite(universite.id)">
                                                            <i class="fa fa-trash red"></i>
                                                        </a>
                                                    </td>
                                            </tr>
                                            </tbody>
                                         </table>
                     
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination :data="universites" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>

        <div v-if="!$gate.isSuperadministratorOrAdministratorOrEnseignant()">
            <not-found></not-found>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New</h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update universite's Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form @submit.prevent="editmode ? updateUniversite() : createUniversite()">
                        <div class="modal-body">


                              
                            <div class="form-group row">
                                <label for='abrev' class="col-md-4 col-form-label text-md-right">Abreviation</label>
                                <span class="fas fa-user form-control-row"  aria-hidden="true" ></span>
                                <div class="col-md-6">
                                <input v-model="form.name" type="text" name="abrev"
                                       placeholder="abrev"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('abrev') }">
                                <has-error :form="form" field="abrev"></has-error>
                            </div>
                            </div> 
                            
                            <div class="form-group row">
                                <label for='abrev' class="col-md-4 col-form-label text-md-right">Abreviation</label>
                                <span class="fas fa-user form-control-row"  aria-hidden="true" ></span>
                                <div class="col-md-6">
                                <input v-model="form.name" type="text" name="abrev"
                                       placeholder="abrev"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('abrev') }">
                                <has-error :form="form" field="abrev"></has-error>
                            </div>
                            </div> 
                            
                            <div class="form-group row">
                                <label for='abrev' class="col-md-4 col-form-label text-md-right">Abreviation</label>
                                <span class="fas fa-user form-control-row"  aria-hidden="true" ></span>
                                <div class="col-md-6">
                                <input v-model="form.name" type="text" name="abrev"
                                       placeholder="abrev"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('abrev') }">
                                <has-error :form="form" field="abrev"></has-error>
                            </div>
                            </div>
 

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        
        data() 
        {
            return {
                editmode: false,
                 universites:{},
                 form: new Form({

                    id:'',
                    intitule: '',
                    abrev: '',

                })
            }
        },
        
        methods: {
               
            getResults(page = 1) {
                axios.get('/universites?page=' + page)
                    .then(response => {
                        this.universites = response.data;
                    });
            },
            updateUser()
            {
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('/universite/'+this.form.id)
                    .then(() => {
                        // success
                        $('#addNew').modal('hide');
                        swal(
                            'Updated!',
                            'Information has been updated.',
                            'success'
                        )
                        this.$Progress.finish();
                        Fire.$emit('AfterCreate');
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });

            },
            editModal(universite){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            deleteUniversite(id){
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    // Send request to the server
                    if (result.value) {
                        this.form.delete('universite/'+id).then(()=>{
                            swal(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            Fire.$emit('AfterCreate');
                        }).catch(()=> {
                            swal("Failed!", "There was something wronge.", "warning");
                        });
                    }
                })
            },
            loadUniversite(){

                    axios.get("universite").then(({ data }) => (this.universite = data));

            },

            createUser(){
                this.$Progress.start();

                this.form.post('universite')
                    .then(()=>{
                        Fire.$emit('AfterCreate');
                        $('#addNew').modal('hide')

                        toast({
                            type: 'success',
                            title: 'User Created in successfully'
                        })
                        this.$Progress.finish();

                    })
                    .catch(()=>{

                    })
            }
        },
        
        created() {
            Fire.$on('searching',() => {
                let query = this.$parent.search;
                axios.get('finduniversite?q=' + query)
                    .then((data) => {
                        this.users = data.data
                    })
                    .catch(() => {

                    })
            })
            this.loadUniversites();
            Fire.$on('AfterCreate',() => {
                this.loadUsers();
            });
            //    setInterval(() => this.loadUsers(), 3000);
        }

    }
</script>

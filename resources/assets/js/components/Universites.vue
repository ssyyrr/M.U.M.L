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
                                                <th> ID</th>

                                                <th> <i class="fa fa-landmark purple"> </i>Intitulé</th>
                                                <th> <i > </i>Abreviation</th>

                                                <th> <i class="fa fa-edit  blue"> Modify </i></th>
                                                <th> <i class="fa fa-trash red"> Delete </i></th>

                                            </tr>

                                            <tr v-for="universite in universites.data" :key="universite.id ">

                                                <td>{{universite.id}}</td>

                                                <td>
                                                     <a v-bind:href="`/etablissement/${universite.id}`">
                                                     <!--<a :href="`/Etablissements/${universite.id}`">-->

                                                     {{universite.intitule}}
                                                     </a>
                                                 </td>

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
                                <label for='intitule' class="col-md-4 col-form-label text-md-right">Intitule</label>
                                <span class="fa fa-landmark form-control-row"  aria-hidden="true" ></span>
                                <div class="col-md-6">
                                <input v-model="form.intitule" type="text" name="intitule"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('intitule') }">
                                        <has-error :form="form" field="intitule"></has-error>
                            </div>
                            </div> 
                            
                            <div class="form-group row">
                                <label for='abrev' class="col-md-4 col-form-label text-md-right">Abreviation</label>
                                <span class="fa fa-landmark form-control-row"  aria-hidden="true" ></span>
                                <div class="col-md-6">
                                <input v-model="form.abrev" type="text" name="abrev"
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
                axios.get('api/universite?page=' + page)
                    .then(response => {
                        this.universites = response.data;
                    });
            },
            updateUniversite()
            {
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/universite/'+this.form.id)
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
                this.form.fill(universite);
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
                        this.form.delete('api/universite/'+id).then(()=>{
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
            loadUniversites(){

                    axios.get("api/universite").then(({ data }) => (this.universites = data));

            },

            createUniversite(){
                this.$Progress.start();

                this.form.post('api/universite')
                    .then(()=>{
                        Fire.$emit('AfterCreate');
                        $('#addNew').modal('hide')

                        toast({
                            type: 'success',
                            title: 'Universite Created in successfully'
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
                axios.get('api/findUniversite?q=' + query)
                    .then((data) => {
                        this.universites = data.data
                    })
                    .catch(() => {

                    })
            })
            this.loadUniversites();
            Fire.$on('AfterCreate',() => {
                this.loadUniversites();
            });
            //    setInterval(() => this.loadUniversites(), 3000);
        }

    }
</script>

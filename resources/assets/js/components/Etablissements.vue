Etablissements
<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isSuperadministratorOrAdministratorOrEnseignant()">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Etablissements Table</h3>

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

                            <tr v-for="etablissement in etablissements.data" :key="etablissement.id ">

                                <td>{{etablissement.id}}</td>
                                <td>{{etablissement.intitule}}</td>
                                <td>{{etablissement.abrev}}</td>
                                <td>
                                    <a href="#" @click="editModal(etablissement)">
                                        <i class="fa fa-edit blue"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" @click="deleteEtablissement(etablissement.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination :data="etablissements" @pagination-change-page="getResults"></pagination>
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
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update etablissement's Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form @submit.prevent="editmode ? updateEtablissement() : createEtablissement()">
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
                etablissements:{},
                form: new Form({

                    id:'',
                    universite_id:'',
                    intitule: '',
                    abrev: '',

                })
            }
        },

        methods: {

            getResults(page = 1) {
                axios.get('api/etablissement?page=' + page)
                    .then(response => {
                        this.etablissements = response.data;
                    });
            },
            updateEtablissement()
            {
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/etablissement/'+this.form.id)
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
            editModal(etablissement){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(etablissement);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            deleteEtablissement(id){
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
                        this.form.delete('api/etablissement/'+id).then(()=>{
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
            loadEtablissements(){

                axios.get("api/etablissement").then(({ data }) => (this.etablissements = data));

                    // axios.get(`/etablissement/30`).then(({ data }) => (this.etablissements = data));
            },

            createEtablissement(){
                this.$Progress.start();

                this.form.post('api/etablissement')
                    .then(()=>{
                        Fire.$emit('AfterCreate');
                        $('#addNew').modal('hide')

                        toast({
                            type: 'success',
                            title: 'Etablissement Created in successfully'
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
                axios.get('api/findEtablissement?q=' + query)
                    .then((data) => {
                        this.etablissements = data.data
                    })
                    .catch(() => {

                    })
            })
            this.loadEtablissements();
            Fire.$on('AfterCreate',() => {
                this.loadEtablissements();
            });
            //    setInterval(() => this.loadEtablissements(), 3000);
        }

    }
</script>

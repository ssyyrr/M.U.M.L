<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isSuperadministratorOrAdministratorOrEnseignant()">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Add New <i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">

                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>cin</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>universite</th>

                                <th>Registered At</th>
                                <th>Modify</th>
                                <th>Delete</th>

                            </tr>

                            <tr v-for="user in users.data" :key="user.id ">
                                <td>{{user.id}}</td>
                                <td>{{user.cin}}</td>
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                                <td>{{user.type | upText}}</td>
                                <td>{{user.universite_id}}</td>
                                <td>{{user.created_at | myDate}}</td>

                                <td>
                                    <a href="#" @click="editModal(user)">
                                        <i class="fa fa-edit blue"></i>
                                    </a>
                                 </td>
                                <td>
                                    <a href="#" @click="deleteUser(user.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody></table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination :data="users" @pagination-change-page="getResults"></pagination>
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
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update User's Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">


                            <div class="form-group row">
                                <label for='cin' class="col-md-4 col-form-label text-md-right">Carte Identite Nationale</label>
                                <span class="fas fa-address-card form-control-row"  aria-hidden="true" ></span>

                                <div class="col-md-6">
                                    <input id='cin'
                                           type='text'
                                           v-model="form.cin"
                                           placeholder="Carte Identite Nationale"
                                           data-inputmask="'mask':'99999999'"  data-mask
                                           name='cin' required
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('cin') }">
                                    <has-error :form="form" field="cin"></has-error>

                                </div>
                            </div>






                            <!--<div class="form-group">-->
                                <!--<input v-model="form.cin" type="text" name="cin"-->
                                       <!--placeholder="Carte Identite Nationale"-->
                                       <!--class="form-control" :class="{ 'is-invalid': form.errors.has('cin') }">-->
                                <!--<has-error :form="form" field="cin"></has-error>-->
                            <!--</div>-->

                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name"
                                       placeholder="Name"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>


                            <div class="form-group">
                                <input v-model="form.prenom" type="text" name="prenom"
                                       placeholder="prenom"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('prenom') }">
                                <has-error :form="form" field="prenom"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.datenaissance" type="text" name="datenaissance"
                                       placeholder="datenaissance"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('datenaissance') }">
                                <has-error :form="form" field="datenaissance"></has-error>
                            </div>


                            <div class="form-group">
                                <input v-model="form.email" type="email" name="email"
                                       placeholder="E-Mail Address"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.password" type="password" name="password" id="password" placeholder="Password"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>

                                    <!--<div class="form-group">-->
                                        <!--<input v-model="form.universite_id" type="text" name="universite_id"-->
                                               <!--placeholder="universite_id"-->
                                               <!--class="form-control" :class="{ 'is-invalid': form.errors.has('universite_id') }">-->
                                        <!--<has-error :form="form" field="universite_id"></has-error>-->
                                    <!--</div>-->
                            <!--<div class="form-group">-->
                                <!--<input v-model="form.etablissement_id" type="text" name="etablissement_id"-->
                                       <!--placeholder="etablissement_id"-->
                                       <!--class="form-control" :class="{ 'is-invalid': form.errors.has('etablissement_id') }">-->
                                <!--<has-error :form="form" field="etablissement_id"></has-error>-->
                            <!--</div>-->



                            <div class="form-group">
                                    <select type="text" name="profile" v-model="form.profile" id="profile"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('profile') }" required autofocus >

                                    <option value="">Select User Role</option>
                                        <option value="Etudiant">Etudiant</option>
                                        <option value="Enseignant">Enseignant</option>

                                </select>
                                <has-error :form="form" field="profile"></has-error>
                            </div>


                            <div class="form-group">
                                <select type="text" name="grade" v-model="form.grade" id="grade"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('grade') }" required autofocus >
                                    <option value="">Select User Grade</option>
                                    <option value="Professeur">Professeur</option>
                                    <option value="Maitre de conference">Maitre de conference</option>
                                    <option value="Maitre Assisstant">Maitre Assisstant</option>
                                    <option value="Maitre Technologue">Maitre Technologue</option>
                                    <option value="Technologue">Technologue</option>
                                    <option value="Assisstant">Assisstant</option>
                                    <option value="P.E.S">Professeur d'enseignement supérieur</option>
                                    <option value="etudiant">Etudiant</option>

                                </select>
                                <has-error :form="form" field="grade"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.addresse" type="text" name="addresse"
                                       placeholder="addresse"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('addresse') }">
                                <has-error :form="form" field="addresse"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.numtel" type="text" name="numtel"
                                       placeholder="numtel"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('numtel') }">
                                <has-error :form="form" field="numtel"></has-error>
                            </div>

                            <div class="form-group">
                                <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }"
                                        required autofocus>
                                    <option value="">--Valider Utilisateur--</option>
                                    <option value="User">Standard User</option>
                                    <option value="Administrator">Administrator</option>
                                    <option value="Enseignant">Enseignant</option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>

                            <div class="form-group">
                              <textarea v-model="form.bio" name="bio" id="bio"
                                  placeholder="Short bio/experience for user (Optional)"
                                  class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                <has-error :form="form" field="bio"></has-error>
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
        data() {
            return {
                editmode: false,
                users : {},
                universites:{},
                etablissements:{},
                form: new Form({
                    id:'',
                    cin:'',
                    name : '',
                    prenom:'',
                    datenaissance:'',
                    email: '',
                    password: '',
                    universite_id:'',
                    etablissement_id:'',
                    profile:'',
                    grade:'',
                    addresse:'',
                    numtel:'',
                    type: '',
                    bio: '',
                    photo: '',





                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/user?page=' + page)
                    .then(response => {
                        this.users = response.data;
                    });
            },
            updateUser(){
                $(document).ready(function(){
                    $("input").inputmask();

                    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
                    $('[data-mask]').inputmask();

                })
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/user/'+this.form.id)
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
            editModal(user){
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
            deleteUser(id){
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
                        this.form.delete('api/user/'+id).then(()=>{
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
            loadUsers(){
                if(this.$gate.isSuperadministratorOrAdministratorOrEnseignant()){
                    axios.get("api/user").then(({ data }) => (this.users = data));
                }
            },

            createUser(){
                this.$Progress.start();

                this.form.post('api/user')
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
                axios.get('api/findUser?q=' + query)
                    .then((data) => {
                        this.users = data.data
                    })
                    .catch(() => {

                    })
            })
            this.loadUsers();
            Fire.$on('AfterCreate',() => {
                this.loadUsers();
            });
            //    setInterval(() => this.loadUsers(), 3000);
        }

    }
</script>

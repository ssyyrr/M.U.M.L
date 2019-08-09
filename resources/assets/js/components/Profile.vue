<style>
.widget-user-header{
    background-position: center center;
    background-size: cover;
    height: 250px !important;
}
.widget-user .card-footer{
    padding: 0;
}

</style>

<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header text-white" style="background-image:url('./img/usercover.jpg')">
                    <h3 class="widget-user-username">{{this.form.name}}-{{this.form.prenom}}</h3>
                    <h5 class="widget-user-desc">{{this.form.profile}}-{{this.form.grade}}</h5>
                    <h5 class="widget-user-desc">{{this.form.universite_id}}-{{this.form.etablissement_id}}</h5>

                </div>
                <div class="widget-user-image">
                    <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
                </div>
                <div class="card-footer">
                    <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                        <h5 class="description-header">3,200</h5>
                        <span class="description-text">SALES</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                        <h5 class="description-header">13,000</h5>
                        <span class="description-text">FOLLOWERS</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                        <div class="description-block">
                        <h5 class="description-header">35</h5>
                        <span class="description-text">PRODUCTS</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                </div>
            </div>

            <!-- tab -->

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                        <li class="nav-item"><a class="nav-link active show" href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Activity Tab -->
                            <div class="tab-pane" id="activity">
                                <h3 class="text-center">Display User Activity</h3>
                            </div>
                            <!-- Setting Tab -->
                            <div class="tab-pane active show" id="settings">
                                <form class="form-horizontal">

                                    <div class="form-group">
                                            <label for="inputcin" class="col-sm-4 control-label">Carte Identite Nationale</label>

                                            <div class="col-sm-12">
                                                <input type="text" v-model="form.cin" class="form-control" id="inputcin" placeholder="cin"
                                                       :class="{ 'is-invalid': form.errors.has('cin') }">
                                                <has-error :form="form" field="cin"></has-error>
                                            </div>
                                    </div>


                                    <div class="form-group">
                                            <label for="inputName" class="col-sm-4 control-label">Name</label>

                                            <div class="col-sm-12">
                                            <input type="text" v-model="form.name" class="form-control" id="inputName" placeholder="Name"
                                                   :class="{ 'is-invalid': form.errors.has('name') }">
                                             <has-error :form="form" field="name"></has-error>
                                            </div>
                                    </div>


                                    <div class="form-group">
                                            <label for="inputprenom" class="col-sm-4 control-label">prenom</label>

                                            <div class="col-sm-12">
                                                <input type="text" v-model="form.prenom" class="form-control" id="inputprenom" placeholder="prenom"
                                                       :class="{ 'is-invalid': form.errors.has('prenom') }">
                                                <has-error :form="form" field="prenom"></has-error>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                            <label for="inputdatenaissance" class="col-sm-4 control-label">datenaissance {{form.datenaissance}}</label>

                                            <div class="col-sm-12">
                                                <input type="text"  v-model="form.datenaissance"
                                                       class="form-control" :class="{ 'is-invalid': form.errors.has('datenaissance') }"
                                                       id="inputdatenaissance"
                                                        placeholder="dd/mm/yyyy">
                                                       <!--data-inputmask="'alias': 'dd/mm/yyyy'" data-mask -->
                                                       <!--v-on:change="maskCheck"-->


                                                <has-error :form="form" field="datenaissance"></has-error>
                                            </div>
                                    </div>
                                    
                                    <div class="form-group">
                                            <label for="inputEmail" class="col-sm-4 control-label">Email</label>

                                            <div class="col-sm-12">
                                            <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email"
                                                   :class="{ 'is-invalid': form.errors.has('email') }">
                                             <has-error :form="form" field="email"></has-error>
                                            </div>
                                    </div>

                                    <div class="form-group">
                                            <label for="password" class="col-sm-12 control-label">Passport (leave empty if not changing)</label>

                                            <div class="col-sm-12">
                                                <input type="password"
                                                       v-model="form.password"
                                                       class="form-control"
                                                       id="password"
                                                       placeholder="Passport"
                                                       :class="{ 'is-invalid': form.errors.has('password') }"
                                                >
                                                <has-error :form="form" field="password"></has-error>
                                            </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputuniversite" class="col-sm-4 control-label">universite</label>

                                        <div class="col-sm-12">
                                            <input type="text" v-model="form.universite_id" class="form-control" id="inputuniversite_id" placeholder="universite_id"
                                                   :class="{ 'is-invalid': form.errors.has('universite_id') }">
                                            <has-error :form="form" field="universite_id"></has-error>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputetablissement" class="col-sm-4 control-label">etablissement</label>

                                        <div class="col-sm-12">
                                            <input type="text" v-model="form.etablissement_id" class="form-control" id="inputetablissement_id" placeholder="etablissement_id"
                                                   :class="{ 'is-invalid': form.errors.has('etablissement_id') }">
                                            <has-error :form="form" field="etablissement_id"></has-error>
                                        </div>
                                    </div>



                                    <div class="form-group" id="vue-example" >
                                        <label for="inputprofile" class="col-sm-4 control-label">
                                            <span> profile : {{ form.profile }} </span>
                                        </label>

                                        <div class="col-sm-12">
                                            <select
                                                     style="width: 50%" name="profile" v-model="form.profile "
                                                     class="form-control" id="profile" placeholder="profile"
                                                    :class="{ 'is-invalid': form.errors.has('profile') }">
                                                        <option selected="Etudiant" value="Etudiant">Etudiant</option>
                                                        <option value="Enseignant">Enseignant</option>

                                            </select>


                                            <has-error :form="form" field="profile"></has-error>
                                        </div>
                                        <br>

                                         <label for="inputgrade"
                                               class="col-sm-4 control-label">
                                            <span>   grade : {{ form.grade }}  </span>
                                        </label>

                                        <div class="col-sm-12">
                                            <select
                                                      style="width: 50%" name="grade" v-model="form.grade"
                                                     class="form-control" id="grade" placeholder="grade"
                                                     :class="{ 'is-invalid': form.errors.has('grade') }" >
                                             </select>
                                            <has-error :form="form" field="grade"></has-error>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputaddresse" class="col-sm-4 control-label">addresse</label>

                                        <div class="col-sm-12">
                                            <input type="text" v-model="form.addresse" class="form-control" id="inputaddresse" placeholder="addresse"
                                                   :class="{ 'is-invalid': form.errors.has('addresse') }">
                                            <has-error :form="form" field="addresse"></has-error>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="inputnumtel" class="col-sm-4 control-label">numtel</label>

                                        <div class="col-sm-12">
                                            <input type="text" v-model="form.numtel"  id="inputnumtel"
                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('numtel') }"
                                                   >
                                            <!--data-inputmask='"mask": "(999) 9999-9999"' data-mask @change="getnumtel"-->
                                            <has-error :form="form" field="numtel"></has-error>
                                        </div>
                                    </div>




                                    <div class="form-group">
                                        <!--<label for="inputtype" class="col-sm-4 control-label">type</label>-->
                                        <!--<label for="inputtype"  id="inputtype" v-model="form.type"  class="col-sm-12">{{form.type}}</label>-->

                                        <!--<div class="col-sm-12">-->
                                            <input type="hidden" v-model="form.type" class="form-control" id="inputtype" placeholder="type"
                                                   :class="{ 'is-invalid': form.errors.has('type') }">
                                            <has-error :form="form" field="type"></has-error>
                                        <!--</div>-->
                                    </div>

                                    <div class="form-group">
                                            <label for="inputExperience" class="col-sm-4 control-label">Experience</label>

                                            <div class="col-sm-12">
                                            <textarea  v-model="form.bio" class="form-control" id="inputExperience" placeholder="Experience"
                                                       :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                             <has-error :form="form" field="bio"></has-error>
                                            </div>
                                    </div>

                                    <div class="form-group">
                                            <label for="inputphoto" class="col-sm-4 control-label">Profile Photo</label>
                                            <div class="col-sm-12">
                                                <input type="file" @change="updatePhoto" name="photo" class="form-input">
                                            </div>

                                    </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-12">
                                    <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </div>






                                </form>
                            </div>
                        <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
          </div>
          <!-- end tabs -->
        </div>
    </div>
</template>



<script>

    export default {
         data(){
            return {

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
                     photo: ''



                })
            }
        },
        mounted() {

            console.log('Component mounted.')
        },

        methods:{


            getProfilePhoto(){

                let photo = (this.form.photo.length > 200) ? this.form.photo : "img/profile/"+ this.form.photo ;
                return photo;

            },

            updateInfo()
            {

                this.$Progress.start();
                // let datenaissance = $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });



                if(this.form.password == ''){
                    this.form.password = undefined;
                }
                this.form.put('api/profile')
                .then(()=>{
                     Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            }
            ,
            updatePhoto(e){
                let file = e.target.files[0];
                let reader = new FileReader();

                let limit = 1024 * 1024 * 2;
                if(file['size'] > limit){
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You are uploading a large file',
                    })
                    return false;
                }

                reader.onloadend = (file) => {
                    this.form.photo = reader.result;
                }
                reader.readAsDataURL(file);
            },

        },

        created() {
            axios.get("api/profile")
            .then(({ data }) => (this.form.fill(data)));
        }

    }
</script>

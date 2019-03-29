
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment';
import { Form, HasError, AlertError } from 'vform';

import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);


import swal from 'sweetalert2'
window.swal = swal;

const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

window.toast = toast;


window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('pagination', require('laravel-vue-pagination'));


import VueRouter from 'vue-router'
Vue.use(VueRouter)


import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
  })

let routes = [

    { path: '/dashboard', component: require('./components/Dashboard.vue') },
    { path: '/developer', component: require('./components/Developer.vue') },
    { path: '/users', component: require('./components/Users.vue') },
    { path: '/profile', component: require('./components/Profile.vue') },
    { path: '*', component: require('./components/NotFound.vue') }
  ]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
  })



Vue.filter('upText', function(text){
    return text.charAt(0).toUpperCase() + text.slice(1)
});

Vue.filter('myDate',function(created){
    return moment(created).format('MMMM Do YYYY');
});


window.Fire =  new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

Vue.component(
    'not-found',
    require('./components/NotFound.vue')
);


Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    router,
    data:{
        search: ''
    },
    methods:{
        searchit: _.debounce(() => {
            Fire.$emit('searching');
        },1000),

        printme() {
            window.print();
        }
    }
});

var $ = jQuery;
$(function () {

    $("#universite_id").on("change",function(e){
        // console.log('je test la selection '+$(this).val());

        var id_univ = $(this).val();//e.target.value;
      //  alert(id_univ);

        $.getJSON('/ajax-etab?id_univ='+id_univ,function (data) {
            console.log(data);
            //succes data
            $('#etablissement_id').empty();
            $.each(data,function (register,etablissementObj){
                    $('#etablissement_id').append('<option value="'+etablissementObj.id+'">'+etablissementObj.intitule+'</option>');
                }
            );
        })
    });

    $("#profile").on("change",function(e){
        $('#grade').empty()

        if( $(this).val()==="Enseignant"){
            $("#divgrade").show()

            $('#grade').append('<option value="P.E.S">P.E.S</option>');
            $('#grade').append('<option value="Assisstant">Assisstant</option>');
            $('#grade').append('<option value="Maitre Technologue">Maitre Technologue</option>');
            $('#grade').append('<option value="Maitre Assisstant">Maitre Assisstant</option>');
            $('#grade').append('<option value="Maitre de conference">Maitre de conference</option>');
            $('#grade').append('<option value="Professeur">Professeur</option>');
        }
        else{
            $("#divgrade").hide()

            $('#grade').append('<option value="Etudiant">Etudiant</option>');
        }
    });


    $(document).ready(function(){
        $("input").inputmask();
        $('select').select2({
            tags: "true",
            placeholder: "--Select an option--",
            allowClear: true
        });
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
        $('[data-mask]').inputmask();

    })

    //Initialize Select2 Elements

    //Datemask dd/mm/yyyy
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
        timePicker         : true,
        timePickerIncrement: 30,
        format             : 'MM/DD/YYYY h:mm A'
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
            ranges   : {
                'Today'       : [moment(), moment()],
                'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate  : moment()
        },
        function (start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
    )

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
        showInputs: false
    })
})

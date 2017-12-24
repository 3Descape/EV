<template>
<div>
    <msg></msg>
    <form @submit.prevent="submit" ref="form">
        <div class="form-group row">
            <div class="col-lg-2 col-md-3 col-sm-12">
                <label for="name">Name:</label>
            </div>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input ref="name" v-model="file.name" type="text" id="name" class="form-control" name="name" >

                 <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('name')">
                    <ul class="m-0">
                        <li  v-bind:key="error.name" v-for="error in errors.getError('name')">{{error}}</li>
                    </ul>
                </div>
            </div>
           

        </div>

        <div class="form-group row">
            <div class="col-lg-2 col-md-3 col-sm-12">
                <label for="description">Beschreibung:</label>
            </div>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input v-model="file.description" class="form-control" type="text" id="description" name="description" >

                <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('description')">
                    <ul class="m-0">
                        <li  v-bind:key="error.description" v-for="error in errors.getError('description')">{{error}}</li>
                    </ul>
                </div>
            </div> 
        </div>

        <div class="form-group row">
            <div class="col-lg-2 col-md-3 col-sm-12">
                <label for="file">Datei:</label>
            </div>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <label class="custom-file" style="width: 100%;">
                    <input type="file" id="file" class="custom-file-input" name="file" @change="fileChange" >
                    <span class="custom-file-control">
                        <i class="fa fa-upload"></i> Datei hochladen..
                    </span>
                </label>

                <div class="progress mt-2" v-show="uploud > -1">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" :style="width" :aria-valuenow="uploud" aria-valuemin="0" aria-valuemax="100">
                        {{uploud}}%
                    </div>
                </div>

                <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('file')">
                    <ul class="m-0">
                        <li  v-bind:key="error.file" v-for="error in errors.getError('file')">{{error}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div v-show="fileSize" class="form-group row">
            <div class="col-lg-2 col-md-3 col-sm-12"></div>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <p v-text="fileSize"></p>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-2 col-md-3 col-sm-12"></div>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <button class="form-control btn btn-success" type="submit">
                    <i class="fa fa-plus"></i> Hinzufügen
                </button>
            </div>
        </div>
    </form>
</div>
</template>

<script>
import Message from './Message';
import {EventBus} from './EventBus.js';
import Errors from './Errors.js';

export default {
  data: ()=> {
      return {
          file: {
              name: "",
              description: "",
              file: {}
          },
          errors: new Errors(),
          uploud: -1
      }
  },
  components: {
      'msg': Message
  },
  methods: {
      fileChange(e){
          this.file.file = e.target.files[0];
      },
      submit(){
          let vue = this;
          let data = new FormData();
          data.append('name', this.file.name);
          data.append('description', this.file.description);
          data.append('file', this.file.file);

          let config = {
              onUploadProgress: function (progressEvent) {
                vue.uploud = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
            }
          };


          axios.post('/admin/dateien', data, config).then((msg)=>{
              vue.file.name = "";
              vue.file.description = "";
              vue.file.file = {};
              vue.$refs.name.focus();
              vue.$refs.form.reset();
              vue.errors.clearErrors();
              vue.uploud = -1;
              EventBus.$emit('msg-event', "Datei wurde hinzugefürt");
          })
          .catch((errors)=>{
              vue.errors.setErrors(errors.response.data.errors)
              vue.uploud = -1;
          });
      }
  },
  computed:{
      fileSize: function(){
          if(this.file.file.size){
              return Math.round((this.file.file.size/(1024*1024)*100),3)/100 + "MB";
          }
          return '';
      },
      width(){
          return "width:" + this.uploud + '%';
      }
  }
}
</script>

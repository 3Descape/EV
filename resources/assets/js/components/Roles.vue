<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-10 col-md-12 mx-auto">

        <h3>Berechtigungen:</h3>

        <button type="button" class="btn btn-success my-2" data-toggle="modal" data-target="#role_store_modal">
          <i class="fa fa-plus"></i> Berechtigung
        </button>

        <div class="card mb-5" v-for="(role, role_index) in roles" v-bind:key="role.id">
          <div class="card-header" :id="role.name">
            <div class="d-flex">
              <div class="mr-auto d-flex align-items-end">
                <h4 class="mb-0">{{role.name | ucfirst}}</h4>
                <p class="text-muted ml-2 mb-0">{{role.label | ucfirst}}</p>
              </div>

              <form v-if="!is_admin_role(role)" @submit.prevent="role_destroy(role)">
                <button type="submit" class="btn btn-danger float-left mx-1">
                  <i class="fa fa-trash-o"></i> Löschen
                </button>
              </form>
            </div>
          </div>

          <div class="card-body" v-if="!is_admin_role(role)">
            <div class="d-flex justify-content-end mb-2">
              <h5 class="mr-auto">Rechte:</h5>
              <button class="btn btn-success" @click="modal(role)" v-show="role.permissions.length < permissions.length">
                <i class="fa fa-plus"></i> Recht
              </button>
            </div>

            <div class="card mb-1" v-if="role.permissions" v-for="(permission, permission_index) in role.permissions" v-bind:key="permission.id">
              <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-end">
                  <span class="mr-auto">{{permission.label}}</span>
                  <form @submit.prevent="permission_role_destroy(role, role_index, permission, permission_index)">
                    <button class="btn btn-danger mx-1">
                      <i class="fa fa-trash-o"></i> Löschen
                    </button>
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <msg></msg>
      </div>
    </div>

    <modal id="role_store_modal">
      <div class="modal-header">
        <h5 class="modal-title">Berechtigung hinzufügen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form @submit.prevent="role_store()">
        <div class="modal-body">
          <div class="form-group">
            <label for="role_name">Name:</label>
            <input class="form-control" type="text" id="role_name" v-model="role.name">

            <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('name')">
              <ul class="m-0">
                <li v-bind:key="error.name" v-for="error in errors.getError('name')">{{error}}</li>
              </ul>
            </div>
          </div>

          <div class="form-group">
            <label for="label">Beschreibung:</label>
            <input class="form-control" type="text" id="label" v-model="role.label">

            <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('label')">
              <ul class="m-0">
                <li v-bind:key="error.label" v-for="error in errors.getError('label')">{{error}}</li>
              </ul>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">
            <i class="fa fa-plus"></i> Hinzufügen
          </button>
          <button type="button" class="btn btn-light border border-dark" data-dismiss="modal">
            <i class="fa fa-times"></i> Abbrechen
          </button>
        </div>
      </form>
    </modal>

    <modal id="permission_add_modal">
      <div class="modal-header">
        <h5 class="modal-title">Recht hinzufügen..</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form @submit.prevent="permission_role_store()">
        <div class="modal-body">
          <div class="form-group">
            <label for="permission_add">Recht:</label>
            <select id="permission_add" class="custom-select" v-model="permission_selected">
              <option v-for="permission in possible_permissions" v-bind:key="permission.id" :value="permission">
                {{permission.label}}
              </option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">
            <i class="fa fa-plus"></i> Hinzufügen
          </button>
          <button type="button" class="btn btn-light border border-dark" data-dismiss="modal">
            <i class="fa fa-times"></i> Abbrechen
          </button>
        </div>
      </form>
    </modal>
  </div>
</template>

<script>
import Modal from "./Modal.vue";
import Errors from "./Errors.js";
import Message from "./Message.vue";
import { EventBus } from "./EventBus.js";
export default {
  props: ["rolesProp", "permissions"],
  components: {
    modal: Modal,
    msg: Message
  },
  data() {
    return {
      role: {},
      roles: [],
      permission_selected: {},
      possible_permissions: [],
      errors: new Errors()
    };
  },
  methods: {
    role_store() {
      let vue = this;
      axios
        .post("/admin/rolle", {
          name: vue.role.name,
          label: vue.role.label
        })
        .then(msg => {
          vue.roles.push(msg.data.role);
          vue.role = { name: "", label: "" };
          $("#role_store_modal").modal("hide");
          vue.errors.clearErrors();
          EventBus.$emit("msg-event", msg.data.status);
        })
        .catch(errors => {
          vue.errors.setErrors(errors.response.data.errors);
          EventBus.$emit(
            "msg-event",
            "Es ist ein Fehler aufgetreten.",
            "danger"
          );
        });
    },
    role_destroy(role) {
      let vue = this;
      axios
        .post(`/admin/rolle/${role.id}`, {
          _method: "delete"
        })
        .then(msg => {
          vue.roles.splice(
            vue.roles
              .map(role => {
                return role.id;
              })
              .indexOf(role.id),
            1
          );
          EventBus.$emit("msg-event", msg.data.status);
        })
        .catch(errors => {
          EventBus.$emit(
            "msg-event",
            "Es ist ein Fehler aufgetreten.",
            "danger"
          );
        });
    },
    permission_role_store() {
      let vue = this;
      axios
        .post(
          `/admin/rolle/${vue.role.id}/berechtigung/${vue.permission_selected
            .id}`,
          {}
        )
        .then(msg => {
          vue.rolesProp[vue.rolesProp.indexOf(vue.role)].permissions.push(
            vue.permission_selected
          );
          vue.role = {};
          vue.permission_selected = {};
          EventBus.$emit("msg-event", msg.data.status);
        })
        .catch(errors => {
          EventBus.$emit(
            "msg-event",
            "Es ist ein Fehler aufgetreten.",
            "danger"
          );
        });

      $("#permission_add_modal").modal("hide");
    },
    permission_role_destroy(role, role_index, permission, permission_index) {
      let vue = this;
      axios
        .post(`/admin/rolle/${role.id}/berechtigung/${permission.id}`, {
          _method: "delete"
        })
        .then(msg => {
          vue.roles[role_index].permissions.splice(permission_index, 1);
          EventBus.$emit("msg-event", msg.data.status);
        })
        .catch(errors => {
          EventBus.$emit(
            "msg-event",
            "Es ist ein Fehler aufgetreten.",
            "danger"
          );
        });
    },
    is_admin_role(role) {
      return role.name === "administrator";
    },
    select_options(role) {
      return this.permissions.filter(function(permission) {
        return (
          role.permissions
            .map(permission => {
              return permission.id;
            })
            .indexOf(permission.id) < 0
        );
      });
    },
    modal(role) {
      this.role = role;
      this.possible_permissions = this.select_options(role);
      this.permission_selected = this.possible_permissions[0];
      $("#permission_add_modal").modal("show");
    }
  },
  created() {
    this.roles = this.rolesProp;
  },
  filters: {
    ucfirst: function(value) {
      if (!value) return "";
      return value.charAt(0).toUpperCase() + value.slice(1);
    }
  }
};
</script>

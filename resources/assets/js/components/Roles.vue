<script>
export default {
  props: ["options", "roles"],
  data() {
    return {
      role_id: null,
      select_options: []
    };
  },
  methods: {
    getOptions(id) {
      let role = this.roles.find(function(role) {
        return role.id === id;
      });

      let ids = role.permissions.map(function(permission) {
        return permission.id;
      });

      let options = this.options.filter(function(option) {
        return !ids.includes(option.id);
      });
      return options;
    },
    modal(id) {
      this.role_id = id;
      this.select_options = this.getOptions(id);
      $("#permission_add_modal").modal("show");
    }
  }
};
</script>

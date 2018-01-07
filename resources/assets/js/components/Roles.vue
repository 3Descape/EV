<script>
export default {
    props:['options', 'roles'],
    data(){
        return{
            role_id: null,
            select_options: [],
        }
    },
    methods: {
        getOptions(id){
            var role = this.roles.find(function(role){
                return role.id === id;
            });

            var ids = role.permissions.map(function(permission){
                return permission.id
            });

            var options = this.options.filter(function(option){
                return !ids.includes(option.id);
            })
            return options
        },
        modal(id){
            this.role_id = id;
            this.select_options = this.getOptions(id);
            $('#permissionModal').modal('show');
        },
    }
}
</script>

<style lang="css">
</style>

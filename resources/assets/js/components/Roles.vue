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

            console.log(ids)
            var options = this.options.filter(function(option){
                console.log(option.id)
                return !ids.includes(option.id);
            })
            return options
        },
        modal(id){
            this.role_id = id;
            this.select_options = this.getOptions(id);
            $('#permissionModal').modal('show');
        },
    },
    mounted(){
        console.log(this.role_id)
    }
}
</script>

<style lang="css">
</style>

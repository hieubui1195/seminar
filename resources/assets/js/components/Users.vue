<template>
    <table id="myTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th> ID </th>
                <th> Name </th>
                <th> Email </th>
                <th> Phone </th>
                <th> Address </th>
                <th> Status </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users">
                <td> {{ user.id }} </td>
                <td> {{ user.name }} </td>
                <td> {{ user.email }} </td>
                <td> {{ user.phone }} </td>
                <td> {{ user.address }} </td>
                <td>
                    <select name="statusUser" id="statusUser" v-model="user.status" @change="updateStatusUser(user.id,  user.status)">
                        <option value="0">0</option>
                        <option value="1">1</option>
                    </select>
                </td>
                <td>
                    <a @click="deleteUser(user.id)">
                        <i class="glyphicon glyphicon-trash"></i>    
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        data () {
            return {
                users : [],
                user : {
                    id : '',
                    status : ''
                }
            };
        },
        mounted () {
            this.getAllUser();
        },
        methods : {
            getAllUser () {
                axios.get('admin-users')
                .then(response => {
                    this.users = response.data.users;
                })
                .catch(response => {
                    throw new Error("Could not load user list your ");
                });
            },
            updateStatusUser (id, status) {
                this.user.status = status;
                if (confirm("Are you sure you want to change?")) {
                    axios.put('admin-users/' + id, this.user)
                    .then(response => {
                        toastr.success('update user complete');
                        this.getAllUser();
                    })
                    .catch(error => {
                        toastr.warning(error);
                    });
                } else {
                    this.getAllUser();
                }
            },
            deleteUser (id) {
                this.user.id= id;
                axios.delete('admin-users/' + this.user.id)
                .then(response => {
                    toastr.success('delete user complete');
                    this.getAllUser();
                })
                .catch(error => {
                    toastr.warning(error);
                });
            }
        }
    }
</script>

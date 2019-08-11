<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Lista de todos os Usuários</div>

                    <div class="card-body">

                        <router-link to="/create" class="btn btn-success btn-sm mb-3"><i class="fa fa-plus-square"></i> Novo usuário</router-link>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">Contato</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(user, index) in users">
                                        <th scope="row">{{ index + 1 }}</th>
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.phone }}</td>
                                        <td>
                                            <router-link :to="{ name: 'show', params: { id: user.id } }" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></router-link>
                                            <router-link :to="{ name: 'edit', params: { id: user.id } }" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></router-link>
                                            <router-link :to="{ name: 'delete', params: { id: user.id } }" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></router-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            //let url = 'https://jsonplaceholder.typicode.com/users';
            let url = 'http://desafio.test/api/users';
            axios.get(url).then((response) => {
                this.users = response.data;
            });

            return {
                users: []
            }
        }
    }
</script>

<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dados do Usuário</div>

                    <div class="card-body">

                        <router-link to="/users" class="btn btn-danger btn-sm mb-3"><i class="fa fa-reply-all"></i> voltar</router-link>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">Contato</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-if="user">
                                        <th scope="row">{{ $route.params.id }}</th>
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.phone }}</td>
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
            //let url = 'https://jsonplaceholder.typicode.com/users/'+this.$route.params.id;
            let url = 'http://desafio.test/api/users/'+this.$route.params.id;
            axios.get(url).then((response) => {
                this.user = response.data;
            });

            return {
                user: [],
            }
        }
    }
</script>

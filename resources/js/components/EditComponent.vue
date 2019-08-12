    <template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dados do Usuário</div>

                    <div class="card-body">

                        <router-link to="/users" class="btn btn-danger btn-sm mb-3"><i class="fa fa-reply-all"></i> voltar</router-link>

                        <div v-show="error" class="alert alert-danger" role="alert">
                            <i class="fa fa-exclamation-triangle"></i> Ocorreu um erro ao realizar atualizar o cadastro. Tente Novamente!
                        </div>

                        <div v-show="success" class="alert alert-success" role="alert">
                            <i class="fa fa-check-circle"></i> Atualização realizada com sucesso!
                        </div>

                        <form @submit.prevent="update">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">E-mail</th>
                                            <th scope="col">Contato</th>
                                        </tr>
                                    </thead>

                                    <tbody v-if="loader == false">
                                        <tr>
                                            <td><input type="text" id="id" class="form-control" v-model="id" readonly /></td>
                                            <td><input type="text" id="name" name="name" v-model="name" class="form-control" /></td>
                                            <td><input type="text" id="email" name="email" v-model="email" class="form-control" /></td>
                                            <td><input type="text" id="phone" v-model="phone" class="form-control" /></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4"><button class="btn btn-success btn-sm pull-right"><i class="fa fa-check"></i> Confirmar</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>

                        <div v-if="loader" class="d-flex justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
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
            let url = 'http://desafio.test/api/users/'+this.$route.params.id+"/edit";

            let id = "";
            let name = "";
            let email = "";
            let phone = "";

            axios.get(url).then((response) => {
                this.id = response.data.id;
                this.name = response.data.name;
                this.email = response.data.email;
                this.phone = response.data.phone;
            }).catch(error => {

            }).finally(()=>{
                this.loader = false;
            });

            return {
                id: this.id,
                name: this.name,
                email: this.email,
                phone: this.phone,
                error: false,
                success: false,
                loader: true
            }
        },
        methods:{
            update: function(event){
                let url = 'http://desafio.test/api/users/'+this.$route.params.id;
                let user = {
                    id: this.id,
                    name: this.name,
                    email: this.email,
                    phone: this.phone,
                }
                console.log(user.name);

                axios.put(url, user).then(response => {
                    this.success = true;
                    this.error = false;
                }).catch(error => {
                    this.error = true;
                    this.success = false;
                })
            }
        }
    }
</script>

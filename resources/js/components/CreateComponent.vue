    <template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dados do Usuário</div>

                    <div class="card-body">

                        <router-link to="/users" class="btn btn-danger btn-sm mb-3"><i class="fa fa-reply-all"></i> voltar</router-link>

                        <div v-show="success" class="alert alert-success" role="alert">
                            <i class="fa fa-check-circle"></i> Cadastro realizado com sucesso!
                        </div>

                        <form @submit.prevent="store">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-dark text-white">
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">Contato</th>
                                        <th scope="col">Senha</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" id="name" name="name" v-model="name" placeholder="digite o seu nome" class="form-control" />
                                            <code v-if="msgErrors.name">Nome obrigatório</code>
                                        </td>
                                        <td>
                                            <input type="text" id="email" name="email" v-model="email" placeholder="digite o seu e-mail"  class="form-control" />
                                            <code v-if="msgErrors.email">E-mail obrigatório</code>
                                        </td>
                                        <td>
                                            <input type="text" id="phone" v-model="phone" placeholder="digite o seu telefone"  v-mask="['(##)####-####', '(##)#####-####']" class="form-control" />
                                            <code v-if="msgErrors.phone">Celular obrigatório</code>
                                        </td>

                                        <td>
                                            <input type="password" id="password" v-model="password" placeholder="digite a sua senha"  class="form-control" />
                                            <code v-if="msgErrors.password">Senha obrigatório</code>
                                        </td>
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
    import {mask} from 'vue-the-mask';

    export default {
        directives: {
            mask
        },
        data: function () {
            return {
                id: "",
                name: "",
                email: "",
                phone: "",
                password: "",
                msgErrors: [],
                error: false,
                success: false,
                loader: false
            }
        },

        methods:{
            store: function(event){
                this.loader = true;
                this.msgErrors = [];
                //let url = 'http://desafio.test/api/users';
                let url = 'https://aw-desafio.herokuapp.com/users';
                let user = {
                    id: this.id,
                    name: this.name,
                    email: this.email,
                    phone: this.phone,
                    password: this.password,
                }

                axios.post(url, user).then(response => {
                    this.success = true;
                    this.error = false;
                    this.reseteData();
                }).catch(({response}) => {
                    this.msgErrors = response.data.errors;
                    this.error = true;
                    this.success = false;
                }).finally(()=>{
                    this.loader = false;
                });
            },
            reseteData: function(){
                this.id = "";
                this.name = "";
                this.email = "";
                this.phone = "";
                this.password = "";
            }
        }
    }
</script>

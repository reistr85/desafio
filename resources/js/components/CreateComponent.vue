    <template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dados do Usuário</div>

                    <div class="card-body">

                        <router-link to="/users" class="btn btn-danger btn-sm mb-3"><i class="fa fa-reply-all"></i> voltar</router-link>

<!--                        <div v-show="error" class="alert alert-danger" role="alert">-->
<!--                            <i class="fa fa-exclamation-triangle"></i> Ocorreu um erro ao realizar o cadastro. Tente Novamente!-->
<!--                        </div>-->

                        <div v-show="success" class="alert alert-success" role="alert">
                            <i class="fa fa-check-circle"></i> Cadastro realizado com sucesso!
                        </div>

                        <form @submit.prevent="update">
                            <div class="row">
                                <div class="col-md-1">
                                    <label for="id">ID:</label>
                                    <input type="text" id="id" class="form-control" v-model="id" readonly />
                                </div>

                                <div class="col-md-3">
                                    <label for="name">Nome:</label>
                                    <input type="text" id="name" name="name" v-model="name" class="form-control" />
                                    <code v-if="msgErrors.name">Nome obrigatório</code>
                                </div>

                                <div class="col-md-3">
                                    <label for="email">E-mail:</label>
                                    <input type="text" id="email" name="email" v-model="email" class="form-control" />
                                    <code v-if="msgErrors.email">E-mail obrigatório</code>
                                </div>

                                <div class="col-md-3">
                                    <label for="phone">Telefone:</label>
                                    <input type="text" id="phone" v-model="phone" v-mask="['(##)####-####', '(##)#####-####']" class="form-control" />
                                    <code v-if="msgErrors.phone">Celular obrigatório</code>
                                </div>

                                <div class="col-md-2">
                                    <label for="password">Senha:</label>
                                    <input type="password" id="password" v-model="password" class="form-control" />
                                    <code v-if="msgErrors.password">Senha obrigatório</code>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div v-if="loader"  class="d-flex justify-content-center">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button class="btn btn-success btn-sm pull-right"><i class="fa fa-check"></i> Confirmar</button>
                                </div>
                            </div>
                        </form>
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
            update: function(event){
                this.loader = true;
                this.msgErrors = [];
                let url = 'http://desafio.test/api/users';
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

<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Todos</div>

                    <div class="card-body">

                        <form @submit.prevent="addTodo">
                            <input
                                id="todo"
                                name="todo"
                                v-model="todo"
                                class="form-control form-control-lg"
                                type="text"
                                placeholder="What needs to be done?"
                                autofocus="true" />
                            <code v-if="msgErrors.description">digite uma tarefa</code>
                        </form>



                        <div class="list-group mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <button
                                        type="button"
                                        v-for="(todo, index) in todos"
                                        :key="index"
                                        class="list-group-item list-group-item-action"
                                        @click="options(todo.id, index)">
                                        {{ todo.description}} <span class="font-italic text-success">{{ todo.textCompleted }}</span>
                                    </button>
                                </div>
                            </div>

                        </div>

                        <div class="mt-2">
                            <button
                                class="btn btn-danger btn-sm float-right ml-1"
                                @click="remove"
                                v-if="actions">
                                <i class="fa fa-trash"></i>
                            </button>

                            <button
                                    class="btn btn-warning btn-sm float-right ml-1"
                                    @click="edit"
                                    v-if="actions">
                                <i class="fa fa-edit"></i>
                            </button>

                            <button
                                    class="btn btn-success btn-sm float-right ml-1"
                                    @click="check"
                                    v-if="actions">
                                <i class="fa fa-check"></i>
                            </button>

                            <button
                                    class="btn btn-success btn-sm float-left ml-1"
                                    v-if="eyeConfirm"
                                    @click="confirm" >
                                confirm
                            </button>
                        </div>

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

            this.getall();

            return {
                todos: [],
                todo: '',
                loader: true,
                actions: false,
                indexSelected: '',
                idSelected: 0,
                eyeConfirm: false,
                msgErrors: [],
            }
        },
        methods: {
            options(id, index){
                this.actions = true;
                this.indexSelected = index;
                this.idSelected = id;
            },
            getall(){
                let url = 'http://desafio.test/api/tasks';
                //let url = 'https://aw-desafio.herokuapp.com/api/tasks';

                axios.get(url).then((response) => {
                    this.todos = response.data;
                }).catch(error => {

                }).finally(()=>{
                    this.loader = false;
                });
            },
            addTodo(){

                this.loader = true;
                let url = 'http://desafio.test/api/tasks';
                //let url = 'https://aw-desafio.herokuapp.com/api/task';

                let taks = { description: this.todo }

                axios.post(url, taks).then(response => {
                    this.todos.push({ id: response.data.id, description: response.data.description, textCompleted: null });
                    this.success = true;
                    this.error = false;
                    this.msgErrors = [];
                    this.todo = '';
                }).catch(({response}) => {
                    this.msgErrors = response.data.errors;
                    this.error = true;
                    this.success = false;
                }).finally(()=>{
                    this.loader = false;
                });
            },
            remove(){
                if(confirm("Deseja realmente exlcuir este task?")){
                    let url = 'http://desafio.test/api/tasks/'+this.idSelected;
                    //let url = 'https://aw-desafio.herokuapp.com/api/tasks/'+this.idSelected;

                    axios.delete(url).then((response) => {
                        this.todos.splice(this.indexSelected, 1);
                        this.actions = false;
                        alert('Excluido com sucesso!');
                    }).catch(({response}) => {
                        this.msgErrors = response.data.errors;
                    }).finally(()=>{
                        this.loader = false;
                    });
                }
            },edit(){
                this.todo =  this.todos[this.indexSelected].description;
                this.eyeConfirm = true;
                this.actions = false;
            },check(){
                this.todos[this.indexSelected].textCompleted = ' - Completed';
                this.actions = false;
            },confirm(){
                this.todos[this.indexSelected].description = this.todo;
                this.todo = '';
                this.eyeConfirm = false;
            }
        }
    }
</script>

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
                                        {{ todo.description }}
                                        <span class="font-italic text-success" v-if="todo.status"> - Completed</span>
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
                                    @click="update(true)"
                                    v-if="actions">
                                <i class="fa fa-check"></i>
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

    const BASE_URL = 'http://desafio.test/api/tasks/';
    //const BASE_URL = 'https://aw-desafio.herokuapp.com/api/tasks/';

    export default {
        data: function () {
            return {
                todos: [],
                todo: '',
                loader: true,
                actions: false,
                indexSelected: null,
                idSelected: 0,
                msgErrors: [],
                activeEdit: false
            }
        },
        mounted: function(){
            console.log(BASE_URL);
            this.getall();
        },
        methods: {
            options(id, index){
                this.actions = true;
                this.indexSelected = index;
                this.idSelected = id;
            },
            getall(){
                axios.get(BASE_URL).then((response) => {
                    this.todos = response.data;
                }).catch(({response}) => {
                    this.msgErrors = response.data.errors;
                }).finally(()=>{
                    this.resete();
                });
            },
            addTodo(){
                if(this.activeEdit){
                    this.update();
                }else {
                    this.loader = true;
                    let taks = { description: this.todo }

                    axios.post(BASE_URL, taks).then(response => {
                        this.todos.push({
                            id: response.data.id,
                            description: response.data.description,
                            textCompleted: null
                        });
                        this.success = true;
                        this.error = false;
                    }).catch(({response}) => {
                        this.msgErrors = response.data.errors;
                        this.error = true;
                        this.success = false;
                    }).finally(() => {
                        this.resete();
                    });
                }
            },
            remove(){
                if(confirm("Deseja realmente exlcuir este task?")){
                    axios.delete(BASE_URL+this.idSelected).then((response) => {
                        this.todos.splice(this.indexSelected, 1);
                        this.actions = false;
                    }).catch(({response}) => {
                        this.msgErrors = response.data.errors;
                    }).finally(()=>{
                        this.resete();
                    });
                }
            },edit(){
                this.todo = this.todos[this.indexSelected].description;
                this.activeEdit = true;
            }
            ,update(completed = false){
                let task = { description: this.todo }

                if(completed){
                    task.description = this.todos[this.indexSelected].description;
                    task.status = 1;
                }

                axios.put(BASE_URL+this.idSelected, task).then(response => {
                    this.success = true;
                    this.error = false;
                    this.todos[this.indexSelected].description = task.description;
                    this.todos[this.indexSelected].status = task.status;
                    console.log(response);
                }).catch(error => {
                    this.error = true;
                    this.success = false;
                }).finally(()=>{
                    this.resete();
                });

            },
            resete(){
                this.todo = '';
                this.loader = false;
                this.actions = false;
                this.indexSelected = null;
                this.idSelected = 0;
                this.msgErrors = [];
                this.activeEdit = false;
            }
        }
    }
</script>

<template>
    <div class="todo">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="row">
                    <div class="col">
                        <h2>Todo List</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" v-model="todoDate">
                            <input v-model="todoText" type="text" class="form-control" placeholder="할일 입력">
                            <div class="input-group-append">
                                <button @click="add" class="btn btn-outline-secondary" type="button">
                                    추가
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <transition-group class="list-group" tag="ul" name="todo">
                            <li class="list-group-item" v-for="item in list" :key="item.id">
                                <span class="name">{{item.name}}</span>
                                <span class="badge badge-primary">{{item.date.toLocaleDateString()}}</span>
                                <div class="btn-group float-right">
                                    <button class="btn btn-sm btn-outline-primary" @click="complete(item.id)">완료</button>
                                    <button class="btn btn-sm btn-outline-danger" @click="del(item.id)">삭제</button>
                                </div>
                            </li>
                        </transition-group>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col">
                        <h2>Complete List</h2>
                        <ul class="list-group">
                            <li class="list-group-item" v-for="item in cList" :key="item.id">
                                <span class="name">{{item.name}}</span>
                                <span class="badge badge-success">{{item.date.toLocaleDateString()}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'todo-compo',
        mounted(){
            this.$http.get('/read.php')
            .then(result => {
                let resList = result.data.map(x => {
                    x.date = new Date(x.date);
                    return x;
                });

                this.list = resList.filter(x => x.complete == 0);
                this.cList = resList.filter(x => x.complete != 0);
            });
        },
        data () {
            return {
                list:[],
                cList:[],
                idx:5,
                todoText:'',
                todoDate:'',
            };
        },
        methods:{
            del(idx){
                let id = this.list.findIndex( x => x.id == idx);
                let item = this.list.splice(id, 1)[0];

                let form = new FormData();
                form.append("id", item.id);
                this.$http.post('/delete.php', form)
                .then(res => {
                    console.log(res.data);
                });
            },
            add(){
                if(this.todoText.trim() == "" || this.todoDate == ""){
                    alert("공백은 입력할 수 없습니다.");
                    return;
                }
                
                
                let form = new FormData();
                form.append("todo", this.todoText);
                form.append("date", this.todoDate);
                this.$http.post('/post.php', form)
                .then( res => {
                    this.list.push({id: this.res.data.id, name:this.todoText, date: new Date(this.todoDate)});
                });
            },
            complete(idx){
                let id = this.list.findIndex(x => x.id == idx);
                let item = this.list.splice(id, 1)[0];
                item.date = new Date();
                console.log(item.date);
                
                this.cList.push(item);

                let form = new FormData();
                form.append("id", item.id);
                this.$http.post('/complete.php', form)
                .then(res => {
                    console.log(res.data);
                });
            }
        }
    }
</script>

<style scoped>
    .todo-enter, .todo-leave-to {
        opacity: 0;
        transform:translateX(-100px);
    }

    .todo-enter-active {
        transition:all 1s;
    }

    .todo-leave-active {
        transition:all 1s;
        position:absolute;
    }
    .todo-move {
        transition: transform 1s;
    }
</style>